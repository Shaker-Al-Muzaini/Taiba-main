<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\TripType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;

class TripController extends Controller
{

    public function index(Request $request){
        return view('admin.trip.index');
    }

    public function tripReservationTypeList(Request $request){
        $types=TripType::get();
        return response()->json([
            'status'=>true,
            'trip_types'=>$types
        ]);
    }

    public function search(Request $request)
    {
        $users = new Trip();
        $users=$users->with('reservationType','goingDriver','agent','backDriver','collector','reserver');
        if (request()->has('filter') && request('filter')) {
            $filter = request('filter');
            $users = $users->where('invoice_number', 'LIKE', "%$filter%");
        }

        if($request->custom_period){
            $dates=explode(',',$request->custom_period);
//            $dates=$request->custom_period;
            if(isset($dates[0]) && isset($dates[1])){

            $periodDate=['start_at'=>Carbon::parse($dates[0])->format('Y-m-d'),'end_at'=>Carbon::parse($dates[1])->format('Y-m-d')];
            $users=$users->where('date','>=',$periodDate['start_at'])->where('date','<=',$periodDate['end_at']) ;
            }
        }

        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
//            $users = $users->orderBy(($sort['fieldName'] ?? 'id'), $sort['name_en']);
        }
        $users=$users->with(
            'reservationType',
            'goingDriver',
            'backDriver',
            'goingVehicle',
            'backVehicle',
            'state',
            'customer.state',
            'agent');
        $users = $users->orderBy('date', 'desc')->paginate(13);
        return response()->json(compact('users'));
    }
    public function create(Request $request){
        return view('admin.trip.form');
    }

    public function duplicate(Trip $trip){
        $newTrip=$trip->replicate();
        $newTrip->save();
        return response()->json([
            'status'=>true,
            'message'=>'تم النسخ بنجاح'
        ]);
    }

    public function edit(Request $request,$trip){
        $data=[
            'trip'=>Trip::with(
                'reservationType',
                'goingDriver',
                'backDriver',
                'goingVehicle',
                'backVehicle',
                'state',
                'customer',
                'collector',
                'reserver',
                'agent')->find($trip)
        ];
        return view('admin.trip.form',$data);
    }



    public function store(Request $request){
        $request->validate([
//            'invoice_number' => 'required',
            'date' => 'required',
            'price' => 'required',
//            'customer' => 'nullable',
            'reservation_type_id' => 'required',
            'vehicles_count' => 'required',
            'vehicle_type' => 'required',
            'trip_type' => 'required',
            'state' => 'required',
            'arrival_time' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'going_vehicle_id' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'back_vehicle_id' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
            'return_time' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
            'going_driver_id' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'back_driver_id' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
            'reservation_type_text' => new RequiredIf($request->reservation_type_id && $request->reservation_type_id['id'] ==7  ),
            'customer' => 'required_if:is_new_customer,==,false',
            'collector_driver' => new RequiredIf($request->collector_driver_id && $request->collector_driver_id['id'] ==38  ),
            'reserved_driver' => new RequiredIf($request->reserved_driver_id && $request->reserved_driver_id['id'] ==38  ),

            'customer_name' => 'required_if:is_new_customer,true',
            'customer_state' => 'required_if:is_new_customer,true',
            'customer_mobile' => 'required_if:is_new_customer,true',
        ]);



        try {
            \DB::beginTransaction();
            $customer=null;
            if($request->is_new_customer){

                $customer=Customer::create([
                    'name'=>$request->customer_name,
                    'mobile'=>$request->customer_mobile,
                    'state_id' =>@$request->customer_state?$request->customer_state['id']:'',
                ]);
            }
           $trip= Trip::create([
                'invoice_number' => $request->invoice_number,
                'note' => $request->note,
                'date' => Carbon::parse($request->date)->format("Y-m-d"),
                'arrival_time' => $request->arrival_time,
                'return_time' => $request->return_time,
                'collector_driver' => $request->collector_driver,
                'reserved_driver' => $request->reserved_driver,
                'price' => $request->price,
                'prepaid_price' => $request->prepaid_price,
                'remaining_price' => $request->remaining_price,
                'payment_type' => $request->payment_type,
                'agent_id' => @$request->agent['id'],
                'customer_id' =>@$request->customer?$request->customer['id']:$customer->id,
                'reservation_type_id' =>@$request->reservation_type_id['id'],
                'reservation_type_text' =>@$request->reservation_type_text,
                'vehicles_count' =>$request->vehicles_count,

                'trip_type' =>@$request->trip_type,
                'going_note' =>@$request->going_note,
                'going_path' =>@$request->going_path,
                'back_note' =>@$request->back_note,
                'back_path' =>@$request->back_path,
                'collection_by' =>@$request->collection_by,
                'state_id' =>@$request->state?$request->state['id']:null,
                'going_driver_id' =>@$request->going_driver_id?$request->going_driver_id['id']:null,
                'collector_driver_id' =>@$request->collector_driver_id?$request->collector_driver_id['id']:null,
                'reserved_driver_id' =>@$request->reserved_driver_id?$request->reserved_driver_id['id']:null,
                'going_vehicle_id' =>@$request->going_vehicle_id?$request->going_vehicle_id['id']:null,
                'back_vehicle_id' =>@$request->back_vehicle_id?$request->back_vehicle_id['id']:null,
                'back_driver_id' =>@$request->back_driver_id?$request->back_driver_id['id']:null,
                'vehicle_type' =>@$request->vehicle_type,
            ]);

            \DB::commit();

            if($request->drivers){
                $drivers=collect($request->drivers)->pluck('id')->toArray();
                $trip->drivers()->sync($drivers);
            }

        } catch (\Exception $e) {
//            return $e->getMessage();
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $data=[
            'success'=>true,
            'message'=>'تم اضافة الحجز بنجاح!'
        ] ;
        return response()->json($data);


    }
    public function update(Request $request){


        $request->validate([

            'id' => 'required',
//            'invoice_number' => 'required',
            'date' => 'required',
            'price' => 'required',
//            'customer' => 'nullable',
            'reservation_type_id' => 'required',
            'vehicles_count' => 'required',
            'vehicle_type' => 'required',
            'trip_type' => 'required',
            'state' => 'required',
            'arrival_time' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'going_vehicle_id' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'back_vehicle_id' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
            'return_time' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
            'going_driver_id' =>new RequiredIf($request->trip_type =='going' ||$request->trip_type=='going_and_back' ),
            'back_driver_id' =>new RequiredIf($request->trip_type =='back' ||$request->trip_type=='going_and_back' ),
//            'reservation_type_text' => new RequiredIf($request->reservation_type_id && $request->reservation_type_id['id'] == 7  ),
            'customer' => 'required_if:is_new_customer,==,false',
            'collector_driver' => new RequiredIf($request->collector_driver_id && $request->collector_driver_id['id'] ==38  ),
            'reserved_driver' => new RequiredIf($request->reserved_driver_id && $request->reserved_driver_id['id'] ==38  ),

            'customer_name' => 'required_if:is_new_customer,true',
            'customer_state' => 'required_if:is_new_customer,true',
            'customer_mobile' => 'required_if:is_new_customer,true',
        ]);



        try {
            \DB::beginTransaction();
            $customer=null;
            if($request->is_new_customer){

                $customer=Customer::create([
                    'name'=>$request->customer_name,
                    'mobile'=>$request->customer_mobile,
                    'state_id' =>@$request->customer_state?$request->customer_state['id']:'',
                ]);
            }
            $trip=Trip::find($request->id);
            $trip->update([
                'invoice_number' => $request->invoice_number,
                'note' => $request->note,
                'date' => Carbon::parse($request->date)->format("Y-m-d"),
                'arrival_time' => $request->arrival_time,
                'return_time' => $request->return_time,
                'price' => $request->price,
                'collector_driver' => $request->collector_driver,
                'reserved_driver' => $request->reserved_driver,
                'prepaid_price' => $request->prepaid_price,
                'remaining_price' => $request->remaining_price,
                'payment_type' => $request->payment_type,
                'agent_id' => @$request->agent['id'],
                'customer_id' =>@$customer?$customer->id:$request->customer['id'],
                'reservation_type_id' =>@$request->reservation_type_id['id'],
                'reservation_type_text' =>@$request->reservation_type_text,
                'vehicles_count' =>$request->vehicles_count,
                'trip_type' =>@$request->trip_type,
                'going_note' =>@$request->going_note,
                'going_path' =>@$request->going_path,
                'back_note' =>@$request->back_note,
                'back_path' =>@$request->back_path,
                'collection_by' =>@$request->collection_by,
                'state_id' =>@$request->state?$request->state['id']:null,
                'collector_driver_id' =>@$request->collector_driver_id?$request->collector_driver_id['id']:null,
                'reserved_driver_id' =>@$request->reserved_driver_id?$request->reserved_driver_id['id']:null,
                'going_driver_id' =>@$request->going_driver_id?$request->going_driver_id['id']:null,
                'going_vehicle_id' =>@$request->going_vehicle_id?$request->going_vehicle_id['id']:null,
                'back_vehicle_id' =>@$request->back_vehicle_id?$request->back_vehicle_id['id']:null,
                'back_driver_id' =>@$request->back_driver_id?$request->back_driver_id['id']:null,
                'vehicle_type' =>@$request->vehicle_type,
            ]);
            \DB::commit();
            if($request->drivers){
                $drivers=collect($request->drivers)->pluck('id')->toArray();
                $trip->drivers()->sync($drivers);
            }

        } catch (\Exception $e) {
            \DB::rollback();
            return $e->getMessage();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $data=[
            'success'=>true,
            'message'=>'تم التحديث  بنجاح!'
        ] ;
        return response()->json($data);
    }
    public function destroy( Trip $trip)
    {
        $trip->delete();
        $message ="تم حذف الحجز بنجاح";
        return response()->json(compact('message'));
        return response()->json(['message' =>'Item deleted successfully'],200);

    }

}
