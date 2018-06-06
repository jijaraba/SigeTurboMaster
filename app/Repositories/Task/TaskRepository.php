<?php

namespace SigeTurbo\Repositories\Task;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Repositories\Year\YearRepository;
use SigeTurbo\Task;

class TaskRepository implements TaskRepositoryInterface
{

    /**
     * Get all Tasks
     * @return mixed
     */
    public function all()
    {
        return Task::all();
    }

    /**
     * Get a Task
     * @param $idtask
     * @return mixed
     */
    public function find($idtask)
    {
        return Task::select('*')
            ->where('idtask', '=', $idtask)
            ->with('taskfiles')
            ->first();
    }

    /**
     * Get Tasks By Year
     * @param int $year
     * @param array $period
     * @param int $group
     * @param int $subject
     * @param bool $approved
     * @param string $sort
     * @param string $order
     * @return mixed
     */
    public function getTasks($year = 2015, $period = [], $group = 0, $subject = 0, $approved = false, $sort = null, $order = 'ASC')
    {
        $tasks = Task::select('tasks.*', 'groups.name AS group', 'subjects.name AS subject', 'nivels.name AS nivel', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"), 'teachers.photo', 'teachers.email')
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'tasks.idgroup');
            })
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'tasks.idsubject');
            })
            ->join('nivels', function ($join) {
                $join
                    ->on('nivels.idnivel', '=', 'tasks.idnivel');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'tasks.iduser');
            })
            ->where('idyear', '=', $year)
            ->whereIn('idperiod', $period)
            ->whereIn('idtasktype', [Task::TASK, Task::TERM, Task::PLAN])
            ->whereRaw("tasks.ends >=  DATE_SUB(NOW(), INTERVAL ? DAY)", array(8));
        //Is Approved
        if (is_bool($approved) && $approved) {
            $tasks->where('tasks.status', '=', '1');
        }
        //Subject
        if ($subject !== 0) {
            $tasks->where('subjects.idsubject', '=', $subject);
        }
        //Group
        if ($group !== 0) {
            $tasks->where('groups.idgroup', '=', $group);
        }
        //Sort
        switch ($sort) {
            case 'starts':
                $tasks->orderBy('tasks.starts', $order);
                break;
            case 'ends':
                $tasks->orderBy('tasks.ends', $order);
                break;
            case 'teacher':
                $tasks->orderBy('teachers.lastname', $order);
                break;
            case 'subject':
                $tasks->orderBy('tasks.idsubject', $order);
                break;
            case 'group':
                $tasks->orderBy('tasks.idgroup', $order);
                break;
            case 'status':
                $tasks->orderBy('tasks.status', $order);
                break;
            case 'created_at':
                $tasks->orderBy('tasks.created_at', $order);
                break;
            default:
                $tasks->orderBy('tasks.created_at', $order);
        }
        return $tasks
            ->limit(500)
            ->with('taskfiles')
            ->get();
    }

    /**
     * Create Task
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Task::create([
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'idtasktype' => $data['type'],
            'iduser' => getUser()->iduser,
            'name' => $data['name'],
            'description' => $data['description'],
            'starts' => $data['starts'],
            'ends' => $data['ends'],
            'days' => taskDays($data['starts'], $data['ends']),
            'created_by' => getUser()->iduser
        ]);
    }

    public function update($task, $data)
    {
        //Find Task
        $task = Task::find($task);
        $task->fill(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'idtasktype' => $data['type'],
            'name' => $data['name'],
            'description' => $data['description'],
            'starts' => $data['starts'],
            'ends' => $data['ends'],
            'days' => taskDays($data['starts'], $data['ends']),
            'updated_by' => getUser()->iduser
        ));
        return $task->save();
    }

    /**
     * Set Task Aproved
     * @param $task
     * @return mixed
     */
    public function setApproved($task)
    {
        //Find Task
        $task = Task::find($task);
        $task->fill(array(
            'status' => '1',
            'updated_by' => getUser()->iduser
        ));
        return $task->save();
    }

    /**
     * Getl Task By ID
     * @param $task
     * @return mixed
     */
    public function getTask($task)
    {
        return Task::select('tasks.*', 'groups.name AS group', 'subjects.name AS subject', 'nivels.name AS nivel', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"), 'teachers.photo', 'teachers.email')
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'tasks.idgroup');
            })
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'tasks.idsubject');
            })
            ->join('nivels', function ($join) {
                $join
                    ->on('nivels.idnivel', '=', 'tasks.idnivel');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'tasks.iduser');
            })
            ->where('idtask', '=', $task)
            ->with('taskfiles')
            ->first();
    }

    /**
     * Get Tasks By User
     * @param $user
     * @return mixed
     */
    public function getTasksByUser($user)
    {
        return Task::select('tasks.*', 'groups.name AS group', 'subjects.name AS subject', 'nivels.name AS nivel', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"), 'teachers.photo')
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'tasks.idgroup');
            })
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'tasks.idsubject');
            })
            ->join('nivels', function ($join) {
                $join
                    ->on('nivels.idnivel', '=', 'tasks.idnivel');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'tasks.iduser');
            })
            ->whereIn('groups.idgroup', function ($query) use ($user) {
                $query
                    ->select(DB::raw("MAX(enrollments.idgroup)"))
                    ->from('enrollments')
                    ->where('enrollments.iduser', '=', $user)
                    ->where('years.idyear', '=', YearRepository::getCurrentYear(2))
                    ->get();
            })
            ->whereRaw("tasks.ends >=  DATE_SUB(NOW(), INTERVAL ? DAY)", array(8))
            ->where("tasks.status", "=", '1')
            ->orderBy('tasks.ends', 'ASC')
            ->with('taskfiles')
            ->get();
    }
}
