<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{

    protected $primaryKey = 'idvisitor';
    protected $fillable = ['idvisitortype', 'ididentificationtype', 'name', 'gender', 'company', 'code', 'identification', 'accesstype', 'licenseplate', 'date', 'time','destination', 'realdate', 'checkin', 'checkout', 'observation','created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'visitors';

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
    public function family()
    {
        return $this->belongsTo('SigeTurbo\Family');
    }

    /**
     * @return mixed
     */
    public function visitortype()
    {
        return $this->belongsTo('SigeTurbo\Visitortype');
    }

    /**
     * @return mixed
     */
    public function identificationtype()
    {
        return $this->belongsTo('SigeTurbo\Identificationtype');
    }


}
