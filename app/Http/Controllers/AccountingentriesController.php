<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Costcenter;
use SigeTurbo\Http\Requests\AccountingentryRequest;
use SigeTurbo\Repositories\Accountingentry\AccountingentryRepositoryInterface;
use SigeTurbo\Repositories\Accounttype\AccounttypeRepositoryInterface;
use SigeTurbo\Repositories\Costcenter\CostcenterRepositoryInterface;
use SigeTurbo\Repositories\Vouchertype\VouchertypeRepositoryInterface;

class AccountingentriesController extends Controller
{
    /**
     * @var AccountingentryRepositoryInterface
     */
    private $accountingentryRepository;
    /**
     * @var AccounttypeRepositoryInterface
     */
    private $accounttypeRepository;
    /**
     * @var CostcenterRepositoryInterface
     */
    private $costcenterRepository;

    /**
     * AccountingentriesController constructor.
     * @param AccountingentryRepositoryInterface $accountingentryRepository
     * @param AccounttypeRepositoryInterface $accounttypeRepository
     * @param CostcenterRepositoryInterface $costcenterRepository
     */
    public function __construct(AccountingentryRepositoryInterface $accountingentryRepository,
                                AccounttypeRepositoryInterface $accounttypeRepository,
                                CostcenterRepositoryInterface $costcenterRepository)
    {
        $this->accountingentryRepository = $accountingentryRepository;
        $this->accounttypeRepository = $accounttypeRepository;
        $this->costcenterRepository = $costcenterRepository;
    }


    /**
     * Store a newly created resource in storage.
     * @param AccountingentryRequest $request
     * @return Response
     */
    public function store(AccountingentryRequest $request)
    {

        //Find Accounttype
        $request['accounttype'] = $this->accounttypeRepository->findAccountByCode($request['accounttype'])->idaccounttype;
        //Find Costcenter
        if (isset($request['costcenter']) && $request['costcenter'] == '') {
            $request['costcenter'] = 1;
        }
        $request['costcenter'] = $this->costcenterRepository->findCostcenterByCode($request['costcenter'])->idcostcenter;

        //Save Accountingentry
        $accountingentry = $this->accountingentryRepository->store($request);

        $data = [];
        if ($accountingentry) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['accountingentry'] = $accountingentry;
            //Delete Cache
            Cache::forget('accountingentries');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param $accountingentry
     * @param AccountingentryRequest $request
     * @return Response
     */
    public function update($accountingentry, AccountingentryRequest $request)
    {

        //Find Accounttype
        $request['accounttype'] = $this->accounttypeRepository->findAccountByCode($request['accounttype'])->idaccounttype;
        //Find Costcenter
        if (!is_null($request['costcenter']) && $request['costcenter'] !== '' && $request['costcenter'] !== 0) {
            $request['costcenter'] = $this->costcenterRepository->findCostcenterByCode($request['costcenter'])->idcostcenter;
        } else {
            $request['costcenter'] = Costcenter::DEFAULT;
        }


        //Update Accountingentry
        $accountingentry = $this->accountingentryRepository->update($accountingentry, $request);
        $data = [];
        if ($accountingentry) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['accountingentry'] = $accountingentry;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param $accountingentry
     * @return Response
     */
    public function destroy($accountingentry)
    {
        //Delete Transactions
        $accountingentry = $this->accountingentryRepository->destroy($accountingentry);

        $data = [];
        if ($accountingentry) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Accountingentries By Receipt
     * @param Request $request
     * @return mixed
     */
    public function getAccountingentriesByReceipt(Request $request)
    {
        return response()->json($this->accountingentryRepository->getAccountingentriesByReceipt($request['receipt']));
    }
}
