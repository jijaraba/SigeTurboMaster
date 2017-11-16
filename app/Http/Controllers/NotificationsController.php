<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Notification\NotificationRepositoryInterface;
use SigeTurbo\User;

class NotificationsController extends Controller
{
    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * NotificationsController constructor.
     * @param NotificationRepositoryInterface $notificationRepository
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /notifications
     * @return Response
     */
    public function index()
    {
        return response()->json($this->notificationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /notifications/{idnotification}
     * @param  int $idnotification
     * @return Response
     */
    public function show($idnotification)
    {
        return response()->json($this->notificationRepository->find($idnotification));
    }

    /**
     * Get Notifications By Username
     * @param $username
     * @return mixed
     */
    public function notificationsbyuser($username)
    {
        $user = User::where("username", "=", $username)->get()->first();
        return view('notifications.username')->withUser($user);
    }

}