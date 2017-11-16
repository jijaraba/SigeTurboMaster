<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Voucherconsecutive extends Model
{
    protected $primaryKey = 'idvoucherconsecutive';
    protected $fillable = ['idvouchertype', 'documenttype', 'consecutive'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'voucherconsecutives';

}
