<?php
namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Repositories\Group\GroupRepositoryInterface;

class GroupsController extends Controller
{
    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * GroupsController constructor.
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /groups
     * @return Response
     */
    public function index()
    {
        return response()->json($this->groupRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /groups/{idgroup}
     * @param  int $idgroup
     * @return Response
     */
    public function show($idgroup)
    {
        return response()->json($this->groupRepository->find($idgroup));
    }

    /**
     * Get Groups For Observator
     * @param Request $request
     * @return mixed
     */
    public function getGroupsForObservator(Request $request)
    {
        return response()->json($this->groupRepository->getGroupsForObservator($request['year']));
    }

    /**
     * Get Groups By Year and Period and User
     * @param Request $request
     * @return mixed
     */
    public function getGroups(Request $request)
    {

        if (!getGuest()) {
            switch (getUser()->role_selected) {
                case 'Teacher':
                    return response()->json($this->groupRepository->getGroups($request['year'], $request['period'], getUser()->iduser));
                    break;
                case 'AreaManager':
                    return response()->json($this->groupRepository->getGroupsByAreaManager($request['year'], $request['period'], getUser()->iduser));
                    break;
                default:
                    return response()->json($this->groupRepository->getGroups($request['year'], $request['period'], null));
                    break;

            }
        }
    }

    /**
     * Get Groups By Year and Period and User
     * @param Request $request
     * @return mixed
     */
    public function getGroupForGuest(Request $request)
    {
        return response()->json($this->groupRepository->getGroupsForGuest($request['year'], $request['period']));
    }


}