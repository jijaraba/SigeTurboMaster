<?php

namespace SigeTurbo\Repositories\Healthinformation;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Healthinformation;

class HealthinformationRepository implements HealthinformationRepositoryInterface
{

    /**
     * Show All Healthinformation
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('healthinformations', 1440, function () {
            return Healthinformation::all();
        });
    }

    /**
     * Find in Databases
     * @param $healthinformations
     * @return mixed
     */
    public function find($healthinformations)
    {
        return Healthinformation::find($healthinformations);
    }

    /**
     * Insert Healthinformation
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Healthinformation::create(array(
            'iduser' => $data['healthinformation_user'],
            'idbloodtype' => $data['idbloodtype'],
            'idprepaidmedical' => $data['idprepaidmedical'],
            'idmedicalinsurance' => $data['idmedicalinsurance'],
            'policy_number' => $data['policy_number'],
            'diseases' => $data['diseases'],
            'medical_treatment' => $data['medical_treatment'],
            'medication' => $data['medication'],
            'dose' => $data['dose'],
            'allergies' => $data['allergies'],
            'doctor_name' => $data['doctor_name'],
            'doctor_phone' => $data['doctor_phone'],
            'psychological_treatment' => $data['psychological_treatment'],
            'emergency_contact' => $data['emergency_contact'],
            'emergency_phone' => $data['emergency_phone'],
            'insurance' => $data['insurance'],
            'vaccination_card' => $data['vaccination_card'],
            'observation' => $data['observation'],
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }


    /**
     * Update Healthinformation
     * @param $healthinformation
     * @param $data
     * @return mixed
     */
    public function update($healthinformation, $data)
    {
        //Find Healthinformation
        $healthinformation = Healthinformation::find($healthinformation);
        $healthinformation->fill([
            'iduser' => $data['healthinformation_user'],
            'idbloodtype' => $data['idbloodtype'],
            'idprepaidmedical' => $data['idprepaidmedical'],
            'idmedicalinsurance' => $data['idmedicalinsurance'],
            'policy_number' => $data['policy_number'],
            'diseases' => $data['diseases'],
            'medical_treatment' => $data['medical_treatment'],
            'medication' => $data['medication'],
            'dose' => $data['dose'],
            'allergies' => $data['allergies'],
            'doctor_name' => $data['doctor_name'],
            'doctor_phone' => $data['doctor_phone'],
            'psychological_treatment' => $data['psychological_treatment'],
            'emergency_contact' => $data['emergency_contact'],
            'emergency_phone' => $data['emergency_phone'],
            'insurance' => $data['insurance'],
            'vaccination_card' => $data['vaccination_card'],
            'observation' => $data['observation'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $healthinformation->save();
    }
}