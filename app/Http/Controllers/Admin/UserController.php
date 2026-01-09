<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // نفس صفحة الداشبورد
    }

    public function data(Request $request)
    {
        $users = User::where('type', 'customer')->latest();

        return DataTables::of($users)
            ->addColumn('status', function ($user) {
                if ($user->is_active) {
                    return '<span class="badge bg-success">Active</span>';
                }
                return '<span class="badge bg-danger">Disabled</span>';
            })
            ->addColumn('actions', function ($user) {
                $btnClass = $user->is_active ? 'btn-danger' : 'btn-success';
                $btnText  = $user->is_active ? 'Disable' : 'Enable';

                return '
                    <button 
                        class="btn btn-sm '.$btnClass.' toggle-status"
                        data-id="'.$user->id.'"
                        data-name="'.$user->name.'"
                        data-status="'.$user->is_active.'">
                        '.$btnText.'
                    </button>
                ';
            })
             ->addColumn('date', function ($user) {
            return Carbon::parse($user->created_at)
                ->format('Y-m-d H:i'); // 2026-01-03 14:35
        })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function toggleStatus(User $user)
    {
        // حماية: لا يمكن تعطيل نفسك
        if ($user->id === Auth::user()->id) {
            return response()->json([
                'message' => 'You cannot disable your own account'
            ], 403);
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->is_active
        ]);
    }
}
