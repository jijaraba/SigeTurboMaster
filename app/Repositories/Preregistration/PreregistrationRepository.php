<?php
/**
 * Created by PhpStorm.
 * User: jijaraba
 * Date: 11/19/17
 * Time: 6:52 PM
 */

namespace SigeTurbo\Repositories\Preregistration;


use Illuminate\Support\Facades\Cache;
use SigeTurbo\Prepaidmedical;
use SigeTurbo\Preregistration;

class PreregistrationRepository implements PreregistrationRepositoryInterface
{

    /**
     * Get All Preregistration
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('preregistrations', 1440, function () {
            return Preregistration::all();
        });
    }

    /**
     * Find Preregistration By ID
     * @param $preregistration
     * @return mixed
     */
    public function find($preregistration)
    {
        return Preregistration::find($preregistration);
    }

    /**
     * Save Preregistration
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Preregistration::create([
            'iduser' => $data->iduser,
            'ididentificationtype' => ($data->ididentificationtype !== null) ? $data->ididentificationtype : 1,
            'idreligion' => $data->idreligion,
            'idbloodtype' => ($data->idbloodtype !== null) ? $data->idbloodtype : 1,
            'idfamily' => ($data->idfamily !== null) ? $data->idfamily : 1,
            'idcategory' => $data->idcategory,
            'idmedicalinsurance' => 1,
            'idprepaidmedical' => 1,
            'identification' => ($data->identification !== null) ? $data->identification : 1,
            'expedition' => ($data->expedition !== null) ? $data->expedition : '',
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'address' => ($data->address !== null) ? $data->address : '',
            'district' => ($data->district !== null) ? $data->district : '',
            'town' => ($data->town !== null) ? $data->town : '',
            'phone' => ($data->phone !== null) ? $data->phone : null,
            'celular' => ($data->celular !== null) ? $data->celular : '',
            'email' => ($data->email !== null) ? $data->email : '',
        ]);
    }

    /**
     * Update Profile General
     * @param $preregistration
     * @param $data
     * @return mixed
     */
    public function updateProfileGeneral($preregistration, $data)
    {
        //Find Preregistration
        $preregistration = Preregistration::find($preregistration);
        $preregistration->fill([
            'iduser' => $data['user'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'ididentificationtype' => $data['identificationtype'],
            'identification' => $data['identification'],
            'expedition' => $data['expedition'],
            'idreligion' => $data['religion'],
            'address' => $data['address'],
            'district' => $data['district'],
            'town' => $data['town'],
            'email' => $data['email'],
            'phone' => ($data['phone'] !== null) ? $data['phone'] : null,
            'celular' => $data['celular'],
            'general_completed' => 'Y',
        ]);
        return $preregistration->save();
    }

    public function updateProfileMedical($preregistration, $data)
    {
        //Find Preregistration
        $preregistration = Preregistration::find($preregistration);
        $preregistration->fill([
            'idbloodtype' => $data['bloodtype'],
            'idmedicalinsurance' => $data['medicalinsurance'],
            'idprepaidmedical' => $data['prepaidmedical'],
            'policynumber' => ($data['policynumber'] !== null) ? $data['policynumber'] : null,
            'medicaltreatment' => $data['medicaltreatment'],
            'medicaltreatmentdescription' => ($data['medicaltreatmentdescription'] !== null) ? $data['medicaltreatmentdescription'] : null,
            'equaltreatment' => $data['equaltreatment'],
            'takemedication' => $data['takemedication'],
            'medicationdescription' => ($data['medicationdescription'] !== null) ? $data['medicationdescription'] : null,
            'whytakemedication' => ($data['whytakemedication'] !== null) ? $data['whytakemedication'] : null,
            'dose' => ($data['dose'] !== null) ? $data['dose'] : null,
            'isallergic' => $data['isallergic'],
            'specifyallergic' => ($data['specifyallergic'] !== null) ? $data['specifyallergic'] : null,
            'sufferedillness' => $data['sufferedillness'],
            'sufferedillnessdescription' => ($data['sufferedillnessdescription'] !== null) ? $data['sufferedillnessdescription'] : null,
            'doctorname' => ($data['doctorname'] !== null) ? $data['doctorname'] : null,
            'doctorphone' => ($data['doctorphone'] !== null) ? $data['doctorphone'] : null,
            'psychologicalsupport' => $data['psychologicalsupport'],
            'health_completed' => 'Y',
        ]);
        return $preregistration->save();
    }


    public function updateProfileAdditional($preregistration, $data)
    {
        //Find Preregistration
        $preregistration = Preregistration::find($preregistration);
        $preregistration->fill([
            'educationaloutput' => $data['educationaloutput'],
            'responsible' => $data['responsible'],
            'observation' => ($data['observation'] !== null) ? $data['observation'] : null,
            'additional_completed' => 'Y',
        ]);
        return $preregistration->save();
    }


    public function updateProfileProfession($preregistration, $data)
    {
        //Find Preregistration
        $preregistration = Preregistration::find($preregistration);
        $preregistration->fill([
            'profession' => ($data['profession'] !== null) ? $data['profession'] : null,
            'occupation' => ($data['occupation'] !== null) ? $data['occupation'] : null,
            'company' => ($data['company'] !== null) ? $data['company'] : null,
            'phonecompany' => ($data['phone'] !== null) ? $data['phone'] : null,
            'profession_completed' => 'Y',
        ]);
        return $preregistration->save();
    }

    /**
     * Destroy Preregistration
     * @param $preregistration
     * @return mixed
     */
    public function destroy($preregistration)
    {
        $preregistration = Preregistration::find($preregistration);
        return $preregistration->delete();
    }

    /**
     * Get Preregistration By User
     * @param $user
     * @return mixed
     */
    public function getPreregistrationByUser($user)
    {
        return Preregistration::select('*')
            ->where('iduser', '=', $user)
            ->first();
    }
}