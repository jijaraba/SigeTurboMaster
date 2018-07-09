<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Services\CloudService;
use SigeTurbo\Http\Requests\UploadRequest;


class UploadsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /uploadtask
     * @param UploadRequest $request
     * @return Response
     */
    public function uploadTask(UploadRequest $request)
    {
        if ($request->file('file')->isValid()) {
            $cloud = new CloudService();
            if ($taskfile = $cloud->uploadTask($request->file('file'))) {
                return response()->json(['status' => true, 'data' => ['table' => 'taskfiles', 'id' => $taskfile->idtaskfile]]);
            }
        }
        return response()->json(['status' => false]);
    }


    public function deleteTask(Request $request)
    {
        $cloud = new CloudService();
        if ($taskfile = $cloud->deleteTask($request)) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }


    /**
     * Display a listing of the resource.
     * GET /uploadconsent
     * @param $uplad variable que define si se monta en el servidor
     * @param UploadRequest $request
     * @return Response
     */
    public function uploadConsent(UploadRequest $request)
    {
        if ($request->file('file')->isValid()) {
            if (($request['consent'] !== 'false')) {
                $cloud = new CloudService();
                if ($consentfile = $cloud->uploadConsent($request->file('file'))) {
                    return response()->json(['status' => true, 'data' => ['table' => 'consents', 'id' => $consentfile->idtaskfile]]);
                }
            } else {
                return response()->json(['status' => true]);
            }
        }
        return response()->json(['status' => false]);
    }

    public function deleteConsent(Request $request)
    {
        $cloud = new CloudService();
        if ($consentfile = $cloud->deleteConset($request)) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    /**
     * Upload Users Photo
     * GET /upload/user/photo
     * @param UploadRequest $request
     * @return Response
     */
    public function uploadUserPhoto(UploadRequest $request)
    {
        if ($request->file('photo')->isValid()) {
            $cloud = new CloudService();
            $response = $cloud->uploadUserPhoto($request->file('photo'), $request['user']);
            if ($response['successful']) {
                return response()->json(['status' => $response['successful'], 'data' => ['photo' => $response['photo']]]);
            }
        }
        return response()->json(['status' => false]);
    }

}