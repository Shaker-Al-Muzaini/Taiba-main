<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;
use Storage;
use File;
use DB;
class AdminController extends Controller
{
    public function adminIndex()
    {
        return view('admin.mangers');
    }




    public function adminSearch()
    {
        $users = new Admin();

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

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $user = Admin::findOrFail($request->id);
        $user->active = $request->status;
        $user->save();
        if(!$request->status){
            if (isset($user) && $user->tokens) {

                foreach ($user->tokens as $token) {
                    $token->revoke();
                }
            }

        }
        return response()->json([
            'status' => 'success',
            'msg' => 'تم تغيير الحالة بنجاح'
        ], 200);
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|unique:admins',
            'mobile' => 'required|unique:admins',
            'password' => 'required',

//            'role' => 'required',
            'user_avatar' => 'required',
        ]);



        try {
            \DB::beginTransaction();



            $user =  Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
//                'address' => $request->address,
//                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);

            if (!filter_var($request->user_avatar, FILTER_VALIDATE_URL)) {
                if ($request->user_avatar) {
                    $img = Image::make($request->user_avatar);
                    $extension = explode('/', $img->mime)[1];
                    $fileNameToStore = rand(1, 99999) . '_' . time() . '.' . $extension;
                    $destinationPath = public_path('uploads/admins/' . $user->id . '/');
                    File::exists($destinationPath) or File::makeDirectory($destinationPath, 755, true);
                    $img->save($destinationPath . $fileNameToStore);
                    $user->avatar = $fileNameToStore;
                }

            }
//        $user->notify(new SignupActivate($user));
            $user->save();

//            if($request->role=="admin"){
//                if(isset($request->systemRoleId)){
////                    $rolesList=collect($request->admin_role)->pluck('id');
//                    $user->syncRoles($request->systemRoleId);
//                }
//            }
            if ($request->user_avatar) {
                $img = Image::make($request->user_avatar);
                $extension = explode('/', $img->mime)[1];
                $fileNameToStore = rand(1, 99999) . '_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/admins/' . $user->id . '/');
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 755, true);
                $img->save($destinationPath . $fileNameToStore);
                $user->avatar = $fileNameToStore;
            } else {
//                $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
//                Storage::put('admins/' . $user->id . '/avatar.png', (string)$avatar);
            }

            $user->save();
//            if(isset($request->systemRoleId)){
////                    $rolesList=collect($request->admin_role)->pluck('id');
//                $user->syncRoles($request->systemRoleId);
//            }
            \DB::commit();

        } catch (\Exception $e) {

            return $e;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something going wrong'
            ], 422);
        }
        $message = 'تم اضافة المستخدم بنجاح!';
        return response()->json(compact('message'), 200);


    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => Rule::unique('admins')->ignore($request->id, 'id'),
            'mobile' => 'required',
//            'address' => 'required',
            'user_avatar' => 'required',
        ]);


        \DB::beginTransaction();
        try {
            $user = Admin::findOrFail($request->id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
//            $user->address = $request->address;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();
            if (!filter_var($request->user_avatar, FILTER_VALIDATE_URL)) {
                if ($request->user_avatar) {
                    $img = Image::make($request->user_avatar);
                    $extension = explode('/', $img->mime)[1];
                    $fileNameToStore = rand(1, 99999) . '_' . time() . '.' . $extension;
                    $destinationPath = public_path('uploads/admins/' . $user->id . '/');
                    File::exists($destinationPath) or File::makeDirectory($destinationPath, 755, true);
                    $img->save($destinationPath . $fileNameToStore);
                    $user->avatar = $fileNameToStore;
                }

            }
//            if($request->role=="admin"){
//                if(isset($request->systemRoleId)){
//                    $rolesList=collect($request->admin_role)->pluck('id');
//                    $user->syncRoles($request->systemRoleId);
//                }

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


    public function destroy(Admin $user)
    {
        $user->delete();
        $message = "تم حذف المستخدم بنجاح";
        return response()->json(compact('message'));
    }
    public function markReadNotification(Request $request){
        if($request->tagret){
            switch ($request->target){

                case 'newOrders':
                    $notifications=auth()->user()->notifications->whereNull('read_at')->where('type','App\Notifications\SignupActivate');
                    foreach ($notifications as $notification){
                        $notification->markAsRead();
                        $notification->save();
                    }
                    break;
                case 'newOffers':
                    $notifications=auth()->user()->notifications->whereNull('read_at')->where('type','App\Notifications\NewOffer');
                    foreach ($notifications as $notification){
                        $notification->markAsRead();
                        $notification->save();
                    }
                    break;
                case 'newMessages':

                    $notifications=auth()->user()->notifications->whereNull('read_at')->where('type','App\Notifications\NewMessage');
                    foreach ($notifications as $notification){
                        $notification->markAsRead();
                        $notification->save();
                    }
                    break;
                case 'newDrivers':
                    $notifications=auth()->user()->notifications->whereNull('read_at')->where('type','App\Notifications\SignupDrivers');
                    foreach ($notifications as $notification){
                        $notification->markAsRead();
                        $notification->save();
                    }
                    break;
            }
        }
        $message = "Notifications marked read ";
        return response()->json(compact('message'));
    }

}
