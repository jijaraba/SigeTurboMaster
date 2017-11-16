<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\UserCelularPasscodeRequest;
use SigeTurbo\Http\Requests\UserCelularMessageRequest;
use SigeTurbo\Http\Requests\UserCreateRequest;
use SigeTurbo\Http\Requests\UserEmailMessageRequest;
use SigeTurbo\Http\Requests\UserEmailPasscodeRequest;
use SigeTurbo\Http\Requests\UserUpdateRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\SMS\Client;
use SigeTurbo\User;


class UsersController extends Controller {

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param MailerInterface $mailer
     */
    function __construct(UserRepositoryInterface $userRepository, MailerInterface $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    /**
	 * Display a listing of the resource.
	 * GET /users
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->userRepository->all());
	}

    /**
     * Display a listing of the users with permissions to rating.
     * GET /users
     * @return Response
     */
    public function getPersonalAcademic()
    {
        return response()->json($this->userRepository->getPersonalAcademic());
    }

    /**
     * Display a listing of the users with permissions to rating.
     * @param Request $request
     * @return Response
     */
    public function getallstudents(Request $request)
    {   
        //Year
        $year =  null; 
        if (isset($request['year'])) {
            $year = $request['year'];
        }

        //Showall
        $showactives = false; 
        if (isset($request['showactives'])) {
            $showactives = $request['showactives'];
        }

        return response()->json($this->userRepository->getallstudents($year,$showactives));
    }

	/**
	 * Display the specified resource.
	 * GET /users/{iduser}
	 * @param  int  $iduser
	 * @return Response
	 */
	public function show($iduser)
	{
		return response()->json($this->userRepository->find($iduser));
	}


    /**
     * Store a newly created resource in storage.
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {

        //Save User
        $password = "sigeturbo_" . str_random(6);
        $user = $this->userRepository->store($request,$password);

        $data = [];
        if($user){
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $user->iduser;
            $data['password'] = $password;
            //Delete Cache
            Cache::forget('users');
            //Event
            event(new Stream(['description' => "created a new student: " . $user->firstname . " " . $user->lastname]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $iduser
     * @param UserUpdateRequest $request
     * @return Response
     */
    public function update($iduser, UserUpdateRequest $request)
    {

        //Update user
        $user = $this->userRepository->update($iduser,$request);


        $data = [];
        if($user){
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('users');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Latest
     * @param Request $request
     * @return mixed
     */
    public function getLatest(Request $request)
    {
        return response()->json($this->userRepository->getLatest($request['count']));
    }

    /**
     * Get Latest Code
     * @return mixed
     */
    public function getLatestCode()
    {
        return response()->json($this->userRepository->getLatestCode());
    }

    /**
     * Verify Celular
     * @param Request $request
     * @return mixed
     */
    public function verifyCelular(Request $request)
    {
        //JSON response
        $data = [
            'exists' => false,
            'message' => Lang::get('sige.CelularNotExists')
        ];
        if (count($this->userRepository->verifyCelular($request["celular"])) > 0) {
            $data["exists"] = true;
            $data["message"] = Lang::get('sige.CelularExists');
        }
        return response()->json($data);
    }

    /**
     * Verify Celular Message
     * @param UserCelularMessageRequest $request
     * @return mixed
     */
    public function verifyCelularMessage(UserCelularMessageRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.CelularMessageNotSend')
        ];
        //Update Celular
        $passcode = generatePasscode(getenv('PASSCODE_DIGITS'));
        $user = $this->userRepository->updateCelularPasscode($request["user"], $request, $passcode);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.CelularMessageSend');

            //Send SMS
            $sms = new Client(getenv('SMS_USER'),getenv('SMS_TOKEN'));
            $deliveryID = $sms->sendMessage($request["celular"],"SigeTurbo Passcode: " . $passcode);
            $data["deliveryID"] = $deliveryID;
        }
        return response()->json($data);
    }

    /**
     * Save Celular By Passcode
     * @param UserCelularPasscodeRequest $request
     * @return mixed
     */
    public function saveCelularByPasscode(UserCelularPasscodeRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.CelularPasscodeNotValid')
        ];
        //Update Celular
        $user = $this->userRepository->updateCelularWithPasscode($request["user"], $request);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.CelularPasscodeValid');
        }
        return response()->json($data);
    }

    /**
     * Save Celular By Certification
     * @param UserCelularMessageRequest $request
     * @return mixed
     */
    public function saveCelularByCertification(UserCelularMessageRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.ErrorUpdateMessage')
        ];
        //Update Celular
        $user = $this->userRepository->updateCelularCertification($request["user"], $request);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.SuccessUpdateMessage');
        }
        return response()->json($data);
    }



    /**
     * Verify Email
     * @param Request $request
     * @return mixed
     */
    public function verifyEmail(Request $request)
    {
        //JSON response
        $data = [
            'exists' => false,
            'message' => Lang::get('sige.EmailNotExists')
        ];
        if (count($this->userRepository->verifyEmail($request["email"])) > 0) {
            $data["exists"] = true;
            $data["message"] = Lang::get('sige.EmailExists');
        }
        return response()->json($data);
    }


    /**
     * Verify Email Message
     * @param UserEmailMessageRequest $request
     * @return mixed
     */
    public function verifyEmailMessage(UserEmailMessageRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.EmailMessageNotSend')
        ];
        //Update Email
        $passcode = generatePasscode(getenv('PASSCODE_DIGITS'));
        $user = $this->userRepository->updateEmailPasscode($request["user"], $request, $passcode);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.EmailMessageSend');

            //Find User info
            $user = User::find($request["user"]);

            //Add Info
            $data["email"] = $request["email"];
            $data["passcode"] = $passcode;
            $data["firstname"] = $user->firstname;

            //Send Email
            Mail::send('emails.users.verifyemail', $data, function ($message) use ($data) {
                $message
                    ->to($data["email"], $data["firstname"])
                    ->subject(Lang::get('sige.UserVerifyEmail'));
            });
        }
        return response()->json($data);
    }


    /**
     * Save Email By Passcode
     * @param UserEmailPasscodeRequest $request
     * @return mixed
     */
    public function saveEmailByPasscode(UserEmailPasscodeRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.EmailPasscodeNotValid')
        ];
        //Update Email
        $user = $this->userRepository->updateEmailWithPasscode($request["user"], $request);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.EmailPasscodeValid');
        }
        return response()->json($data);
    }


    /**
     * Save Email By Certification
     * @param UserEmailMessageRequest $request
     * @return mixed
     */
    public function saveEmailByCertification(UserEmailMessageRequest $request)
    {
        //JSON response
        $data = [
            'successful' => false,
            'message' => Lang::get('sige.ErrorUpdateMessage')
        ];
        //Update Email
        $user = $this->userRepository->updateEmailCertification($request["user"], $request);
        if ($user) {
            $data["successful"] = true;
            $data["message"] = Lang::get('sige.SuccessUpdateMessage');
        }
        return response()->json($data);
    }


    /**
     * View Profile
     * @param $user
     * @return mixed
     */
    public function profile($user){
        return view('users.profile')->withUser($user);
    }
}