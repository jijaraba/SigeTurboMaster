<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Userfamily extends Model
{

    protected $primaryKey = 'iduserfamily';
    protected $fillable = ['iduser', 'idfamily'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'userfamilies';

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

}
