<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripExcelResource;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request){
        return view('admin.report.index');
    }

    public function exportExcel(Request $request){

        $trips=new Trip();
//        $trips=$trips->with('goingDriver','backDriver','goingVehicle','backVehicle');
        if($request->custom_period){
//            $dates=explode(',',$request->custom_period);
            $dates=$request->custom_period;
         $periodDate=['start_at'=>Carbon::parse($dates[0])->format('Y-m-d'),'end_at'=>Carbon::parse($dates[1])->format('Y-m-d')];
          $trips=$trips->where('date','>=',$periodDate['start_at'])->where('date','<=',$periodDate['end_at']) ;
        }
        if($request->customer){
            $trips=$trips->where('customer_id',$request->customer);
        }

        if($request->payment_type){
            $trips=$trips->where('payment_type',$request->payment_type);
        }
        if($request->driver_id){
            $trips=$trips->where(function($q) use ($request){
                $q->where('going_driver_id',$request->driver_id)->orWhere('back_driver_id',$request->driver_id);
            });
        }
        if($request->vehicle_id){
            $trips=$trips->where(function($q) use ($request){
                $q->where('going_driver_id',$request->vehicle_id)->orWhere('back_driver_id',$request->vehicle_id);
            });
        }


        $trips=$trips->get();
        $trips=TripExcelResource::collection($trips);
        return response()->json(compact('trips'));

    }

    public function exportExcelFile(Request $request){

        $trips=new Trip();
//        $trips=$trips->with('goingDriver','backDriver','goingVehicle','backVehicle');
        if($request->custom_period){
//            $dates=explode(',',$request->custom_period);
            $dates=$request->custom_period;
            $periodDate=['start_at'=>Carbon::parse($dates[0])->format('Y-m-d'),'end_at'=>Carbon::parse($dates[1])->format('Y-m-d')];
            $trips=$trips->where('date','>=',$periodDate['start_at'])->where('date','<=',$periodDate['end_at']) ;
        }
        if($request->customer){
            $trips=$trips->where('customer_id',$request->customer);
        }

        if($request->payment_type){
            $trips=$trips->where('payment_type',$request->payment_type);
        }
        if($request->driver_id){
            $trips=$trips->where(function($q) use ($request){
                $q->where('going_driver_id',$request->driver_id)->orWhere('back_driver_id',$request->driver_id);
            });
        }
        if($request->vehicle_id){
            $trips=$trips->where(function($q) use ($request){
                $q->where('going_driver_id',$request->vehicle_id)->orWhere('back_driver_id',$request->vehicle_id);
            });
        }


        $trips=$trips->get();
//        $trips=TripExcelResource::collection($trips);

        return response(view('admin.report.excel',['trips'=>$trips]), 200, [
            'Content-Type' => 'application/vnd-ms-excel;charset=utf-8', // use your required mime type
            'Content-Disposition' => 'attachment; filename="report-export.xls"',
        ]);
    }

}
