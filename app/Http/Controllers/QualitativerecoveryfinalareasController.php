<?php
namespace SigeTurbo\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\QualitativerecoveryfinalareaRequest;
use SigeTurbo\Repositories\Qualitativerecoveryfinalarea\QualitativerecoveryfinalareaRepositoryInterface;

class QualitativerecoveryfinalareasController extends Controller {

	/**
     * @var QualitativeratingfinalareaRepositoryInterface
     */
    private $qualitativeratingfinalareaRepository;

    /**
     * @param QualitativeratingfinalareaRepositoryInterface $qualitativeratingfinalareaRepository
     */
    function __construct(
     QualitativerecoveryfinalareaRepositoryInterface $qualitativeratingfinalareaRepository)
    {

        $this->qualitativeratingfinalareaRepository = $qualitativeratingfinalareaRepository;
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /qualitativeratingfinalareas
	 *
	 * @return Response
	 */
	public function store(QualitativerecoveryfinalareaRequest $request)
	{
		//Save Qualitativerecoveryfinalarea
        $qualitativerecoveryfinalarea = $this->qualitativeratingfinalareaRepository->store($request);

        $data = [];
        if ($qualitativerecoveryfinalarea) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['quantitativerecoveryfinalarea'] = $qualitativerecoveryfinalarea;
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
	 * PUT /qualitativerecoveryfinalareas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idqualitativerecoveryfinalarea,QualitativerecoveryfinalareaRequest $request)
	{
		//Update Qualitativerecoveryfinalarea
        $qualitativerecoveryfinalarea = $this->qualitativeratingfinalareaRepository->update($idqualitativerecoveryfinalarea, $request);
        $data = [];
        if ($qualitativerecoveryfinalarea) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['qualitativerecoveryfinalarea'] = $qualitativerecoveryfinalarea ;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
	}

}