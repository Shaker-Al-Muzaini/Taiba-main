<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriesContent;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
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
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
            $now =Carbon::now()->format('Y-m-d');

        $data=[
            'customers_count'=>Customer::count(),
            'trips_count'=>Trip::count(),
            'drivers_count'=>Driver::count(),
            'trip_total_price'=>Trip::sum('price'),
            'today_trips'=>Trip::where('date',$now)->orderBy('arrival_time','asc')->get(),
            'trips_statistics'=>$this->yearlyStatistics($request)
        ];

        return view('admin.home',$data);
    }
    public function yearlyStatistics(Request $request){
        $months=[];
        for($i=0;$i<12;$i++){
            $dataa=Carbon::parse(Carbon::now()->startOfYear())->addMonths($i)->format('Y-m');
            $months[$i]=$dataa;
        }
        ksort($months);

        $data['months']=$months;

        $orders=[];
        foreach( $data['months'] as $key=>$month){
            $usersCount=Trip::where('date','like',"{$month}%")->count()??0;
            $orders[$key]=$usersCount;
        }
        $data['trips']=$orders;

        return $data;

    }

}
