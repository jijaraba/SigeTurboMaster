<?php

namespace SigeTurbo\Repositories\Consent;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Consent;

class ConsentRepository implements ConsentRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Consent::all();
    }

    /**
     * @param $idconsent
     * @return mixed
     */
    public function find($idconsent)
    {
        return Consent::find($idconsent);
    }

    /**
     * Save Consent
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Consent::create(array(
            'iduser' => $data['iduser'],
            'idconsenttype' => $data['idconsenttype'],
            'path' => $data['path'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Consent
     * @param $consent
     * @param $data
     * @return mixed
     */
    public function update($consent,$data)
    {
        $consent = Consent::find($consent);
        $consent->fill(array(
            'iduser' => $data['iduser'],
            'idconsenttype' => $data['idconsenttype'],
            'path' => $data['path'],
            'updated_at' => Carbon::now()
        ));
        return $consent->save();

    }

    /**
     * Delete Consent
     * @param $consent
     * @return mixed
     * @internal param $data
     */
    public function destroy($consent)
    {
        //Find Consent
        $consent = Consent::find($consent);
        return $consent->delete();
    }

    /**
     * Get Consents By Users
     * @param $user
     * @return mixed
     */
    public function getConsentsByUsers($user)
    {
        return Consent::select('consents.idconsent', 'consents.idconsenttype','consents.iduser','consenttypes.name AS consenttype', 
            DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS user'),
            DB::raw("date_format(SUBSTRING_INDEX(consents.created_at, ' ', 1),CONCAT(CONCAT(ELT(WEEKDAY(SUBSTRING_INDEX(consents.created_at, ' ', 1)) + 1,'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d de ',CONCAT(ELT(MONTH(SUBSTRING_INDEX(consents.created_at, ' ', 1)), 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre')),' de %Y',' a las ',SUBSTRING_INDEX(consents.created_at, ' ', -1))) AS datestring"),
            'path')
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'consents.iduser');
            })
            ->join('consenttypes', function ($join) {
                $join
                    ->on('consenttypes.idconsenttype', '=', 'consents.idconsenttype');
            })
            ->where('consents.iduser','=',$user)
            ->orderBy('consenttypes.idconsenttype', 'ASC')
            ->get();
    }
}