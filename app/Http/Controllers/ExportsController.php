<?php

namespace SigeTurbo\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use SigeTurbo\Report\GenerateReport;
use SigeTurbo\Repositories\Group\GroupRepositoryInterface;
use SigeTurbo\Repositories\Task\TaskRepositoryInterface;
use SigeTurbo\Repositories\Transaction\TransactionRepositoryInterface;
use SigeTurbo\Services\CloudService;

class ExportsController extends Controller
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * ExportsController constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param TransactionRepositoryInterface $transactionRepository
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository,
                                TransactionRepositoryInterface $transactionRepository,
                                GroupRepositoryInterface $groupRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->transactionRepository = $transactionRepository;
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display Export Student Enrollments
     * GET /exports
     * @param Request $request
     * @return Response
     */
    public function exportStudentEnrollments(Request $request)
    {
        //Generate Report
        $report = new GenerateReport(env('JASPERSERVER_HOST'), env('JASPERSERVER_PORT'));
        //Run Report
        $path = storage_path() . '/sigeturbo/report';
        $format = $request["format"];
        $type = "export";
        $fileName = fileName($request["filename"]);
        $controls = array('yearID' => $request['year']);
        $pagination = null;
        if ($request["format"] == "xlsx") {
            $pagination = true;
        }
        $response = $report->run($path, '/reports/sigeturbo/Students/Student', $format, $fileName, $controls, $pagination);
        if (is_bool($response) === true && $response === true) { //Binary Response
            //Upload To CDN
            $cloud = new CloudService();
            if ($cloud->uploadExport($type, $path, $fileName . '.' . $format)) {
                return response()->json(['file' => $fileName . '.' . $format]);
            }
        } else { //HTML Response
            echo $response;
        }
    }


    /**
     * Display Export Payment Reports
     * GET /exports
     * @param Request $request
     * @return Response
     */
    public function exportPaymentsReports(Request $request)
    {
        //Generate Report
        $report = new GenerateReport(env('JASPERSERVER_HOST'), env('JASPERSERVER_PORT'));

        //Global Variables
        $path = storage_path() . '/sigeturbo/report';
        $format = $request["format"];
        $type = "export";
        $fileName = fileName($request["filename"]);
        $controls = array('paymentID' => $request['payment']);
        $pagination = null;
        if ($request["format"] == "xlsx") {
            $pagination = true;
        }

        //Run Report
        $response = $report->run($path, $this->configPaymentsReport($request['filename']), $format, $fileName, $controls, $pagination);
        if (is_bool($response) === true && $response === true) { //Binary Response
            //Upload To CDN
            $cloud = new CloudService();
            if ($cloud->uploadExport($type, $path, $fileName . '.' . $format)) {
                return response()->json(['file' => $fileName . '.' . $format]);
            }
        } else { //HTML Response
            echo $response;
        }
    }


    /**
     * Display Export Partial Reports
     * GET /exports/partials
     * @param Request $request
     * @return Response
     */
    public function exportReportsPartials(Request $request)
    {
        //Generate Report
        $report = new GenerateReport(env('JASPERSERVER_HOST'), env('JASPERSERVER_PORT'));

        //Global Variables
        $path = storage_path() . '/sigeturbo/partialreport';
        $format = $request["format"];
        $type = "export";
        $fileName = fileName($request["filename"]);
        $controls = [
            'ACADEMIC_YEAR' => $request['year'],
            'ACADEMIC_PERIOD' => $request['period'],
            'STUDENT_ID' => $request['student'],
        ];
        $pagination = null;
        if ($request["format"] == "xlsx") {
            $pagination = true;
        }

        //Run Report
        $response = $report->run($path, $this->configReportPartial($request['student']), $format, $fileName, $controls, $pagination);
        if (is_bool($response) === true && $response === true) { //Binary Response
            //Upload To CDN
            $cloud = new CloudService();
            if ($cloud->uploadExport($type, $path, $fileName . '.' . $format)) {
                return response()->json(['file' => $fileName . '.' . $format]);
            }
        } else { //HTML Response
            echo $response;
        }
    }


    public function exportTransactionsToTxt(Request $request)
    {
        $content = view('exports.payments.txt')
            ->withTransactions($this->transactionRepository->getTransactionsToExport($request["vouchertype"],$request["starts"],$request["ends"]));
        if($request["type"] == "text/plain"){
            return response($content, 200)
                ->header('Content-Type', $request["type"].'; charset=UTF-8')
                ->header('Content-Encoding', 'UTF-8')
                ->header('X-Header-App', 'SigeTurbo')
                ->header('Content-Disposition', sprintf('attachment; filename="%s"', fileName('export')));
        }else{
            dd("Aun no se puede exportar a excel");
        }
    }

    /**
     * Config Payments Reports
     * @param $filename
     * @return string
     */
    private function configPaymentsReport($filename)
    {
        //Config Report
        switch ($filename) {
            case 'preform':
                return '/reports/sigeturbo/Payments/Preform';
                break;
            case 'invoice':
                return '/reports/sigeturbo/Payments/Invoice';
                break;
            case 'cash_receipt':
                return '/reports/sigeturbo/Payments/CashReceipt';
                break;
            case 'virtual_receipt':
                return '/reports/sigeturbo/Payments/VirtualReceipt';
                break;
            default:
                return '/reports/sigeturbo/Payments/Invoice';

        }
    }

    /**
     * Config Report Partial
     * @param $user
     * @return string
     */
    private function configReportPartial($user)
    {
        $group = $this->groupRepository->getLatestGroupByStudent($user);
        if ($group->idgroup <= 10) {
            return '/reports/sigeturbo/Partialreport/informeParcialNivel1_Individual_SinLogo';
        } else {
            return '/reports/sigeturbo/Partialreport/informeParcialNivel2y3_Individual_SinLogo';
        }
    }

}