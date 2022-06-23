<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;
class DriverController extends Controller
{
    public function adminIndex()
    {
        return view('admin.drivers');
    }

    public function adminSearch()
    {
        $users = new Driver();

        if (request()->has('filter') && request('filter')) {
            $filter = request('filter');
            $users = $users->where('name', 'LIKE', "%$filter%");
        }
        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
//            $users = $users->orderBy(($sort['fieldName'] ?? 'id'), $sort['name_en']);
        }
        $users = $users->orderBy('created_at', 'desc')->paginate(13);
        return response()->json(compact('users'));
    }

    public function list(Request $request){
        $drivers=Driver::get();
        return response()->json([
            'status'=>true,
            'drivers'=>$drivers
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
//            'email' => 'required|string|email|unique:drivers',
            'mobile' => 'required|unique:drivers',
//            'password' => 'required',
            'state' => 'required',
//            'role' => 'required',
//            'user_avatar' => 'required',
        ]);



        try {
            \DB::beginTransaction();



            $user =  Driver::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'type_status' => $request->type_status,
                'state_id' =>@$request->state?$request->state['id']:null,

            ]);

            \DB::commit();

        } catch (\Exception $e) {

            return $e;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $data=[
            'success'=>true,
            'message'=>'تم اضافة المندوب بنجاح!'
        ] ;
        return response()->json(compact('data'), 200);


    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
//            'email' => Rule::unique('drivers')->ignore($request->id, 'id'),
            'mobile' => 'required',
            'state' => 'required',
//            'user_avatar' => 'required',
        ]);


        \DB::beginTransaction();
        try {
            $user = Driver::findOrFail($request->id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->type_status = $request->type_status;
            $user->state_id =@$request->state?$request->state['id']:null;
            $user->save();

            \DB::commit();


        } catch (\Exception $e) {

//            return $e->getMessage();
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'يوجد خلل ما',
                "error"=>$e->getMessage()
            ], 422);
        }
        $message = 'تم تحديث البيانات بنجاح !';
        return response()->json(compact('message'), 200);
    }


    public function destroy(Driver $user)
    {
        $user->delete();
        $message = "تم حذف المندوب بنجاح";
        return response()->json(compact('message'));
    }
}
