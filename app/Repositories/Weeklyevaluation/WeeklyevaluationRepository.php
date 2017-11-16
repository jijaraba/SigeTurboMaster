<?php

namespace SigeTurbo\Repositories\Weeklyevaluation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Facades\Calendar;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Weeklyevaluation;
use SigeTurbo\Year;

class WeeklyevaluationRepository implements WeeklyevaluationRepositoryInterface
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * WeeklyevaluationRepository constructor.
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository)
    {
        $this->yearRepository = $yearRepository;
    }

    /**
     * Show all Weeklyevaluations
     * @param null $sort
     * @param string $order
     * @return mixed
     */
    public function all($sort = null, $order = 'ASC')
    {

        $weeklyevaluations = Weeklyevaluation::select('weeklyevaluations.*', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS employee'), 'users.photo')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'weeklyevaluations.iduser');
            });
        switch ($sort) {
            case 'week':
                $weeklyevaluations->orderBy('weeklyevaluations.week', $order);
                break;
            case 'teacher':
                $weeklyevaluations->orderBy('users.lastname', $order);
                break;
            case 'created_at':
                $weeklyevaluations->orderBy('weeklyevaluations.created_at', $order);
                break;
            default:
                $weeklyevaluations->orderBy('weeklyevaluations.created_at', $order);
        }
        return $weeklyevaluations->get();

    }


    /**
     * Find Weeklyevaluations
     * @param $idweeklyevaluation
     * @return mixed
     */
    public function find($idweeklyevaluation)
    {
        return Weeklyevaluation::select('weeklyevaluations.*', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS teacher"), 'users.photo')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'weeklyevaluations.iduser');
            })
            ->where('users.iduser', '=', getUser()->iduser)
            ->where('idweeklyevaluation', '=', $idweeklyevaluation)
            ->first();
    }


    /**
     * Create Weeklyevaluation
     * @param $data
     * @api
     * @return mixed
     */
    public function store($data)
    {
        return Weeklyevaluation::create([
            'idyear' => $this->yearRepository->getCurrentyear()->idyear,
            'iduser' => getUser()->iduser,
            'week' => Calendar::getCurrentWeek(),
            'comment' => $data['comment'],
        ]);
    }

    /**
     * Update Weeklyevaluation
     * @param $weeklyevaluation
     * @param $data
     * @return mixed
     */
    public function update($weeklyevaluation, $data)
    {
        //Find Weeklyevaluation
        $weeklyevaluation = Weeklyevaluation::find($weeklyevaluation);
        $weeklyevaluation->fill(array(
            'comment' => $data['comment']
        ));
        return $weeklyevaluation->save();
    }

    /**
     * Get Evaluations
     * @param int $year
     * @param null $sort
     * @param string $order
     * @return mixed
     */
    public function getEvaluations($year = 2015, $sort = null, $order = 'ASC')
    {
        $weeklyevaluations = Weeklyevaluation::select('weeklyevaluations.*', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS teacher"), 'users.photo')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'weeklyevaluations.iduser');
            });

        if (getUser()->role_selected === 'Teacher') {
            $weeklyevaluations->where('users.iduser', '=', getUser()->iduser);
        }
        switch ($sort) {
            case 'week':
                $weeklyevaluations->orderBy('weeklyevaluations.week', $order);
                break;
            case 'teacher':
                $weeklyevaluations->orderBy('users.lastname', $order);
                break;
            case 'created_at':
                $weeklyevaluations->orderBy('weeklyevaluations.created_at', $order);
                break;
            default:
                $weeklyevaluations->orderBy('weeklyevaluations.created_at', $order);
        }
        return $weeklyevaluations
            ->where('idyear','=', $year)
            ->orderBy('week', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}