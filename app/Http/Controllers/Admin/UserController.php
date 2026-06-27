<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function create()
    {
        $departments = Department::all();
        return view('admin.users.create', compact('departments'));
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|in:admin,manager,user',
            'department_id' => 'required|exists:departments,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password123'),
            'role' => $validated['role'],
            'status' => 'aktif',
            'must_change_password' => true,
            'department_id' => $validated['department_id'],
        ]);

        return redirect('/admin/dashboard')->with('success', 'User berhasil ditambahkan.');
    }

    public function index()
    {
        $query = User::with('department');

        if(request('search')) {
            $search = request('search');

        $query->where(function($q) use ($search){

            $q->where(
                'name',
                'like',
                "%{$search}%"
            )

            ->orWhere(
                'role',
                'like',
                "%{$search}%"
            )

            ->orWhereHas(
                'department', function($deptQuery) use ($search) {
                    $deptQuery->where('name', 'like', "%{$search}%");
                });
            

        });

    }

    $users = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $departments = Department::all();

        return view('admin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,manager,user',
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id_department',
        ]);

        $user->fill($validated);

        if ($user->isDirty()) {
        $user->save(); // Simpan jika ada perubahan
        return redirect('/admin/users')->with('success', 'Data user berhasil diperbarui.');
        }

        // Jika data sama persis, kembalikan dengan pesan peringatan/info
        return redirect('/admin/users')->with('info', 'Tidak ada perubahan data yang disimpan.');
        }
}
