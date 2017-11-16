<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Statistics\Statistics;

class StatisticsController extends Controller
{


    /**
     * Show Statistics
     * @return Response
     */
    public function index()
    {
        return view('statistics.index');
    }

    /**
     * Show Statistics By Group
     * @return Response
     */
    public function group()
    {
        return view('statistics.group');
    }

    /**
     * Show Statistics By Subject
     * @return Response
     */
    public function subject()
    {
        return view('statistics.subject');
    }

    /**
     * Show Statistics By Area
     * @return Response
     */
    public function area()
    {
        return view('statistics.area');
    }

    /**
     * Display a listing of the resource.
     * GET /statistics
     * @param Request $request
     * @return Response
     */
    public function globalPerformances(Request $request)
    {
        $performances = Cache::remember('globalperformance_' . $request['year'] . $request['period'], 1440, function () use ($request) {
            return Statistics::globalPerformances($request['year'], $request['period']);
        });
        return $performances;
    }

    /**
     * Display Performances By Group
     * GET /statistics
     * @param Request $request
     * @return mixed
     */
    public function globalPerformanceByGroup(Request $request)
    {
        $performances = Cache::remember('globalperformancebygroup_' . $request['year'] . $request['period'], 1440, function () use ($request) {
            return Statistics::globalPerformanceByGroup($request['year'], $request['period']);
        });
        return $performances;
    }

    /**
     * Display Performances By Subject
     * GET /statistics
     * @param Request $request
     * @return mixed
     */
    public function globalPerformanceBySubject(Request $request)
    {
        $performances = Cache::remember('globalperformancebysubject_' . $request['year'] . $request['period'], 1440, function () use ($request) {
            return Statistics::globalPerformanceBySubject($request['year'], $request['period']);
        });
        return $performances;
    }

    /**
     * Display Performances By Area
     * GET /statistics
     * @return mixed
     */
    public function globalPerformanceByArea(Request $request)
    {
        $performances = Cache::remember('globalperformancebyarea_' . $request['year'] . $request['period'], 1440, function () use ($request) {
            return Statistics::globalPerformanceByArea($request['year'], $request['period']);
        });
        return $performances;
    }

}