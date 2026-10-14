<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->role, fn ($q, $v) => $q->where('role', $v))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // Khóa / mở khóa tài khoản
    public function toggle(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Không thể khóa chính mình.');
        $user->update(['status' => !$user->status]);

        return back()->with('success', 'Đã cập nhật tài khoản.');
    }
}