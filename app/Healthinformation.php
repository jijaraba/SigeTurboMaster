<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Healthinformation extends Model
{
    protected $primaryKey = 'idhealthinformation';
    protected $fillable = ['iduser','idbloodtype', 'idprepaidmedical', 'idmedicalinsurance','policy_number', 'diseases', 'medical_treatment',
     'medication', 'dose', 'allergies', 'doctor_name', 'doctor_phone', 'psychological_treatment', 'emergency_contact', 'emergency_phone', 'insurance', 'vaccination_card', 'observation', 'created_by', 'updated_by'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'healthinformations';

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
    public function bloodtype()
    {
        return $this->belongsTo('SigeTurbo\Bloodtype');
    }

    /**
     * @return mixed
     */
    public function prepaidmedical()
    {
        return $this->belongsTo('SigeTurbo\Prepaidmedical');
    }

    /**
     * @return mixed
     */
    public function medicalinsurance()
    {
        return $this->belongsTo('SigeTurbo\Medicalinsurance');
    }
}