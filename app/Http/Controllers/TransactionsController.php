<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\TransactionRequest;
use SigeTurbo\Repositories\Accounttype\AccounttypeRepositoryInterface;
use SigeTurbo\Repositories\Costcenter\CostcenterRepositoryInterface;
use SigeTurbo\Repositories\Transaction\TransactionRepositoryInterface;
use SigeTurbo\Repositories\Vouchertype\VouchertypeRepositoryInterface;

class TransactionsController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var VouchertypeRepositoryInterface
     */
    private $vouchertypeRepository;
    /**
     * @var AccounttypeRepositoryInterface
     */
    private $accounttypeRepository;
    /**
     * @var CostcenterRepositoryInterface
     */
    private $costcenterRepository;

    /**
     * TransactionsController constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     * @param VouchertypeRepositoryInterface $vouchertypeRepository
     * @param AccounttypeRepositoryInterface $accounttypeRepository
     * @param CostcenterRepositoryInterface $costcenterRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository,
                                VouchertypeRepositoryInterface $vouchertypeRepository,
                                AccounttypeRepositoryInterface $accounttypeRepository,
                                CostcenterRepositoryInterface $costcenterRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->vouchertypeRepository = $vouchertypeRepository;
        $this->accounttypeRepository = $accounttypeRepository;
        $this->costcenterRepository = $costcenterRepository;
    }


    /**
     * Store a newly created resource in storage.
     * @param TransactionRequest $request
     * @return Response
     */
    public function store(TransactionRequest $request)
    {

        //Find Vouchertype
        $request['vouchertype'] = $this->vouchertypeRepository->findVoucherByCode($request['vouchertype'])->idvouchertype;
        //Find Accounttype
        $request['accounttype'] = $this->accounttypeRepository->findAccountByCode($request['accounttype'])->idaccounttype;
        //Find Costcenter
        $request['costcenter'] = $this->costcenterRepository->findCostcenterByCode($request['costcenter'])->idcostcenter;

        //Save Transaction
        $transaction = $this->transactionRepository->store($request);

        $data = [];
        if ($transaction) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['transaction'] = $transaction;
            //Delete Cache
            Cache::forget('transactions');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param $idtransaction
     * @param TransactionRequest $request
     * @return Response
     */
    public function update($idtransaction, TransactionRequest $request)
    {

        //Find Vouchertype
        $request['vouchertype'] = $this->vouchertypeRepository->findVoucherByCode($request['vouchertype'])->idvouchertype;
        //Find Accounttype
        $request['accounttype'] = $this->accounttypeRepository->findAccountByCode($request['accounttype'])->idaccounttype;
        //Find Costcenter
        $request['costcenter'] = $this->costcenterRepository->findCostcenterByCode($request['costcenter'])->idcostcenter;

        //Update Transaction
        $transaction = $this->transactionRepository->update($idtransaction, $request);
        $data = [];
        if ($transaction) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['transaction'] = $transaction;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idtransaction
     * @return Response
     */
    public function destroy($idtransaction)
    {
        //Delete Transactions
        $transaction = $this->transactionRepository->destroy($idtransaction);

        $data = [];
        if ($transaction) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Transactions By Payment
     * @param Request $request
     * @return mixed
     */
    public function getTransactionsByPayment(Request $request)
    {
        return response()->json($this->transactionRepository->getTransactionsByPayment($request['payment']));
    }

    /**
     * Find Voucher In Transaction With Payment
     * @param Request $request
     * @return mixed
     */
    public function findVoucherInTransactions(Request $request)
    {
        return response()->json($this->transactionRepository->findVoucherInTransactions($request['payment'], $request['code']));
    }

}
