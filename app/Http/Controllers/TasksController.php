<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Group;
use SigeTurbo\Http\Requests\TaskRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\Group\GroupRepositoryInterface;
use SigeTurbo\Repositories\Period\PeriodRepositoryInterface;
use SigeTurbo\Repositories\Subject\SubjectRepositoryInterface;
use SigeTurbo\Repositories\Task\TaskRepositoryInterface;
use SigeTurbo\Repositories\Tasktype\TasktypeRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class TasksController extends Controller
{

    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var PeriodRepositoryInterface
     */
    private $periodRepository;
    /**
     * @var TasktypeRepositoryInterface
     */
    private $tasktypeRepository;
    /**
     * @var SubjectRepositoryInterface
     */
    private $subjectRepository;
    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;


    /**
     * @param TaskRepositoryInterface $taskRepository
     * @param MailerInterface $mailer
     * @param YearRepositoryInterface $yearRepository
     * @param PeriodRepositoryInterface $periodRepository
     * @param GroupRepositoryInterface $groupRepository
     * @param SubjectRepositoryInterface $subjectRepository
     * @param TasktypeRepositoryInterface $tasktypeRepository
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository,
        MailerInterface $mailer,
        YearRepositoryInterface $yearRepository,
        PeriodRepositoryInterface $periodRepository,
        GroupRepositoryInterface $groupRepository,
        SubjectRepositoryInterface $subjectRepository,
        TasktypeRepositoryInterface $tasktypeRepository)
    {

        $this->taskRepository = $taskRepository;
        $this->mailer = $mailer;
        $this->yearRepository = $yearRepository;
        $this->periodRepository = $periodRepository;
        $this->tasktypeRepository = $tasktypeRepository;
        $this->subjectRepository = $subjectRepository;
        $this->groupRepository = $groupRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /tasks
     * @param Request $request
     * @return Response
     */
    public function dashboard(Request $request)
    {
        //Year
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = $this->yearRepository->getCurrentYear()->idyear;
        }

        //Period
        $period = [1, 2, 3];

        //Subject
        $subject = 0;
        if (isset($request['subject'])) {
            $subject = intval($request['subject']);
        }

        //Group
        $group = 0;
        if (isset($request['group'])) {
            $group = $request['group'];
        }

        //Sort
        $sort = 'created_at';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Approved
        $approved = false;
        if (isset($request['approved'])) {
            $approved = true;
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $starts = $this->taskRepository->getTasks($year, $period, $group, $subject, $approved, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $starts->forPage($page, $perPage), $starts->count(), $perPage, $page
        );
        $paginator->setPath('formation/tasks');
        return view('tasks.dashboard')
            ->withTasks($paginator)
            ->withSubjects($this->subjectRepository->getSubjectsWithoutPeriod($this->yearRepository->getCurrentYear()->idyear)->prepend(['idsubject' => 0, 'name' => 'Todas'])->pluck('name', 'idsubject'))
            ->withSort($sort)
            ->withSubject($subject)
            ->withOrder($order);
    }

    /**
     * Display a listing of the resource.
     * GET /tasks
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //Year
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = $this->yearRepository->getCurrentYear()->idyear;
        }

        //Period
        $period = [1, 2, 3];

        //Subject
        $subject = 0;
        if (isset($request['subject'])) {
            $subject = intval($request['subject']);
        }

        //Group
        $group = 0;
        if (isset($request['group'])) {
            $group = intval($request['group']);
        }

        //Sort
        $sort = 'created_at';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }


        //Approved
        $approved = true;
        if (isset($request['approved'])) {
            $approved = true;
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $starts = $this->taskRepository->getTasks($year, $period, $group, $subject, $approved, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $starts->forPage($page, $perPage), $starts->count(), $perPage, $page
        );
        $paginator->setPath('/homeworks');
        return view('tasks.index')
            ->withTasks($paginator)
            ->withGroups($this->groupRepository->getGroups($this->yearRepository->getCurrentYear()->idyear, $this->periodRepository->getCurrentPeriod()->idperiod)->prepend(['idgroup' => 0, 'name' => 'Todos'])->pluck('name', 'idgroup'))
            ->withSort($sort)
            ->withGroup($group)
            ->withOrder($order);
    }

    /**
     * Display the specified resource.
     * GET /tasks/{idtask}
     * @param  int $idtask
     * @return Response
     */
    public function show($idtask)
    {
        return response()->json($this->taskRepository->find($idtask));
    }

    /**
     * Display the specified resource.
     * GET /tasks/{idtask}
     * @param $taskID
     * @return Response
     */
    public function gettask($taskID)
    {
        return response()->json($this->taskRepository->getTask($taskID));
    }

    /**
     * Get Detail Task
     * @param $task
     * @param Request $request
     */
    public function getDetail($task, Request $request)
    {
        return view('tasks.detail')
            ->withTask($this->taskRepository->getTask($task))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withGroup($request['group']);
    }


    /**
     * Create Task
     * @return mixed
     */
    public function create()
    {
        return view('tasks.create')
            ->withTasktypes($this->tasktypeRepository->all()->pluck('name', 'idtasktype'));
    }

    /**
     * Store a newly created resource in storage.
     * @param TaskRequest $request
     * @return Response
     */
    public function store(TaskRequest $request)
    {

        //Save Task
        $task = $this->taskRepository->store($request);

        $data = [];
        if ($task) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['task'] = $task;
            //Stream
            $group = Group::find($request['group']);
            event(new Stream(['description' => "ingresó una Tarea para el grupo $group->name"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);

    }

    /**
     * Edit tasks
     * @param $task
     * @param Request $request
     * @return mixed
     */
    public function edit($task, Request $request)
    {
        return view('tasks.edit')
            ->withTask($this->taskRepository->getTask($task))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withSubject($request['subject']);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idtask
     * @param TaskRequest $request
     * @return Response
     */
    public function update($idtask, TaskRequest $request)
    {

        //Update Task
        $task = $this->taskRepository->update($idtask, $request);
        $data = [];
        if ($task) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['observer'] = $task;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Get All Tasks By Year
     * @param Request $request
     * @return mixed
     */
    public function getTasks(Request $request)
    {

        //Year
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = $this->yearRepository->getCurrentYear()->idyear;
        }

        //Period
        $period = [1, 2, 3];
        /*
        if (isset($request['period'])) {
            $period = $request['period'];
        } else {
            //$period = $this->periodRepository->getCurrentPeriod()->idperiod;
            $period = 1;
        }
        */

        //Subject
        $subject = 0;
        if (isset($request['subject'])) {
            $subject = intval($request['subject']);
        }

        //Group
        $group = null;
        if (isset($request['group'])) {
            $group = $request['group'];
        }

        //Sort
        $sort = 'created_at';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Approved
        $approved = false;
        if (isset($request['approved'])) {
            $approved = true;
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }
        return response()->json($this->taskRepository->getTasks($year, $period, $group, $subject, $approved, $sort, strtoupper($order)));
    }

    /**
     * Get Tasks By User
     * @param Request $request
     * @return mixed
     */
    public function getTasksByUser(Request $request)
    {
        return response()->json($this->taskRepository->getTasksByUser($request['user']));
    }

    /**
     * Set Task Approved
     * @param Request $request
     * @return mixed
     */
    public function setApproved(Request $request)
    {

        //Task Approved
        $task = $this->taskRepository->setApproved($request['task']);
        $data = [];
        if ($task) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['task'] = $task;
            //Send Email To Parents
            //$this->mailer->byParents('task',Task::select('*')->where('idtask','=',$request['task'])->with('taskfiles')->get(),[$request['group']],[],[Category::STUDENT,Category::FATHER,Category::MOTHER]);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }

        return response()->json($data);
    }


}