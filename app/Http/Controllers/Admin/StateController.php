<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\State;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StateController extends Controller
{
    public function index()
    {
        return view('admin.state');
    }
    public function search()
    {
        $users = new State();

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            \DB::beginTransaction();
            $user =  State::create([
                'name' => $request->name,
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
            'message'=>'تم اضافة المنطقة بنجاح!'
        ] ;
        return response()->json(compact('data'), 200);


    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);


        \DB::beginTransaction();
        try {
            $user = State::findOrFail($request->id);
            $user->name = $request->name;
            $user->save();
            \DB::commit();
            if(isset($request->systemRoleId)){
                $user->syncRoles($request->systemRoleId);
            }


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
    public function destroy( State $user)
    {
        $user->delete();
        $message ="تم حذف المنطقة بنجاح";
        return response()->json(compact('message'));
        return response()->json(['message' =>'Item deleted successfully'],200);

    }


    public function stateList(){

        $states=State::get();
        return response()->json([
            'status'=>true,
            'states'=>$states
        ]);
    }
}
