<?php

namespace SigeTurbo\Repositories\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Request;

class RequestRepository implements RequestRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Request::all();
    }

    /**
     * @param $idrequest
     * @return mixed
     */
    public function find($idrequest)
    {
        return Request::find($idrequest);
    }

    /**
     * Save Request
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Request::create(array(
            'iduser' => $data['iduser'],
            'request' => $data['request'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Request
     * @param $request
     * @param $data
     * @return mixed
     */
    public function update($request,$data)
    {
        $request = Request::find($request);
        $request->fill(array(
            'iduser' => $data['iduser'],
            'request' => $data['request'],
            'updated_at' => Carbon::now()
        ));
        return $request->save();

    }

    /**
     * Delete Request
     * @param $request
     * @return mixed
     * @internal param $data
     */
    public function destroy($request)
    {
        //Find Request
        $request = Request::find($request);
        return $request->delete();
    }

    /**
     * Get Requests By Users
     * @param $user
     * @return mixed
     */
    public function getRequestsByUsers($user)
    {
        return Request::select('request')
            ->where('requests.iduser','=',$user)
            ->get();
    }
}