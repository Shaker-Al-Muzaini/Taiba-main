<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomersController extends Controller
{
    public function adminIndex()
    {
        return view('admin.customers');
    }
    public function customerList(Request $request){
        $customers=Customer::get();
        return response()->json([
            'status'=>true,
            'customers'=>$customers
        ]);
    }

    public function adminSearch()
    {
        $users = new Customer();
        $users = $users->with('state');
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
//            'email' => 'nullable|string|email|unique:customers',
            'mobile' => 'required|unique:customers',
            'state' => 'required',
//            'password' => 'required',

//            'role' => 'required',
//            'user_avatar' => 'required',
        ]);



        try {
            \DB::beginTransaction();



            $user =  Customer::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'state_id' =>@$request->state?$request->state['id']:null,
//                'address' => $request->address,
//                'role' => $request->role,
//                'password' => bcrypt($request->password),
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
//            'email' => ['nullable',Rule::unique('customers')->ignore($request->id, 'id')],
            'mobile' => 'required',
            'state' => 'required',
//            'address' => 'required',
//            'user_avatar' => 'required',
        ]);


        \DB::beginTransaction();
        try {
            $user = Customer::findOrFail($request->id);
            $user->name = $request->name;
            $user->state_id =@$request->state?$request->state['id']:null;
            $user->mobile = $request->mobile;
//            $user->address = $request->address;
//            if ($request->password) {
//                $user->password = bcrypt($request->password);
//            }

            $user->save();
//            if($request->role=="admin"){
//                if(isset($request->systemRoleId)){
//                    $rolesList=collect($request->admin_role)->pluck('id');
//                    $user->syncRoles($request->systemRoleId);
//                }

//            $user->save();
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


    public function destroy(Customer $user)
    {
        $user->delete();
        $message = "تم حذف الزبون بنجاح";
        return response()->json(compact('message'));
    }
}
