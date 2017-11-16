<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\OrigeninformationRequest;
use SigeTurbo\Repositories\Origeninformation\OrigeninformationRepositoryInterface;

class OrigeninformationsController extends Controller
{
    /**
     * @var OrigeninformationRepositoryInterface
     */
    private $origeninformationRepository;

    /**
     * OrigeninformationsController constructor.
     * @param OrigeninformationRepositoryInterface $origeninformationRepository
     */
    public function __construct(OrigeninformationRepositoryInterface $origeninformationRepository)
    {
        $this->origeninformationRepository = $origeninformationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /identificationtypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->origeninformationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /origeninformation/{id}
     * @param  int $origeninformation
     * @return Response
     */
    public function show($origeninformation)
    {
        return response()->json($this->OrigeninformationRepository->find($origeninformation));
    }


    /**
     * Update the specified resource in storage.
     * @param OrigeninformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrigeninformationRequest $request)
    {
        //Create origeninformation
        $origeninformation = $this->origeninformationRepository->store($request);

        $data = [];
        if ($origeninformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['origeninformation'] = $origeninformation;
            //Delete Cache
            Cache::forget('origeninformations');
            return redirect()
                ->route('admissions.students.edit', ['student' => $origeninformation->iduser, 'item' => 5])
                ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        }else{
            return redirect()
            ->route('admissions.students.edit', ['student' => $origeninformation->iduser, 'item' => 5])
            //->withItem(5) //Tampoco da
            ->withErrors($request)
            ->withInput($request)
            ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $origeninformation
     * @param OrigeninformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($origeninformation, OrigeninformationRequest $request)
    {
        //Update origeninformation
        $origeninformation = $this->origeninformationRepository->update($origeninformation, $request);

        $data = [];
        if ($origeninformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('origeninformations');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['origeninformation_user'],'item' => 5])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }

}
