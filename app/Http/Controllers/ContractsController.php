<?php
namespace SigeTurbo\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Http\Requests\ContractRequest;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Repositories\Contract\ContractRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ContractsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var CotractRepositoryInterface
     */
    private $contractRepository;

    /**
     * @param YearRepositoryInterface $yearRepository
     * @param MailerInterface $mailer
     * @internal param YearRepositoryInterface $yearRepository
     */
    function __construct(YearRepositoryInterface $yearRepository,ContractRepositoryInterface $contractRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->contractRepository = $contractRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /contracts
     * @return Response
     */
    public function index()
    {
        return response()->json(Contract::all());
    }

    /**
     * Display a listing of the resource.
     * GET /payments
     * @param Request $request
     * @return Response
     */
    public function init(Request $request)
    {    
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            /*'groups' => null,
            'status' => Statusschooltype::STATUS_ACTIVE,          
            'allregistries' => true ,*/
            'page' => 1,
            'option' => 'contract'
        ];
        /*$usersnotin = null;
        //Search
       
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
        
        $paginator = new LengthAwarePaginator(
            $pendings->forPage($page, $perPage), $pendings->count(), $perPage, $page
        );
        //dd($search);*/
        //$paginator->setPath('formation/contracts');
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

    /**
     * Display the specified resource.
     * GET /contracts/{idcontract}
     * @param  int $idcontract
     * @return Response
     */
    public function show($idcontract)
    {
        return response()->json(Contract::find($idcontract));
    }

     /**
     * Store a newly created resource in storage.
     * @param ContractRequest $request
     * @return Response
     */
    public function store(ContractRequest $request)
    {
        //Save Quantitativerecovery
        $contract = $this->contractRepository->store($request);
        $data = [];
        if ($contract) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $contract->idcontract;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idcontract
     * @param Request $request
     * @return Response
     */
    public function update($idcontract, ContractRequest $request)
    {
        //Update quantitativerecovery
        $contract = $this->contractRepository->update($idcontract, $request);
        $data = [];
        if ($contract) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idcontract'] = $idcontract;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Contracts By Year
     * @param Request $request
     * @return mixed
     */
    public function getcontractsbyyearandperiod(Request $request)
    {    
        return response()->json($this->contractRepository->getContractsByYearAndPeriod($request['idyear'], $request['idperiod']));
    }

    /**
     * Get Contracts By Parameters
     * @param Request $request
     * @return mixed
     */
    public function getcontractsbyparams(Request $request)
    {   
        $idyear = ( $request->has('idyear') ) ? $request['idyear'] : null;
        $idperiod = ($request->has('idperiod')) ? $request['idperiod'] : null;
        $idgroup = ($request->has('idgroup')) ? $request['idgroup'] : null;
        $idsubject = ($request->has('idsubject')) ? $request['idsubject'] : null;
        $idnivel = ($request->has('idnivel')) ? $request['idnivel'] : null;
        $iduser = ($request->has('iduser')) ? $request['iduser'] : null;
        //dd($idyear,$idperiod,$idgroup,$idsubject,$idnivel,$iduser);
        return response()->json($this->contractRepository->getContractsByParams($idyear,$idperiod,$idgroup,$idsubject,$idnivel,$iduser));
    }
}