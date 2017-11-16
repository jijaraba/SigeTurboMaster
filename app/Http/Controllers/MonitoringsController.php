<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\MonitoringRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Monitorings\Monitorings;
use SigeTurbo\Repositories\Monitoring\MonitoringRepositoryInterface;
use SigeTurbo\Repositories\Period\PeriodRepositoryInterface;
use SigeTurbo\Repositories\Subject\SubjectRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Repositories\Groupdirector\GroupdirectorRepositoryInterface;
use SigeTurbo\Repositories\Areamanager\AreamanagerRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;

class MonitoringsController extends Controller
{
    /**
     * @var MonitoringRepositoryInterface
     */
    private $monitoringRepository;
    /**
     * @var SubjectRepositoryInterface
     */
    private $subjectInterface;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var PeriodRepositoryInterface
     */
    private $periodRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var GroupdirectorRepositoryInterface
     */
    private $groupdirectorRepository;
    /**
     * @var AreamanagerRepositoryInterface
     */
    private $areamanagerRepository;

    /**
     * @param MonitoringRepositoryInterface $monitoringRepository
     * @param SubjectRepositoryInterface $subjectInterface
     * @param YearRepositoryInterface $yearRepository
     * @param PeriodRepositoryInterface $periodRepository
     * @param MailerInterface $mailer
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param UserRepositoryInterface $userRepository
     * @param GroupdirectorRepositoryInterface $groupdirectorRepository
     * @param AreamanagerRepositoryInterface $areamanagerRepository
     */
    public function __construct(MonitoringRepositoryInterface $monitoringRepository,
                                SubjectRepositoryInterface $subjectInterface,
                                YearRepositoryInterface $yearRepository,
                                PeriodRepositoryInterface $periodRepository,
                                MailerInterface $mailer,
                                UserfamilyRepositoryInterface $userfamilyRepository,
                                UserRepositoryInterface $userRepository,
                                GroupdirectorRepositoryInterface $groupdirectorRepository,
                                AreamanagerRepositoryInterface $areamanagerRepository
                                )
    {
        $this->monitoringRepository = $monitoringRepository;
        $this->subjectInterface = $subjectInterface;
        $this->yearRepository = $yearRepository;
        $this->periodRepository = $periodRepository;
        $this->mailer = $mailer;
        $this->userfamilyRepository = $userfamilyRepository;
        $this->userRepository = $userRepository;
        $this->groupdirectorRepository = $groupdirectorRepository;
        $this->areamanagerRepository = $areamanagerRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /monitorings
     * @return Response
     */
    public function index()
    {
        return view('monitorings.index');
    }

    /**
     * Display the specified resource.
     * GET /monitorings/{$idmonitoring}
     * @param  int $idmonitoring
     * @return Response
     */
    public function show($idmonitoring)
    {
        return response()->json($this->monitoringRepository->find($idmonitoring));
    }

    /**
     * Store a newly created resource in storage.
     * @param MonitoringRequest $request
     * @return Response
     */
    public function store(MonitoringRequest $request)
    {
        //Save Monitoring
        $monitoring = $this->monitoringRepository->store($request);

        $data = [];
        if ($monitoring) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $monitoring->idmonitoring;
            $data['monitoring'] = $monitoring;
            $data['scale'] = scale($request['rating'], $request['group']);
            //Delete Cache
            Cache::forget('monitorings.getmonitoringsbyuser' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel'] . $request['user']);
            //Stream
            $student = User::find($request['user']);
            $subject = Subject::find($request['subject']);
            event(new Stream(['description' => "ingresó un Seguimiento para $student->firstname $student->lastname en $subject->name (" . scale($request['rating'], $request['group']) . ")"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idmonitoring
     * @param MonitoringRequest $request
     * @return Response
     */
    public function update($idmonitoring, MonitoringRequest $request)
    {
        $monitoring = $this->monitoringRepository->update($idmonitoring, $request);

        $data = [];
        if ($monitoring) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('monitorings.getmonitoringsbyuser' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel'] . $request['user']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idmonitoring
     * @param Request $request
     * @return Response
     */
    public function destroy($idmonitoring, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
            'user' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response::json($validator->errors(), 300);
        }

        //Delete Monitoring
        $monitoring = $this->monitoringRepository->destroy($idmonitoring);

        $data = [];
        if ($monitoring) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('monitorings.getmonitoringsbyuser' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel'] . $request['user']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }


    /**
     * Display Monitoring by User
     * GET /monitorings/getmonitoringsbyuser/{$token}
     * @param Request $request
     * @return mixed
     */
    public function getMonitoringsByUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
            'user' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response::json($validator->errors(), 300);
        }

        //Find Monitorings
        $monitorings = $this->monitoringRepository->getMonitoringByUser($request);
        return response()->json($monitorings);
    }

    /**
     * Get Global Performance
     * @param Request $request
     * @return mixed
     */
    public function getGlobalPerformances(Request $request)
    {
        return response()->json($this->monitoringRepository->globalPerformances($request['year']));
    }

    /**
     * Get Monitorings By User
     * @param Request $request
     * @return
     */
    public function getMonitoringsForParents(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'user' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 300);
        }

        $performances = Monitorings::getMonitoringsForParents($request['year'], $request['period'], $request['group'], $request['user']);
        return response()->json($performances);
    }

    /**
     * Get Monitorings Detail By User
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param $user
     * @return
     * @internal param Request $request
     */
    public function getMonitoringsDetailForParents($year, $period, $group, $subject, $nivel, $user)
    {

        $monitorings = $this->monitoringRepository->getMonitoringsDetailForParents($year, $period, $group, $subject, $nivel, $user);
        $subject = $this->subjectInterface->find($subject);
        return view('userfamilies.indexparentsbymonitoringsdetail')
            ->withMonitorings($monitorings)
            ->withSubject($subject);
    }


    /**
     * Get Monitorings In Current Week By Teacher
     * @return mixed
     */
    public function getMonitoringsInCurrentWeek()
    {
        if (Session::get('role') === 'Teacher') {
            return response()->json($this->monitoringRepository->getMonitoringsInCurrentWeek($this->yearRepository->getCurrentYear()->idyear, $this->periodRepository->getCurrentPeriod()->idperiod, getUser()->iduser));
        } else {
            return response()->json(['amount' => 1]);
        }
    }

    /**
     * Send Monitoring In Current Week For Parents
     * @return string
     */
    public function sendMonitoringsToParents()
    {
        //Send Emails
        $monitorings = Monitorings::getMonitoringsInCurrentWeek();
        foreach ($monitorings as $monitoring) {
            $users = $this->userfamilyRepository->getEmailsByFamily($this->yearRepository->getCurrentYear()->idyear, $monitoring->idfamily);
            if ($users) {
                $this->mailer->byUsers('monitoring_inCurrentWeekForFamily', $users, $monitoring);
            }

        }
        return "OK";
    }

    /**
     * Display a listing of the resource.
     * GET /payments
     * @param Request $request
     * @return Response
     */
    public function studentspendigsbymonitoring(Request $request)
    {   
        $search = [
            'idyear' => $this->yearRepository->getCurrentYear()->idyear,
            'page' => 1,
            'option' => 'studentspendigsbymonitoring',
            'idperiod' => $this->periodRepository->getCurrentPeriod()->idperiod
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

    /**
     * Display a listing of the pendings.
     * GET /payments
     * @param Request $request
     * @return Response
     */
    public function getstudentspendigsbymonitoring(Request $request)
    {   
        switch (getUser()->role_selected) {
            case 'Teacher':                                                                       
                    return response()->json($this->userRepository->getStudentsPendigsByMonitorings($request['year'],$request['period'],/*group*/null,/*area*/null,/*teacher*/getUser()->iduser,/*subjectnotin*/[54],/*statusnotin*/[4,7,8,9,10])->toArray());
                break;
            case 'HomeroomTeacher':
                    $groupdirector =$this->groupdirectorRepository->getGroupDirectorByYearAndUser($request['year'],getUser()->iduser);                                                     
                    return response()->json($this->userRepository->getStudentsPendigsByMonitorings($request['year'],$request['period'],/*group*/$groupdirector->idgroup,/*area*/null,/*teacher*/null,/*subjectnotin*/[54],/*statusnotin*/[4,7,8,9,10])->toArray());
                break;
            case 'Areamanager':
                    $areamanager = $this->areamanagerRepository->getAreaManagerByYearAndUser($request['year'],getUser()->iduser);      
                    return response()->json($this->userRepository->getStudentsPendigsByMonitorings($request['year'],$request['period'],/*group*/null,/*area*/$areamanager->idarea,/*teacher*/null,/*subjectnotin*/[54],/*statusnotin*/[4,7,8,9,10])->toArray());
                break;
            default :
                    return response()->json($this->userRepository->getStudentsPendigsByMonitorings($request['year'],$request['period'],/*group*/null,/*area*/null,/*teacher*/null,/*subjectnotin*/[54],/*statusnotin*/[4,7,8,9,10])->toArray());
                break;
        }
    }

}