<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vehicle.index');
    }

    public function list(Request $request){
        $customers=Vehicle::get();
        return response()->json([
            'status'=>true,
            'vehicles'=>$customers
        ]);
    }
    public function search(Request $request){
        $users = new Vehicle();

        if (request()->has('filter') && request('filter')) {
            $filter = request('filter');
            $users=$users->where(function($q) use ($filter){
                $q->where('vehicle_number', 'LIKE', "%$filter%")
                    ->orWhere('licence_number', 'LIKE', "%$filter%")
                    ->orWhere('chassis_number', 'LIKE', "%$filter%")
                    ->orWhere('capacity', 'LIKE', "%$filter%");
            });
//            $users = $users->where('name', 'LIKE', "%$filter%");
        }
        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
//            $users = $users->orderBy(($sort['fieldName'] ?? 'id'), $sort['name_en']);
        }
        $users = $users->orderBy('created_at', 'desc')->paginate(13);
        return response()->json(compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $inputs = $request->input();
        $validate = [

        ];
        $validator = Validator::make($inputs, $validate);

        try {
            DB::beginTransaction();
            $record =Vehicle::create([]);
            if ($record) {
                foreach ($record->getFillable() as $k){


                    if (!empty($inputs[$k])) {
                        if(in_array($k,['production_date','licence_expire_date','insurance_expire_date'])){
                            $record->{$k} = Carbon::parse($inputs[$k])->addDay()->format("Y-m-d");
                        }else{

                        $record->{$k} = $inputs[$k];
                        }
                    }
                }
                $record->save();
            }
            DB::commit();

        } catch (\Exception $e) {

            \Log::info('vehicle: '.$e->getMessage());
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $data=[
            'success'=>true,
            'message'=>'تم اضافة المركبة بنجاح!'
        ] ;
        return response()->json(compact('data'), 200);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {

        $inputs = $request->input();
        $validate = [

        ];
        $validator = Validator::make($inputs, $validate);

        try {
            DB::beginTransaction();
            $record =Vehicle::find($request->id);
            if ($record) {
                foreach ($record->getFillable() as $k){


                    if (!empty($inputs[$k])) {
                        if(in_array($k,['production_date','licence_expire_date','insurance_expire_date'])){
                            $record->{$k} = Carbon::parse($inputs[$k])->addDay()->format("Y-m-d");
                        }else{

                            $record->{$k} = $inputs[$k];
                        }
                    }
                }
                $record->save();
            }
            DB::commit();

        } catch (\Exception $e) {

            \Log::info('vehicle: '.$e->getMessage());
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $data=[
            'success'=>true,
            'message'=>'تم اضافة المركبة بنجاح!'
        ] ;
        return response()->json(compact('data'), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $user)
    {
        $user->delete();
        $message = "تم حذف الحافلة بنجاح";
        return response()->json(compact('message'));
    }
}
