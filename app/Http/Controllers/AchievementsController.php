<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Group;
use SigeTurbo\Http\Requests\AchievementRequest;
use SigeTurbo\Repositories\Achievement\AchievementRepositoryInterface;

class AchievementsController extends Controller
{


    /**
     * @var AchievementRepositoryInterface
     */
    private $achievementRepository;


    /**
     * @param AchievementRepositoryInterface $achievementRepository
     */
    public function __construct(AchievementRepositoryInterface $achievementRepository)
    {
        $this->achievementRepository = $achievementRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /achievements
     * @return Response
     */
    public function index()
    {
        return response()->json($this->achievementRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /achievements/{idachievement}
     * @param  int $idachievement
     * @return Response
     */
    public function show($idachievement)
    {
        return response()->json($this->achievementRepository->find($idachievement));
    }

    /**
     * Store a newly created resource in storage.
     * @param AchievementRequest $request
     * @return Response
     */
    public function store(AchievementRequest $request)
    {

        //Save Achievement
        $achievement = $this->achievementRepository->store($request);

        $data = [];
        if ($achievement) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $achievement->idachievment;
            //Delete Cache
            Cache::forget('achievement_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
            //Stream
            $grade = Group::find($request['group']);
            event(new Stream(['description' => "ingresó un Logro para el grado $grade->name"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idachievement
     * @param AchievementRequest $request
     * @return Response
     */
    public function update($idachievement, AchievementRequest $request)
    {

        //Update Achievement
        $achievement = $this->achievementRepository->update($idachievement, $request);

        $data = [];
        if ($achievement) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('achievement_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idachievement
     * @param AchievementRequest $request
     * @return Response
     */
    public function destroy($idachievement, AchievementRequest $request)
    {
        //Delete Achievement
        $achievement = $this->achievementRepository->destroy($idachievement);

        $data = [];
        if ($achievement) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('achievement_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

    /**
     * Display Achievements by Group
     * @param Request $request
     * @return string
     */
    public function getAchievements(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),500);
        }
        return response()->json($this->achievementRepository->getAchievements($request));
    }

}