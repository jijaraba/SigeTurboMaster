<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\PreregistrationAdditionalRequest;
use SigeTurbo\Http\Requests\PreregistrationMedicalRequest;
use SigeTurbo\Http\Requests\PreregistrationRequest;
use SigeTurbo\Repositories\Preregistration\PreregistrationRepositoryInterface;

class PreregistrationsController extends Controller
{
    /**
     * @var PreregistrationRepositoryInterface
     */
    private $preregistrationRepository;


    /**
     * @param PreregistrationRepositoryInterface $preregistrationRepository
     * @internal param PreregistrationRepositoryInterface $preregistrationrecovery
     */
    function __construct(PreregistrationRepositoryInterface $preregistrationRepository)
    {

        $this->preregistrationRepository = $preregistrationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /preregistrations
     * @return Response
     */
    public function index()
    {
        return response()->json($this->preregistrationRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /preregistrations
     * @param PreregistrationRequest $request
     * @return Response
     */
    public function store(PreregistrationRequest $request)
    {
        //Save Preregistration
        $preregistrationrecovery = $this->preregistrationRepository->store($request);

        $data = [];
        if ($preregistrationrecovery) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $preregistrationrecovery->idpreregistration;
            //Delete Cache
            Cache::forget('preregistration' . $request['user']);

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     * GET /preregistrations/{id}
     * @param  int $idpreregistration
     * @return Response
     */
    public function show($idpreregistration)
    {
        return response()->json($this->preregistrationRepository->find($idpreregistration));
    }


    /**
     * Update the specified resource in storage.
     * PUT /preregistrations/{preregistration}
     * @param int $preregistration
     * @param PreregistrationRequest $request
     * @return Response
     */
    public function update($preregistration, PreregistrationRequest $request)
    {
        //Update preregistrationrecovery
        $preregistration = $this->preregistrationRepository->update($preregistration, $request);

        $data = [];
        if ($preregistration) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['preregistration'] = $preregistration;

            //Delete Cache
            Cache::forget('preregistrations');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /preregistrations/{preregistration}
     * @param  int $preregistration
     * @return Response
     */
    public function destroy($preregistration)
    {
        //
    }

    /**
     * Get Preregistration by User
     * @param Request $request
     * @return mixed
     */
    public function getpreregistrationbyuser(Request $request)
    {
        return response()->json($this->preregistrationRepository->getByUser($request['user']));
    }

    /**
     * Update Preregistration General
     * @param $preregistration
     * @param PreregistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileGeneral($preregistration, PreregistrationRequest $request)
    {
        //Update preregistration
        $preregistration = $this->preregistrationRepository->updateProfileGeneral($preregistration, $request);

        $data = [];
        if ($preregistration) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['preregistration'] = $preregistration;

            //Delete Cache
            Cache::forget('preregistrations');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Update Preregistration Medical
     * @param $preregistration
     * @param PreregistrationMedicalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileMedical($preregistration, PreregistrationMedicalRequest $request)
    {
        //Update preregistration
        $preregistration = $this->preregistrationRepository->updateProfileMedical($preregistration, $request);

        $data = [];
        if ($preregistration) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['preregistration'] = $preregistration;

            //Delete Cache
            Cache::forget('preregistrations');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Update Preregistration Additional
     * @param $preregistration
     * @param PreregistrationAdditionalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileAdditional($preregistration, PreregistrationAdditionalRequest $request)
    {
        //Update preregistration
        $preregistration = $this->preregistrationRepository->updateProfileAdditional($preregistration, $request);

        $data = [];
        if ($preregistration) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['preregistration'] = $preregistration;

            //Delete Cache
            Cache::forget('preregistrations');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Update Preregistration Profession
     * @param $preregistration
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileProfession($preregistration, Request $request)
    {
        //Update preregistration
        $preregistration = $this->preregistrationRepository->updateProfileProfession($preregistration, $request);

        $data = [];
        if ($preregistration) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['preregistration'] = $preregistration;

            //Delete Cache
            Cache::forget('preregistrations');

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}