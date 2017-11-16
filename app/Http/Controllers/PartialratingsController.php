<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\PartialRequest;
use SigeTurbo\Repositories\Partial\PartialRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;

class PartialratingsController extends Controller
{
    /**
     * @var PartialRepositoryInterface
     */
    private $partialRepository;

    /**
     * PartialratingsController constructor.
     * @param PartialRepositoryInterface $partialRepository
     */
    public function __construct(PartialRepositoryInterface $partialRepository)
    {
        $this->partialRepository = $partialRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /partialratings
     * @return Response
     */
    public function index()
    {
        return view('partialratings.index');
    }

    /**
     * Display the specified resource.
     * GET /partialratings/{idpartialrating}
     * @param  int $idpartialrating
     * @return Response
     */
    public function show($idpartialrating)
    {
        return response()->json($this->partialRepository->find($idpartialrating));
    }

    /**
     * Store a newly created resource in storage.
     * @param PartialRequest $request
     * @return Response
     */
    public function store(PartialRequest $request)
    {

        //Save Partial
        $partial = $this->partialRepository->store($request);

        $data = [];
        if ($partial) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $partial->idpartialrating;
            //Delete Cache
            Cache::forget('partial_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
            //Stream
            $student = User::find($request['user']);
            $subject = Subject::find($request['subject']);
            event(new Stream(['description' => "ingresó una Calificación Parcial para $student->lastname $student->firstname en " . $subject->name]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idpartial
     * @param PartialRequest $request
     * @return Response
     */
    public function update($idpartial, PartialRequest $request)
    {

        //Update Partial
        $partial = $this->partialRepository->update($idpartial, $request);

        $data = [];
        if ($partial) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('partial_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idpartial
     * @param PartialRequest $request
     * @return Response
     */
    public function destroy($idpartial, PartialRequest $request)
    {
        //Delete Partial
        $partial = $this->partialRepository->destroy($idpartial);

        $data = [];
        if ($partial) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('partial_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }


}