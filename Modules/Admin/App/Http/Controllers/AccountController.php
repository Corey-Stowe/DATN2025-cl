<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\model_has_roles;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNotIn('id', [15])->get();
      // dd($roles);
        return view('admin::contents.authentication.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('id', [15])->get();
        return view('admin::contents.authentication.create', compact('roles'));
    }

    public function uploadFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('users_image', $filename, 'public');
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = $request->except('img');
        $data = $request->except('password');

        $roleIds = $request->input('roles', []); // Get the selected role IDs

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $data['user_image'] = $this->uploadFile($request->file('img'));
        } else {
            $data['user_image'] = null;
        }

        $data['status'] = 'active';
        $data['verify'] = '1';
        $data['password'] = Hash::make($request->password);
 //get first array in role
        $data['roles_id'] = $roleIds[0];
        $res = User::create($data);

        if ($res) {
            // Attach roles to the newly created user
            if (!empty($roleIds)) {
                $res->roles()->sync($roleIds); // Use sync() to assign roles, or attach() if you want to add without removing others
            }

            // Redirect back with success message
            return redirect()->route('admin.accounts.index')->with('success', 'Account đã được thêm mới!');
        } else {
            // Redirect back with error message
            return redirect()->route('admin.accounts.index')->with('error', 'Account không được thêm mới!');
        }
    }


    public function show($id)
    {
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
            ->where('users.id', '=', $id)
            ->first();

            $roles = Role::whereNotIn('id', [15])->get();

            // Lấy các role mà người dùng hiện tại đang có (vì chúng là mối quan hệ many-to-many)
            $userRoleIds = $user->roles->pluck('id')->toArray();
        //dd($user);
        if ($user) {
            return view('admin::contents.authentication.show', compact('roles', 'user','userRoleIds'));
        } else {
            return redirect()->route('admin.accounts.index')->with('info', 'Tài khoản không tồn tại.');
        }
    }
    public function edit($id)
    {
        // Tìm người dùng
        $user = User::find($id);

        // Lấy tất cả các role, trừ role có id là 15
        $roles = Role::whereNotIn('id', [15])->get();

        // Lấy các role mà người dùng hiện tại đang có (vì chúng là mối quan hệ many-to-many)
        $userRoleIds = $user->roles->pluck('id')->toArray();

        if ($user) {
            return view('admin::contents.authentication.edit', compact('roles', 'user', 'userRoleIds'));
        } else {
            return redirect()->route('admin.accounts.index')->with('info', 'Tài khoản không tồn tại.');
        }
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $check = User::find($id); // Tìm người dùng
        if (!$check) {
            return redirect()->route('admin.accounts.index')->with('info', 'Không tìm thấy tài khoản');
        }

        $imageOld = $check->user_image;
        $data = $request->except('img');
        $roleIds = $request->input('roles', []); // Lấy danh sách các role đã chọn

        // Cập nhật ảnh nếu có
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $data['user_image'] = $this->uploadFile($request->file('img'));
        } else {
            $data['user_image'] = $imageOld; // Giữ lại ảnh cũ nếu không thay đổi
        }

        // Cập nhật thông tin người dùng
        $res = $check->update($data);

        if ($res) {
            // Cập nhật vai trò cho người dùng
            $check->syncRoles($roleIds);

            // Xóa ảnh cũ nếu đã thay đổi
            if (isset($imageOld) && Storage::disk('public')->exists($imageOld)) {
                Storage::disk('public')->delete($imageOld);
            }

            return redirect()->route('admin.accounts.edit', ['id' => $id])->with('success', 'Sửa thành công');
        } else {
            return redirect()->route('admin.accounts.edit', ['id' => $id])->with('error', 'Không thể cập nhật tài khoản');
        }
    }

}
