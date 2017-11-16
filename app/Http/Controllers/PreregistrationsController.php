<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
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
     * PUT /preregistrations/{idpreregistrationrecovery}
     * @param int $idpreregistrationrecovery
     * @param PreregistrationRequest $request
     * @return Response
     */
    public function update($idpreregistrationrecovery, PreregistrationRequest $request)
    {
        //Update preregistrationrecovery
        $preregistrationrecovery = $this->preregistrationRepository->update($idpreregistrationrecovery, $request);

        $data = [];
        if ($preregistrationrecovery) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idquantitativerecovery'] = $idpreregistrationrecovery;

            //Delete Cache
            Cache::forget('preregistration' . $request['user']);

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /preregistrations/{id}
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
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

}