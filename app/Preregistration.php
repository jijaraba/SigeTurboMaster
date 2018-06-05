<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Preregistration extends Model
{

    protected $primaryKey = 'idpreregistration';
    protected $fillable = ['iduser', 'idfamily', 'idcategory', 'idreligion', 'ididentificationtype', 'idbloodtype', 'idmedicalinsurance', 'idprepaidmedical', 'identification', 'expedition', 'firstname', 'lastname', 'address', 'district', 'town', 'phone', 'celular', 'email', 'policynumber', 'medicaltreatment', 'medicaltreatmentdescription', 'equaltreatment', 'takemedication', 'medicationdescription', 'whytakemedication', 'dose', 'isallergic', 'sufferedillness', 'specifyallergic', 'sufferedillnessdescription', 'doctorname', 'doctorphone', 'psychologicalsupport', 'observation', 'educationaloutput', 'responsible', 'profession', 'occupation', 'company', 'phonecompany'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'preregistrations';

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function religion()
    {
        return $this->belongsTo('SigeTurbo\Religion');
    }

    /**
     * @return mixed
     */
    public function identificationtype()
    {
        return $this->belongsTo('SigeTurbo\Identificationtype');
    }

    /**
     * @return mixed
     */
    public function bloodtype()
    {
        return $this->belongsTo('SigeTurbo\Bloodtype');
    }

    /**
     * @return mixed
     */
    public function family()
    {
        return $this->belongsTo('SigeTurbo\Family');
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('SigeTurbo\Category');
    }


}