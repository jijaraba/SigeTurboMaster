<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Consent\ConsentRepositoryInterface;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\User;

class ConsentsController extends Controller
{
    /**
     * @var ConsentRepositoryInterface
     */
    private $consentRepository;

    /**
     * ConsentsController constructor.
     * @param ConsentRepositoryInterface $consentRepository
     */
    public function __construct(ConsentRepositoryInterface $consentRepository)
    {
        $this->consentRepository = $consentRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /consents
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = [
            'iduser' =>  getUser()->iduser,
            'page' => 1
        ];

        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
        }

        //Status
        if (isset($request['iduser'])) {
            $search['iduser'] = $request['iduser'];
        }
        
        $consents = $this->consentRepository->getConsentsByUsers($search['iduser']);
        return view('users.consent')
            ->withSearch($search)
            ->withConsents($consents)
            ;
        //return view('users.consent');
    }

    /**
     * Display a listing of the resource.
     * GET /consents
     * @return Response
     */
    public function init(Request $request)
    {
        //dd($request);

    }


    /**
     * Display the specified resource.
     * GET /consents/{idconsent}
     * @param $idconsent
     * @return Response
     */
    public function show($idconsent)
    {
        return response()->json($this->consentRepository->find($idconsent));
    }

    /**
     * Store a newly created resource in storage.
     * @param ContractRequest $request
     * @return Response
     */
    public function store(ConsentRequest $request)
    {
        //Save Group Director
        $consent = $this->consentRepository->store($request);
        $data = [];
        if ($consent) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $consent->idconsent;
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
    public function update($idconsent, ConsentRequest $request)
    {
        //Update Group Director
        $consent = $this->consentRepository->update($idconsent, $request);
        $data = [];
        if ($consent) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idconsent'] = $idconsent;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idconsent
     * @return Response
     */
    public function destroy($idconsent)
    {
        //Delete Descriptivereport
        $consent = $this->consentRepository->destroy($idconsent);

        $data = [];
        if ($consent) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

}