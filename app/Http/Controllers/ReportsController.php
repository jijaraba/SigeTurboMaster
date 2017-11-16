<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use SigeTurbo\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;

class ReportsController extends Controller
{
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;

    /**
     * ReportsController constructor.
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     */
    public function __construct(UserfamilyRepositoryInterface $userfamilyRepository)
    {
        $this->userfamilyRepository = $userfamilyRepository;
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
}
