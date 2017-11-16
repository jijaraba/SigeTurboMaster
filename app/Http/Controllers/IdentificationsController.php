<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\IdentificationRequest;
use SigeTurbo\Repositories\Identification\IdentificationRepositoryInterface;

class IdentificationsController extends Controller
{
    /**
     * @var IdentificationRepositoryInterface
     */
    private $identificationRepository;

    /**
     * IdentificationsController constructor.
     * @param IdentificationRepositoryInterface $identificationRepository
     */
    public function __construct(IdentificationRepositoryInterface $identificationRepository)
    {
        $this->identificationRepository = $identificationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /identificationtypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->identificationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /identification/{id}
     * @param  int $identification
     * @return Response
     */
    public function show($identification)
    {
        return response()->json($this->identificationRepository->find($identification));
    }


    /**
     * Update the specified resource in storage.
     * @param IdentificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdentificationRequest $request)
    {

        //Create Identification
        $identification = $this->identificationRepository->store($request);

        $data = [];
        if ($identification) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['identification'] = $identification;
            //Delete Cache
            Cache::forget('identifications');
            return redirect()
            ->route('admissions.students.edit', ['student' => $identification->iduser, 'item' => 2])
            ->withItem(2)
            ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        }else{
            return redirect()
            ->route('admissions.students.edit', ['student' => $origeninformation->iduser, 'item' => 2])
            //->withItem(2) //Tampoco da
            ->withErrors($request)
            ->withInput($request)
            ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $identification
     * @param IdentificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($identification, IdentificationRequest $request)
    {
        //Update Identification
        $identification = $this->identificationRepository->update($identification, $request);

        $data = [];
        if ($identification) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('identifications');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['identification_user'],'item' => 2])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }

}
