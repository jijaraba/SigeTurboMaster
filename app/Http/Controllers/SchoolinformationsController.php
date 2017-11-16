<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\SchoolinformationRequest;
use SigeTurbo\Repositories\Schoolinformation\SchoolinformationRepositoryInterface;
use SigeTurbo\Schoolinformation;

class SchoolinformationsController extends Controller
{
    /**
     * @var SchoolinformationRepositoryInterface
     */
    private $schoolinformationRepository;

    /**
     * SchoolinformationsController constructor.
     * @param SchoolinformationRepositoryInterface $schoolinformationRepository
     */
    public function __construct(SchoolinformationRepositoryInterface $schoolinformationRepository)
    {
        $this->schoolinformationRepository = $schoolinformationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /schoolinformations
     * @return Response
     */
    public function index()
    {
        return response()->json($this->schoolinformationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /schoolinformation/{id}
     * @param  int $schoolinformation
     * @return Response
     */
    public function show($schoolinformation)
    {
        return response()->json($this->schoolinformationRepository->find($schoolinformation));
    }

    /**
     * Update the specified resource in storage.
     * @param SchoolinformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolinformationRequest $request)
    {
        //Create Schoolinformation
        $schoolinformation = $this->schoolinformationRepository->store($request);

        $data = [];
        if ($schoolinformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['schoolinformation'] = $schoolinformation;
            //Delete Cache
            Cache::forget('schoolinformation');
            return redirect()
                ->route('admissions.students.edit', ['student' => $schoolinformation->iduser, 'item' => 4])
                ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        }else{
            return redirect()
                ->route('admissions.students.edit', ['student' => $schoolinformation->iduser, 'item' => 4])
                //->withItem(4) //Tampoco da
                ->withErrors($request)
                ->withInput($request)
                ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $schoolinformation
     * @param SchoolinformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($schoolinformation, SchoolinformationRequest $request)
    {
        
        //Update Identification
        $schoolinformation = $this->schoolinformationRepository->update($schoolinformation, $request);

        $data = [];
        if ($schoolinformation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('schoolinformations');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['schoolinformation_user'], 'item' => 4])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }
}
