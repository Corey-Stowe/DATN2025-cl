<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $profile = Auth::user();
        // $roleType = $profile->roles->role_type;

        // return view('admin::profile.index' , ['users' => $profile, 'role_type' => $roleType] );
        $user = User::query()
        ->select(
            'users.id as id',
            'users.user_name as user_name',
            'users.full_name as full_name',
            'users.phone as phone',
            'users.email as email',
            'users.password as password',
            'users.address as address',
            'users.user_image as user_image',
            'users.roles_id as roles_id',
            'roles.name as role_type',
            'users.status as status',
            'users.verify as verify'
        )
        ->join('roles', 'users.roles_id', '=', 'roles.id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $roles = Role::whereNotIn('id', [15])->get();
        // Lấy các role mà người dùng hiện tại đang có (vì chúng là mối quan hệ many-to-many)
        $userRoleIds = $user->roles->pluck('id')->toArray();
        //dd($userRoleIds);
        return view('admin::profile.index', compact('user','roles','userRoleIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profile = User::find($id);

        return view('admin::profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $messages = [
            'full_name.required' => 'Trường họ và tên là bắt buộc.',
            'full_name.string' => 'Trường họ và tên phải là một chuỗi ký tự.',
            'full_name.max' => 'Trường họ và tên không được vượt quá 255 ký tự.',
            'current_password.required' => 'Trường mật khẩu hiện tại là bắt buộc.',
            'new_password.required' => 'Trường mật khẩu mới là bắt buộc.',
            'new_password.string' => 'Mật khẩu mới phải là một chuỗi ký tự.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Mật khẩu mới và xác nhận mật khẩu không khớp.',
            'new_password.regex' => 'Mật khẩu mới phải có ít nhất một chữ cái, một chữ số và một ký tự đặc biệt.',
            'new_password_confirmation.required_with' => 'Trường xác nhận mật khẩu mới là bắt buộc khi có mật khẩu mới.',
            'new_password_confirmation.same' => 'Xác nhận mật khẩu mới phải giống với mật khẩu mới.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại phải là dãy số hợp lệ.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
        ];

        $rules = [
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|regex:/^\d{10,15}$/|max:15',
        ];

        if ($request->new_password != null || $request->current_password != null) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|string|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';
            $rules['new_password_confirmation'] = 'required_with:new_password|same:new_password';
        }

        $request->validate($rules, $messages);

        $profile = User::find($request->id);

        if ($request->new_password != null) {
            $profile->password = Hash::make($request->new_password);
        }
        $profile->user_name = $request->user_name;
        $profile->full_name = $request->full_name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;

        if ($request->filled('address')) {
            $profile->address = $request->address;
        }
         // Xử lý hình ảnh
         $filePath = $profile->user_image; // Giữ nguyên hình ảnh cũ nếu có
         if ($request->hasFile('user_image')) {
             $filePath = $request->file('user_image')->store('/users_image', 'public');

             // Xóa hình cũ nếu có hình ảnh mới đẩy lên
             if ($profile->user_image && Storage::disk('public')->exists($profile->user_image)) {
                 Storage::disk('public')->delete($profile->user_image);
             }
         }

         $profile->user_image = $filePath;

        // $imageOld = $profile->user_image;
        // $data = $request->except("user_image");
        // if ($request->hasFile('user_image') && $request->file('user_image')->isValid()) {
        //     $data['user_image'] = $this->uploadFile($request->file('user_image'));
        //     $res = User::find($request->id)->update($data);
        //     if ($res) {
        //         if (isset($imageOld) && Storage::disk('public')->exists($imageOld)) {
        //             Storage::disk('public')->delete($imageOld);
        //         }
        //         return redirect()->route('admin.profile.index', ['id' => $request->id])->with('success', 'Sửa thành công');
        //     }
        // } else {
        //     $data['user_image'] = $imageOld;
        //     $res = User::find($request->id)->update($data);
        //     if ($res) {
        //         return redirect()->route('admin.profile.index', ['id' => $request->id])->with('success', 'Sửa thành công');
        //     }
        // }

        $profile->save();

        return redirect()->route('admin.profile.index')->with('success', 'Sửa thông công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
