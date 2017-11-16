<?php

namespace SigeTurbo\Repositories\Visitor;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Visitor;

class VisitorRepository implements VisitorRepositoryInterface
{

    /**
     * Show All Visitors
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('visitors', 1440, function () {
            return Visitor::select('visitors.*','visitortypes.name as type', 'users.lastname', 'users.firstname','users.photo')
                ->join('visitortypes', function ($join) {
                    $join
                        ->on('visitortypes.idvisitortype', '=', 'visitors.idvisitortype');
                })
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'visitors.created_by');
                })
                ->whereRaw('date >= CURDATE()')
                ->orderBy('date', 'ASC')
                ->orderBy('time', 'ASC')
                ->get();
        });
    }

    /**
     * Find in Databases
     * @param $idvisitor
     * @return mixed
     */
    public function find($idvisitor)
    {
        return Visitor::find($idvisitor);
    }

    /**
     * Save Visitor
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Visitor::create([
            'idvisitortype' => $data['type'],
            'ididentificationtype' => $data['identificationtype'],
            'identification' => $data['identification'],
            'company' => $data['company'],
            'code' => $data['code'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'accesstype' => $data['accesstype'],
            'licenseplate' => $data['licenseplate'],
            'date' => $data['date'],
            'time' => $data['time'],
            'destination' => $data['destination'],
            'observation' => $data['observation'],
            'created_by' => getUser()->iduser,
            'updated_by' => getUser()->iduser,
        ]);
    }

    /**
     * Update Visitor
     * @param $idvisitor
     * @param $data
     * @return mixed
     */
    public function update($idvisitor, $data)
    {
        //Find Visitor
        $visitor = Visitor::find($idvisitor);
        $visitor->fill(array(
            'idvisitortype' => $data['type'],
            'ididentificationtype' => $data['identificationtype'],
            'identification' => $data['identification'],
            'company' => $data['company'],
            'code' => $data['code'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'accesstype' => $data['accesstype'],
            'licenseplate' => $data['licenseplate'],
            'date' => $data['date'],
            'time' => $data['time'],
            'destination' => $data['destination'],
            'observation' => $data['observation'],
            'updated_by' => getUser()->iduser,
        ));
        return $visitor->save();
    }

    /**
     * Destroy Visitor
     * @param $idvisitor
     * @return mixed
     */
    public function destroy($idvisitor)
    {
        //Find Visitor
        $visitor = Visitor::find($idvisitor);
        return $visitor->delete();
    }

    /**
     * Generate Code
     * @return mixed
     */
    public function generateCode()
    {
        return ['code' => str_random(5)];
    }

    /**
     * Checkin
     * @param $data
     * @return mixed
     */
    public function checkin($data)
    {
        //Find Visitor
        $visitor = Visitor::find($data['visitor']);
        $visitor->fill(array(
            'checkin' => Carbon::now(),
            'realdate' => Carbon::now(),
            //'checkin' => $date->format('H:i:s'),
            'updated_by' => getUser()->iduser
        ));
        return $visitor->save();
    }

    /**
     * Checkout
     * @param $data
     * @return mixed
     */
    public function checkout($data)
    {
        //Find Visitor
        $visitor = Visitor::find($data['visitor']);
        $visitor->fill(array(
            'checkout' => Carbon::now(),
            'updated_by' => getUser()->iduser
        ));
        return $visitor->save();
    }

    public function getVisitorsNow()
    {
        return Visitor::select(DB::raw('COUNT(*) AS now'),DB::raw('(SELECT COUNT(*) FROM visitors) AS total'))
            ->whereRaw("realdate = CURDATE()")
            ->whereRAW("checkout IS NULL")
            ->first();
    }
}
