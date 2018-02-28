<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Http\Requests\ReportRequest;
use SigeTurbo\Repositories\Groupdirector\GroupdirectorRepositoryInterface;
use SigeTurbo\Repositories\Payment\PaymentRepository;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
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
     * @var GroupdirectorRepositoryInterface
     */
    private $groupdirectorRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * ReportsController constructor.
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param ReportRepositoryInterface $reportRepository
     * @param GroupdirectorRepositoryInterface $groupdirectorRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(UserfamilyRepositoryInterface $userfamilyRepository,
                                ReportRepositoryInterface $reportRepository,
                                GroupdirectorRepositoryInterface $groupdirectorRepository,
                                PaymentRepositoryInterface $paymentRepository)
    {
        $this->userfamilyRepository = $userfamilyRepository;
        $this->reportRepository = $reportRepository;
        $this->groupdirectorRepository = $groupdirectorRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getReportsByFamily(Request $request)
    {

        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingsByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

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

        //Find Group
        $group = $this->groupdirectorRepository->getGroup(2017, getUser()->iduser);

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
            ->withOrder($order)
            ->withGroup($group);

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

    /**
     * Get Report Enabled By Student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReportEnabled(Request $request)
    {
        return response()->json($this->reportRepository->getReportEnabled($request['year'], $request['period'], $request['user'], $request['type']));
    }

}
