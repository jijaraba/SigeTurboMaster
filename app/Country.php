<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	protected $primaryKey = 'idcountry';
	protected $fillable = ['name'];
	protected $hidden = ['created_at', 'updated_at'];
	/**
	 * Table Name
	 * @var string
	 */
	protected $table = 'countries';


	/**
	 * @return mixed
	 */
	public function department()
	{
		return $this->hasMany('SigeTurbo\Department', 'idcountry', 'idcountry');
	}

}