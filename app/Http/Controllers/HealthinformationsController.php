<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\HealthinformationRequest;
use SigeTurbo\Repositories\Healthinformation\HealthinformationRepositoryInterface;

class HealthinformationsController extends Controller
{
    /**
     * @var HealthinformationRepositoryInterface
     */
    private $healthinformationRepository;

    /**
     * HealthinformationController constructor.
     * @param HealthinformationRepositoryInterface $healthinformationRepository
     */
    public function __construct(HealthinformationRepositoryInterface $healthinformationRepository)
    {
        $this->healthinformationRepository = $healthinformationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /healthinformation
     * @return Response
     */
    public function index()
    {
        return response()->json($this->healthinformationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /healthinformation/{id}
     * @param  int $healthinformation
     * @return Response
     */
    public function show($healthinformation)
    {
        return response()->json($this->healthinformationRepository->find($healthinformation));
    }


    /**
     * Update the specified resource in storage.
     * @param HealthinformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HealthinformationRequest $request)
    {
        //Create Healthdata
        $healthinformation = $this->healthinformationRepository->store($request);

        $data = [];
        if ($healthinformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['healthinformation'] = $healthinformation;
            //Delete Cache
            Cache::forget('healthinformations');
            return redirect()
            ->route('admissions.students.edit', ['student' => $healthinformation->iduser, 'item' => 3])
            ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        }else{
            return redirect()
            ->route('admissions.students.edit', ['student' => $healthinformation->iduser, 'item' => 3])
            //->withItem(3) //Tampoco da
            ->withErrors($request)
            ->withInput($request)
            ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $healthinformation
     * @param HealthinformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($healthinformation, HealthinformationRequest $request)
    {
        //Update Healthdata
        $healthinformation = $this->healthinformationRepository->update($healthinformation, $request);

        $data = [];
        if ($healthinformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('healthdatas');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['healthinformation_user'],'item' => 3])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }

}