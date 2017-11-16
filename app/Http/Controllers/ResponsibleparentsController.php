<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepositoryInterface;
use SigeTurbo\Http\Requests\ResponsibleparentRequest;

class ResponsibleparentsController extends Controller
{
    /**
     * @var ResponsibleparentRepositoryInterface
     */
    private $responsibleparentRepository;

    /**
     * ResponsibleparentsController constructor.
     * @param ResponsibleparentRepositoryInterface $responsibleparentRepository
     */
    public function __construct(ResponsibleparentRepositoryInterface $responsibleparentRepository)
    {
        $this->responsibleparentRepository = $responsibleparentRepository;
    }

    /**
     * Get Responsibleparent By Student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponsibleparentByStudent(Request $request)
    {
        return response()->json($this->responsibleparentRepository->getResponsibleByStudent($request['student']));
    }

    /**
     * Update the specified resource in storage.
     * @param ResponsibleparentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResponsibleparentRequest $request)
    {
        //Create responsibleparent
        $responsibleparent = $this->responsibleparentRepository->store($request);

        $data = [];
        if ($responsibleparent) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['responsibleparent'] = $responsibleparent;
            //Delete Cache
            Cache::forget('responsibleparents');
            return redirect()
                ->route('admissions.students.edit', ['student' => $responsibleparent->iduser, 'item' => 7])
                ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        }else{
            return redirect()
            ->route('admissions.students.edit', ['student' => $responsibleparent->iduser, 'item' => 7])
            //->withItem(5) //Tampoco da
            ->withErrors($request)
            ->withInput($request)
            ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  int $responsibleparent
     * @param ResponsibleparentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($responsibleparent, ResponsibleparentRequest $request)
    {
        //dd($responsibleparent);
        //Update origeninformation
        $responsibleparent = $this->responsibleparentRepository->update($responsibleparent, $request);

        $data = [];
        if ($responsibleparent) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('responsibleparents');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['responsibleparent_user'],'item' => 7])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }

}
