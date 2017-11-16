<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\PermissionRequest;
use SigeTurbo\Permission;
use SigeTurbo\Repositories\Permission\PermissionRepositoryInterface;

class PermissionsController extends Controller
{
    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    /**
     * PermissionsController constructor.
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /permission
     * @return Response
     */
    public function index()
    {
        return view('permission.index');
    }

    /**
     * Display the specified resource.
     * GET /permission/{idpermission}
     * @param  int $idpermission
     * @return Response
     */
    public function show($idpermission)
    {
        return response()->json($this->permissionRepository->find($idpermission));
    }

    /**
     * Save Permission
     * @param PermissionRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(PermissionRequest $request)
    {
        //Save Permission
        $permission = $this->permissionRepository->store($request);

        $data = [];
        if ($permission) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['permission'] = $permission;
        } else {
            $data['unsuccessful'] = false;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update permission.
     * @param  int $idpermission
     * @param Request $request
     * @return Response
     */
    public function update($idpermission, Request $request)
    {
        //Update permission
        $permission = $this->permission->update($idpermission, $request);
        $data = [];
        if ($permission) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idpermission'] = $idpermission;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}