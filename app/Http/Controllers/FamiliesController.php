<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\FamilyRequest;
use SigeTurbo\Repositories\Family\FamilyRepositoryInterface;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class FamiliesController extends Controller {

    /**
     * @var FamilyRepositoryInterface
     */
    private $familyRepository;
    /**
     * @var FamilyValidator|Validator
     */
    private $validator;
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * @param FamilyRepositoryInterface $familyRepository
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param YearRepositoryInterface $yearRepository
     */
    function __construct(FamilyRepositoryInterface $familyRepository,
                         UserfamilyRepositoryInterface $userfamilyRepository,
                         YearRepositoryInterface $yearRepository)
    {
        $this->familyRepository = $familyRepository;
        $this->userfamilyRepository = $userfamilyRepository;
        $this->yearRepository = $yearRepository;
    }

	/**
	 * Display a listing of the resource.
	 * GET /families
	 * @return Response
	 */
	public function index()
	{
        return response()->json($this->familyRepository->all());
	}

	/**
	 * Display the specified resource.
	 * GET /families/{idfamily}
	 * @param  int  $idfamily
	 * @return Response
	 */
	public function show($idfamily)
	{
        return response()->json($this->familyRepository->find($idfamily));
	}

    /**
     * Store a newly created resource in storage.
     * @param FamilyRequest $request
     * @return Response
     */
    public function store(FamilyRequest $request)
    {

        //Save Family
        $family = $this->familyRepository->store($request);

        $data = [];
        if($family){
            //Save Userfamily
            $this->userfamilyRepository->store(['user' => $request['student'],'family' => $family->idfamily]);
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $family->idfamily;
            $data['family'] = $family;
            //Delete Cache
            Cache::forget('families');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['student']])
            ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
    }

    /**
     * Get Family By Name
     * @param Request $request
     * @return mixed
     */
    public function searchfamilybyname(Request $request){
        return response()->json($this->familyRepository->searchFamilyByName($request['search']));
    }

    /**
     * Get Families By Academic Year
     * @return mixed
     */
    public function searchFamilies(){
        return response()->json($this->familyRepository->searchFamilies($this->yearRepository->getCurrentYear()->idyear));
    }

}