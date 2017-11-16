<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Http\Requests\RoleRequest;
use SigeTurbo\User;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /roles
     * @return Response
     */
    public function index()
    {
        $roles = explode(',', getUser()->role);
        return view('roles.index')
            ->with('roles', $roles);
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        //Assign Role
        $user = User::find(getUser()->iduser);
        $user->role_selected = $request['role'];
        $user->save();

        //Redirect by Role
        if ($request['role'] === 'Parents') {
            return redirect()->intended('/parents')->withInput()->with('success', Lang::get('sige.LoggedIn'));
        }
        return redirect()->intended('/formation')->withInput()->with('success', Lang::get('sige.LoggedIn'));

    }


}