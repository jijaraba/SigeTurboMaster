<?php

namespace SigeTurbo\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\QuantitativerecoveryfinalareaRequest;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Repositories\Quantitativerecoveryfinalarea\QuantitativerecoveryfinalareaRepositoryInterface;
use SigeTurbo\Statusschooltype;

class QuantitativerecoveryfinalareasController extends Controller {

    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var QuantitativerecoveryfinalareaRepositoryInterface
     */
    private $quantitativerecoveryfinalareaRepository;

    /**
     * @param YearRepositoryInterface $yearRepository
     * @param MailerInterface $mailer
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param QuantitativerecoveryfinalareaRepositoryInterface $quantitativerecoveryfinalareaRepository
     * @internal param YearRepositoryInterface $yearRepository
     */
    function __construct(
                         YearRepositoryInterface $yearRepository,
                         EnrollmentRepositoryInterface $enrollmentRepository,
                         QuantitativerecoveryfinalareaRepositoryInterface $quantitativerecoveryfinalareaRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->quantitativerecoveryfinalareaRepository = $quantitativerecoveryfinalareaRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /payments
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
	{    
        $usersnotin = null;
		//Search
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'groups' => null,
            'status' => Statusschooltype::STATUS_ACTIVE,          
            'allregistries' => true ,
            'page' => 1
        ];
       
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
        }

        //Status
        $status = implode(",", $search['status']);
        if (isset($search['status'])) {
            $status = implode(",", $search['status']);
        }

        //Groups
        $groups = null; 
        if (isset($search['groups'])) {
            $groups = json_decode($search['groups'], true);
        }
        
        //User
        $users = null;
        if (isset($request['users'])) {
            $users = json_decode($request['users'], true);
        }
        
        //Area
        $area = null; 
        if (!isset($request['area'])) {
           $area = json_decode($request['area'], true);
        }

        //Página
        $page = LengthAwarePaginator::resolveCurrentPage();
        if (isset($request['page'])) {
           $page = json_decode($request['page'], true);
           $search['page'] = $page;
        }

        $perPage = 15;
        $pendings = $this->quantitativerecoveryfinalareaRepository->recoveriesPendingsPreviousYears($search["year"], $groups, $area, $status, $users, $usersnotin);
        //dd($pendings);        
        $paginator = new LengthAwarePaginator(
            $pendings->forPage($page, $perPage), $pendings->count(), $perPage, $page
        );
        //dd($search);
        $paginator->setPath('admissions/quantitativerecoveryfinalareas');
        return view('quantitativerecoveryfinalareas.index')
            ->withPendings($paginator)
            ->withSearch($search)
            ->withUserselected($users);
	}



    /**
     * Display a listing of the resource.
     * GET /payments
     * @param Request $request
     * @return Response
     */
    public function getrecoveriesbyuser(Request $request)
    {
        $search =   ['idyear' => null,"iduser" => null,'page' => 1,'mostrar' => 'Todos'];
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
        }

        $userselected =  null;
        if (isset($search['iduser'])) {
            if (!isset($search['idyear'])) {
                $search['idyear'] = $search['iduser']['Lastyear'];
                $userselected = $search['iduser']['iduser'];
            }
            $userselected = (is_array ($search['iduser']) == true ) ? $search['iduser']['iduser'] : $search['iduser'];
            $search['iduser'] = $userselected;
        }

        //Página
        $page = LengthAwarePaginator::resolveCurrentPage();
        if (isset($request['page'])) {
           $page = $request['page'];
           $search['page'] = $page;
        }
        $perPage = 10;
        $ratingselected = ($search['mostrar'] == "Todos") ? 5.1 : 3;

        $recoveries = $this->quantitativerecoveryfinalareaRepository->getHistoryByStudent($search['idyear'], $search['iduser'],$ratingselected);

        $paginator = new LengthAwarePaginator(
            $recoveries->forPage($page, $perPage), $recoveries->count(), $perPage, $page
        );

        $paginator->setPath('admissions/getrecoveriesbyuser');

        return view('quantitativerecoveryfinalareas.index')
            ->withPendings($paginator)
            ->withSearch($search)
            ->withUserselected($userselected);
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /quantitativerecoveryfinalareas
	 *
	 * @return Response
	 */
	public function store(QuantitativerecoveryfinalareaRequest $request)
	{
		//Save Quantitativerecoveryfinalarea
        $quantitativerecoveryfinalarea = $this->quantitativerecoveryfinalareaRepository->store($request);

        $data = [];
        if ($quantitativerecoveryfinalarea) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['quantitativerecoveryfinalarea'] = $quantitativerecoveryfinalarea;
            //Stream
            //$group = Group::find($request['group']);
            //event(new Stream(['description' => "ingresó una Tarea para el grupo $group->name"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /quantitativerecoveryfinalareas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idquantitativerecoveryfinalarea,QuantitativerecoveryfinalareaRequest $request)
	{
		//Update Quantitativerecoveryfinalareas
        $quantitativerecoveryfinalarea = $this->quantitativerecoveryfinalareaRepository->update($idquantitativerecoveryfinalarea, $request);
        $data = [];
        if ($quantitativerecoveryfinalarea) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['quantitativerecoveryfinalarea'] = $quantitativerecoveryfinalarea ;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
	}
}