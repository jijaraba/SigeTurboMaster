<?php

namespace SigeTurbo\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use SigeTurbo\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use SigeTurbo\Taskfile;
use SigeTurbo\Consent;

class CloudService
{
    /**
     * @var UploadedFile
     */
    private $file;
    /**
     * @var string
     */
    private $type = 'task';
    /**
     * @var
     */
    private $path;
    /**
     * @var
     */
    private $fileName;

    /**
     * Upload Task
     * @param UploadedFile $file
     * @return bool
     */
    public function uploadTask(UploadedFile $file)
    {
        $this->type = 'task';
        $this->file = $file;
        $this->fileName = fileName($this->type, $this->file->getClientOriginalExtension());
        $this->path = storage_path() . '/files/tasks/';
        $this->file->move($this->path, $this->fileName);
        if (self::upload()) {
            return Taskfile::create([
                'idtask' => Input::get('task'),
                'file' => $this->fileName,
                'realname' => $this->file->getClientOriginalName(),
                'size' => $this->file->getClientSize(),
                'extension' => $this->file->getClientOriginalExtension()
            ]);
        }
        return false;
    }

    /**
     * Upload Task
     * @param UploadedFile $file
     * @return bool
     */
    public function uploadConsent(UploadedFile $file)
    {
        $input = json_decode(Input::get('consent'), true);
        $this->type = 'consent';
        $this->file = $file;
        $this->fileName = fileName($this->type, $this->file->getClientOriginalExtension());
        $this->path = storage_path() . '/files/consents/';
        $this->file->move($this->path, $this->fileName);
        if (self::upload()) {
            return Consent::create([
                'iduser' => $input['iduser'],
                'idconsenttype' => $input['idconsenttype'],
                'path' => $this->fileName
            ]);
        }
        return false;
    }

    /**
     * Upload Export
     * @param $type
     * @param $path
     * @param $fileName
     * @return bool
     */
    public function uploadExport($type, $path, $fileName)
    {
        $this->type = $type;
        $this->path = $path . '/';
        $this->fileName = $fileName;
        if (self::upload()) {
            return true;
        }
        return false;
    }

    /**
     * Delete Task File
     * @param $data
     */
    public function deleteTask($data)
    {
        $this->type = 'task';
        $taskfile = Taskfile::find($data['id']);
        if ($taskfile) {
            if (self::delete($taskfile->file)) {
                //Delete
                $taskfile->delete();
            }
        }
    }

    /**
     * Upload File
     */
    private function upload()
    {

        //Change Route By Photo
        $route = $this->type;
        if ($this->type == 'photo') {
            $route = 'img/users';
        }

        $localFileName = $this->path . $this->fileName;
        //Open File
        $file = fopen($localFileName, 'r');
        //Rackspace
        $objectStoreService = App::make('Rackspace')->objectStoreService(null, getenv('RACKSPACE_REGION'));
        $container = $objectStoreService->getContainer(getenv('RACKSPACE_CONTAINER'));
        $container->uploadObject($route . '/' . $this->fileName, $file);
        //Delete file
        unlink($localFileName);
        if ($container) {
            return true;
        }
        return false;
    }

    private function delete($file)
    {
        //Change Route By Photo
        $route = $this->type;
        if ($this->type == 'photo') {
            $route = 'img/users';
        }

        //Rackspace
        $objectStoreService = App::make('Rackspace')->objectStoreService(null, getenv('RACKSPACE_REGION'));
        $container = $objectStoreService->getContainer(getenv('RACKSPACE_CONTAINER'));
        $object = $container->getObject($route . "/" . $file);
        return $object->delete();
    }

    /**
     * Upload User Photo
     * @param UploadedFile $file
     * @param $user
     * @return bool
     */
    public function uploadUserPhoto(UploadedFile $file, $user)
    {
        $this->type = 'photo';
        $this->file = $file;
        $this->fileName = photoName($user, $this->file->getClientOriginalExtension());
        $this->path = storage_path() . '/files/users/photo/';
        $this->file->move($this->path, $this->fileName);

        //Find User
        $user = User::find($user);

        //Delete Previous Photo
        if ($user->photo == env('ASSETS_DEFAULT_PHOTO')) {
            self::delete($user->photo);
        }

        //Upload photo
        if (self::upload()) {

            $user->fill([
                'photo' => $this->fileName
            ]);
            $user->save();
            return ['successful' => true, 'photo' => $this->fileName];
        }
        return false;
    }

}