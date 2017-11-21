<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\ObserverRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\Observer\ObserverRepositoryInterface;
use SigeTurbo\Repositories\Observertype\ObservertypeRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\User;

class ObserversController extends Controller
{
    /**
     * @var ObserverRepositoryInterface
     */
    private $observerRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var ObservertypeRepositoryInterface
     */
    private $observertypeRepository;

    /**
     * @param ObserverRepositoryInterface $observerRepository
     * @param UserRepositoryInterface $userRepository
     * @param MailerInterface $mailer
     * @param ObservertypeRepositoryInterface $observertypeRepository
     */
    public function __construct(ObserverRepositoryInterface $observerRepository, UserRepositoryInterface $userRepository,MailerInterface $mailer, ObservertypeRepositoryInterface $observertypeRepository)
    {

        $this->observerRepository = $observerRepository;
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
        $this->observertypeRepository = $observertypeRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /observers
     * @return Response
     */
    public function index()
    {
        return view('observers.index');
    }

    /**
     * Display the specified resource.
     * GET /observers/{idobserver}
     * @param  int $idobserver
     * @return Response
     */
    public function show($idobserver)
    {
        return response()->json($this->observerRepository->all($idobserver));
    }

    /**
     * Get Observers by Student
     * @param $year
     * @param $group
     * @param $student
     * @return mixed
     */
    public function showByStudent($year,$group,$student){
        return view('observers.show_student')
            ->withStudent($this->userRepository->find($student))
            ->withObservers($this->observerRepository->getObservers(['year' => $year, 'group' => $group, 'student' => $student]));
    }

    public function create($year,$group,$student){
        return view('observers.create')
            ->withYear($year)
            ->withGroup($group)
            ->withStudent($this->userRepository->find($student))
            ->withObservertypes($this->observertypeRepository->all()->pluck('name','idobservertype'));
    }

    /**
     * Store a newly created resource in storage.
     * @param ObserverRequest $request
     * @return Response
     */
    public function store(ObserverRequest $request)
    {

        //Save Observer
        $observer = $this->observerRepository->store($request);

        $data = [];
        if ($observer) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['observer'] = $observer;
            //Send Emails
            $this->mailer->observerByDirectorGroup($request['year'],$request['group'], $request['student'], $request['observer']);
            //Stream
            $student = User::find($request['student']);
            event(new Stream(['description' => "ingresó una Observación para $student->lastname $student->firstname"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);

    }


    /**
     * Update the specified resource in storage.
     * @param  int $observer
     * @param ObserverRequest $request
     * @return Response
     */
    public function update($observer,ObserverRequest $request)
    {

        //Update Observer
        $observer = $this->observerRepository->update($observer, $request);

        $data = [];
        if ($observer) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['observer'] = $observer;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Get All Observers By Student
     * @param Request $request
     * @return mixed
     */
    public function getObservers(Request $request)
    {
        return response()->json($this->observerRepository->getObservers($request));
    }

}