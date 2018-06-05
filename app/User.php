<?php

namespace SigeTurbo;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    const EMPLOYEES_ROLES = ['Admin', 'Principal', 'Teacher', 'Academic', 'Account', 'Admission', 'Communicator', 'Counseling', 'Discipline', 'Doorman', 'HelpDesk', 'Librarian', 'Maintenance', 'Nurse', 'RRHH', 'Treasurer'];

    protected $primaryKey = 'iduser';
    protected $fillable = ['iduser', 'firstname', 'lastname', 'idcategory', 'idstatus', 'idtown', 'address',
        'idstratus', 'phone', 'celular', 'idethnicgroup', 'idmaritalstatus', 'idreligion', 'idgender', 'username', 'email',
        'password', 'birth', 'email_personal', 'photo', 'role', 'role_selected', 'api_token', 'token', 'last_change_token', 'email_confirmed', 'email_passcode', 'celular_confirmed',
        'celular_passcode', 'welcome_container', 'first_login', 'created_by', 'updated_by'
    ];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token', 'created_at', 'updated_at');


    /**
     * Get FullName
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->lastname . " " . $this->firstname;
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('SigeTurbo\Category');
    }

    /**
     * @return mixed
     */
    public function ethnicgroup()
    {
        return $this->belongsTo('SigeTurbo\Ethnicgroup');
    }


    /**
     * @return mixed
     */
    public function gender()
    {
        return $this->belongsTo('SigeTurbo\Gender');
    }

    /**
     * @return mixed
     */
    public function maritalstatus()
    {
        return $this->belongsTo('SigeTurbo\Maritalstatus');
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
    public function status()
    {
        return $this->belongsTo('SigeTurbo\Status');
    }

    /**
     * @return mixed
     */
    public function town()
    {
        return $this->belongsTo('SigeTurbo\Town');
    }

    /**
     * @return mixed
     */
    public function stratus()
    {
        return $this->belongsTo('SigeTurbo\Stratus');
    }

    /**
     * @return mixed
     */
    public function enrollments()
    {
        return $this->hasMany('SigeTurbo\Enrollment', 'iduser', 'iduser')
            ->select('enrollments.*', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),employees.lastname,employees.firstname) AS employee'), 'employees.photo')
            ->join('users AS employees', function ($join) {
                $join
                    ->on('employees.iduser', '=', 'enrollments.updated_by');
            })
            ->with('enrollmentlogs')
            ->orderBy('enrollments.idyear', 'DESC')
            ->orderBy('enrollments.idgroup', 'DESC');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function notificationuser()
    {
        return $this->hasMany('SigeTurbo\Notificationuser', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function contract()
    {
        return $this->hasMany('SigeTurbo\Contract', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function groupdirector()
    {
        return $this->hasMany('SigeTurbo\Groupdirector', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this
            ->hasMany('SigeTurbo\Attendance', 'iduser', 'iduser')
            ->groupBy('attendances.iduser');
    }

    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function userfamily()
    {
        return $this->hasMany('SigeTurbo\Userfamily', 'iduser', 'iduser')
            ->join('families', function ($join) {
                $join
                    ->on('families.idfamily', '=', 'userfamilies.idfamily');
            });
    }

    /**
     * @return mixed
     */
    public function preregistration()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function observer()
    {
        return $this->hasMany('SigeTurbo\Observer', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'iduser', 'iduser');
    }

    /*
    /**
     * @return mixed
     */
    /*public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'iduser', 'idteacher');
    }*/

    /**
     * @return mixed
     */
    public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'iduser', 'iduser');
    }

    /*
    /**
     * @return mixed
     */
    /*public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'iduser', 'idteacher');
    }*/

    /**
     * @return mixed
     */
    public function areamanagers()
    {
        return $this->hasMany('SigeTurbo\Areamanager', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function ubication()
    {
        return $this->hasMany('SigeTurbo\Ubication', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->hasMany('SigeTurbo\Inventory', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function identification()
    {
        return $this->hasOne('SigeTurbo\Identification', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function schoolinformation()
    {
        return $this->hasOne('SigeTurbo\Schoolinformation', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function healthinformation()
    {
        return $this->hasOne('SigeTurbo\Healthinformation', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function origeninformation()
    {
        return $this->hasOne('SigeTurbo\Origeninformation', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function responsibleparent()
    {
        return $this->hasOne('SigeTurbo\Responsibleparent', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany('SigeTurbo\Payment', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function attendancecontrols()
    {
        return $this->hasMany('SigeTurbo\Attendancecontrol', 'iduser', 'iduser');
    }
}
