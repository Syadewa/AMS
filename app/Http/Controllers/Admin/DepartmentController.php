<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(10);

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'kode_department' => 'required|string|max:20|unique:departments,kode_department',
            'nama_department' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        Department::create($validated);

        return redirect('/admin/departments')->with('success', 'Departemen baru berhasil ditambahkan.');

    }

    public function edit(int $id)
    {
        $department = Department::findOrFail($id);

        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, int $id)
    {
        $department = Department::findOrFail($id);

        $validated = $request->validate([
            'kode_department' => [
                'required', 
                'string', 
                'max:20', 
                Rule::unique('departments', 'kode_department')->ignore($department->getKey(), 'id_department')
            ],
            'nama_department' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $department->fill($validated);

        if ($department->isDirty()) {
            $department->save();
            return redirect('/admin/departments')->with('success', 'Data departemen berhasil diperbarui.');
        }

        // Jika disubmit tanpa ada perubahan sama sekali
        return redirect('/admin/departments')->with('info', 'Tidak ada perubahan data departemen.');
    }
}
