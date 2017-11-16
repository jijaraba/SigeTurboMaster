<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\DescriptivereportRequest;
use SigeTurbo\Repositories\Descriptivereport\DescriptivereportRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;

class DescriptivereportsController extends Controller
{
    /**
     * @var DescriptivereportRepositoryInterface
     */
    private $descriptivereportRepository;

    /**
     * DescriptivereportsController constructor.
     * @param DescriptivereportRepositoryInterface $descriptivereportRepository
     */
    public function __construct(DescriptivereportRepositoryInterface $descriptivereportRepository)
    {
        $this->descriptivereportRepository = $descriptivereportRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /descriptivereports
     * @return Response
     */
    public function index()
    {
        return view('descriptivereports.index');
    }

    /**
     * Display the specified resource.
     * GET /descriptivereports/{iddescriptivereport}
     * @param  int $iddescriptivereport
     * @return Response
     */
    public function show($iddescriptivereport)
    {
        return response()->json($this->descriptivereportRepository->find($iddescriptivereport));
    }

    /**
     * Store a newly created resource in storage.
     * @param DescriptivereportRequest $request
     * @return Response
     */
    public function store(DescriptivereportRequest $request)
    {

        //Save Descriptivereport
        $descriptivereport = $this->descriptivereportRepository->store($request);

        $data = [];
        if ($descriptivereport) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $descriptivereport->iddescriptivereport;
            //Delete Cache
            Cache::forget('descriptivereport_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
            //Stream
            $student = User::find($request['user']);
            $subject = Subject::find($request['subject']);
            event(new Stream(['description' => "ingresó un Informe Descriptivo para $student->lastname $student->firstname en " . $subject->name]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $iddescriptivereport
     * @param DescriptivereportRequest $request
     * @return Response
     */
    public function update($iddescriptivereport, DescriptivereportRequest $request)
    {

        //Update Descriptivereport
        $descriptivereport = $this->descriptivereportRepository->update($iddescriptivereport, $request);

        $data = [];
        if ($descriptivereport) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('descriptivereport_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $iddescriptivereport
     * @param DescriptivereportRequest $request
     * @return Response
     */
    public function destroy($iddescriptivereport, DescriptivereportRequest $request)
    {
        //Delete Descriptivereport
        $descriptivereport = $this->descriptivereportRepository->destroy($iddescriptivereport);

        $data = [];
        if ($descriptivereport) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('descriptivereport_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }


}