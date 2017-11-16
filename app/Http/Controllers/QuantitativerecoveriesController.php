<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\QuantitativerecoveryRequest;
use SigeTurbo\Repositories\Quantitativerecovery\QuantitativerecoveryRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;

class QuantitativerecoveriesController extends Controller
{
    /**
     * @var QuantitativerecoveryRepositoryInterface
     */
    private $quantitativeRecovery;


    /**
     * @param QuantitativerecoveryRepositoryInterface $quantitativeRecovery
     */
    function __construct(QuantitativerecoveryRepositoryInterface $quantitativeRecovery)
    {

        $this->quantitativeRecovery = $quantitativeRecovery;
    }

    /**
     * Display a listing of the resource.
     * GET /quantitativerecoveries
     * @return Response
     */
    public function index()
    {
        return response()->json($this->quantitativeRecovery->all());
    }

    /**
     * Display the specified resource.
     * GET /quantitativerecoveries/{id}
     *
     * @param  int $idquantitativerecovery
     * @return Response
     */
    public function show($idquantitativerecovery)
    {
        return response()->json($this->quantitativeRecovery->find($idquantitativerecovery));
    }


    /**
     * Store a newly created resource in storage.
     * @param QuantitativerecoveryRequest $request
     * @return Response
     */
    public function store(QuantitativerecoveryRequest $request)
    {
        //Save Quantitativerecovery
        $quantitativerecovery = $this->quantitativeRecovery->store($request);
        $data = [];
        if ($quantitativerecovery) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $quantitativerecovery->idquantitativerecovery;
            //Stream
            $student = User::find($request['user']);
            $subject = Subject::find($request['subject']);
            event(new Stream(['description' => "ingresó una Recuperación para $student->firstname $student->lastname en $subject->name (" . $request['recovery'] . ")"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idquantitativerecovery
     * @param Request $request
     * @return Response
     */
    public function update($idquantitativerecovery, Request $request)
    {
        //Update quantitativerecovery
        $quantitativerecovery = $this->quantitativeRecovery->update($idquantitativerecovery, $request);
        $data = [];
        if ($quantitativerecovery) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idquantitativerecovery'] = $idquantitativerecovery;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idquantitativerecovery
     * @return Response
     */
    public function destroy($idquantitativerecovery)
    {
        //Delete Quantitativerecovery
        $quantitativerecovery = $this->quantitativeRecovery->delete($idquantitativerecovery);

        $data = [];
        if ($quantitativerecovery) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }


    public function getrecoverybyuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
            'user' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        //Get Recovery
        $quantitativerecovery = $this->quantitativeRecovery->getRecoveryByUser($request);
        return response()->json($quantitativerecovery);
    }
}