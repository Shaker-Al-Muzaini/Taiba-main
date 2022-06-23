<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }


    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $now =Carbon::now()->format('Y-m-d');

        $agent=Auth('agent')->user()->id;
        $data=[

            'trips_count'=>Trip::where('agent_id',$agent)->count(),
            'trip_total_price'=>Trip::where('agent_id',$agent)->sum('price'),
            'today_trips'=>Trip::where('agent_id',$agent)->whereDate('date',$now)->orderBy('arrival_time','asc')->get(),
            'trips_statistics'=>$this->yearlyStatistics($request)
        ];


        return view('agent.home',$data);
    }
    public function yearlyStatistics(Request $request){
        $agent=Auth('agent')->user()->id;
        $months=[];
        for($i=0;$i<12;$i++){
            $dataa=Carbon::parse(Carbon::now()->startOfYear())->addMonths($i)->format('Y-m');
            $months[$i]=$dataa;
        }
        ksort($months);

        $data['months']=$months;

        $orders=[];
        foreach( $data['months'] as $key=>$month){
            $usersCount=Trip::where('agent_id',$agent)->where('date','like',"{$month}%")->count()??0;
            $orders[$key]=$usersCount;
        }
        $data['trips']=$orders;

        return $data;

    }
}
