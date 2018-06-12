<?php

namespace SigeTurbo\Repositories\Family;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Category;
use SigeTurbo\Family;

class FamilyRepository implements FamilyRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Family::select('*')->remember(1440, 'families')->get();
    }

    /**
     * Find in Databases
     * @param $idfamily
     * @return mixed
     */
    public function find($idfamily)
    {
        return Family::find($idfamily);
    }

    /**
     * Save Family
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Family::create(array(
            'name' => $data['name']
        ));
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchFamilyByName($search)
    {
        return Family::searchFamilyByName($search);
    }

    /**
     * Search Families in Academic Year With Payments
     * @param $year
     * @param $search
     * @param $sort
     * @param $order
     * @return mixed
     */
    public function searchFamiliesWithPayments($year, $search, $sort, $order)
    {
        $family = Family::select('families.idfamily', 'families.name AS family', 'users.*')
            ->join('userfamilies', function ($join) {
                $join
                    ->on('userfamilies.idfamily', '=', 'families.idfamily');
            })
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'userfamilies.iduser');
            })
            ->whereIn('users.iduser', function ($query) use ($year) {
                $query->select('enrollments.iduser')
                    ->from('enrollments')
                    ->where('enrollments.idyear', '=', $year);
            })
            ->orderBy('families.name', 'ASC');

        //Search
        if ($search !== null) {
            if (isset($search["family"])) {
                $family
                    ->where('families.name', 'LIKE', "%" . $search['family'] . "%");
            }
            if (isset($search["code"])) {
                $family
                    ->where('families.idfamily', 'LIKE', "%" . $search['code'] . "%");
            }
            if (isset($search["code_est"])) {
                $family
                    ->where('userfamilies.iduser', 'LIKE', "%" . $search['code_est'] . "%");
            }
        }

        //Sort
        switch ($sort) {
            case 'family':
                $family
                    ->orderBy('families.name', $order);
                break;
            case 'pending':
                $family
                    ->orderBy('families.pending', $order);
                break;
        }

        return $family
            ->get();
    }

    /**
     * Get Payments By Family
     * @param array $family
     * @return mixed
     */
    public function getpaymentsbyfamily($family)
    {
        return Family::select('families.idfamily', 'families.name AS family', 'users.iduser', 'users.photo', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS fullname'))
            ->join('userfamilies', function ($join) {
                $join
                    ->on('userfamilies.idfamily', '=', 'families.idfamily');
            })
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'userfamilies.iduser');
            })
            ->whereIn('families.idfamily', [$family])
            ->where('users.idcategory', '=', Category::STUDENT)
            ->orderBy("families.name", 'ASC')
            ->with('payments')
            ->get();
    }

    /**
     * Search Families in Academic Year
     * @param $year
     * @return mixed
     */
    public function searchFamilies($year)
    {
        return Cache::remember('families', 1440, function () use ($year) {
            return Family::select('families.*')
                ->join('userfamilies', function ($join) {
                    $join
                        ->on('userfamilies.idfamily', '=', 'families.idfamily');
                })
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'userfamilies.iduser');
                })
                ->whereIn('users.iduser', function ($query) use ($year) {
                    $query->select('enrollments.iduser')
                        ->from('enrollments')
                        ->where('enrollments.idyear', '=', $year);
                })
                ->groupBy("families.idfamily")
                ->orderBy("families.name", 'ASC')
                ->with('users')
                ->get();
        });
    }

}
