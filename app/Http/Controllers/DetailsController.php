<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\DetailRequest;
use SigeTurbo\Repositories\Detail\DetailRepositoryInterface;
use SigeTurbo\Repositories\Purchase\PurchaseRepositoryInterface;

class DetailsController extends Controller
{
    /**
     * @var DetailRepositoryInterface
     */
    private $detailRepository;
    /**
     * @var PurchaseRepositoryInterface
     */
    private $purchaseRepository;

    /**
     * @param DetailRepositoryInterface $detailRepository
     * @param PurchaseRepositoryInterface $purchaseRepository
     */
    function __construct(DetailRepositoryInterface $detailRepository,PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->detailRepository = $detailRepository;
        $this->purchaseRepository = $purchaseRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /details
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response()->json($this->detailRepository->all($request["purchase"]));
    }

    /**
     * Create Detail
     * @param $idpurchase
     * @return mixed
     */
    public function create($idpurchase){
        return view('details.create')->withPurchase($this->purchaseRepository->find($idpurchase));
    }

    /**
     * Store a newly created resource in storage.
     * @param DetailRequest $request
     * @return Response
     */
    public function store(DetailRequest $request)
    {
        //Save Detail
        $detail = $this->detailRepository->store($request);

        $data = [];
        if ($detail) {
            $data['successful'] = true;
            Cache::forget('details'.$request['purchase']);
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['detail'] = $detail;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     * @param  int $iddetail
     * @param DetailRequest $request
     * @return Response
     */
    public function update($iddetail, DetailRequest $request)
    {

        //Update Detail
        $detail = $this->detailRepository->update($iddetail, $request);
        $data = [];
        if ($detail) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('details'.$request['purchase']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }


    /**
     * Display the specified resource.
     * GET /details/{iddetail}
     * @param  int $iddetail
     * @return Response
     */
    public function show($iddetail)
    {
        return response()->json($this->detailRepository->find($iddetail));
    }

}