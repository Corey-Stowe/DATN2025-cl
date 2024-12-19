<?php

namespace Modules\Admin\App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Create the base query
        $query = User::query();

        // Eager load the roles relationship to avoid N+1 query problem
        $query->with('roles');

        // Exclude the role with ID 15
        $query->whereDoesntHave('roles', function ($query) {
            $query->where('id', 15);
        });

        // Only get users who have roles assigned
        $query->whereHas('roles'); // Ensures the user has at least one role

        $query->select(
            'id',
            'full_name',
            'user_name',
            'phone',
            'email',
            'user_image'
        );

        // Filter by role if provided
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('roles.id', '=', $request->role);
            });
        }

        // Filter by search keyword if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('user_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Return data for AJAX and non-AJAX requests
        return datatables()->eloquent($query)
            ->addColumn('roles_id', function ($user) {
                // Get role IDs instead of role names
                return $user->roles->pluck('id')->implode(', ');
            })
            ->make(true);
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

}
