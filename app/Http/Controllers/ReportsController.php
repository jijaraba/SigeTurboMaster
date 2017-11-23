<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Http\Requests\ReportRequest;
use SigeTurbo\Repositories\Report\ReportRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;

class ReportsController extends Controller
{
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var ReportRepositoryInterface
     */
    private $reportRepository;

    /**
     * ReportsController constructor.
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param ReportRepositoryInterface $reportRepository
     */
    public function __construct(UserfamilyRepositoryInterface $userfamilyRepository, ReportRepositoryInterface $reportRepository)
    {
        $this->userfamilyRepository = $userfamilyRepository;
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getReportsByFamily(Request $request)
    {
        //Sort
        $sort = 'realdate';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $users = $this->userfamilyRepository->getMembersFamilyByUser(getUser()->iduser);
        $paginator = new LengthAwarePaginator(
            $users->forPage($page, $perPage), $users->count(), $perPage, $page
        );
        $paginator->setPath('parents/reports');
        return view('reports.reportspartialsbyfamily')
            ->withUsers($paginator)
            ->withSort($sort)
            ->withOrder($order);

    }

    /**
     * Save Report
     * @param ReportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReportRequest $request)
    {
        //Save Report
        $report = $this->reportRepository->store($request);
        $data = [];
        if ($report) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $report->idreport;
            $data['report'] = $report;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Report By Student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReportByStudent(Request $request)
    {
        return response()->json($this->reportRepository->getReportByStudent($request['year'], $request['period'], $request['user'], $request['type']));
    }

}
