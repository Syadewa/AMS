<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetCategory;
use Illuminate\Validation\Rule;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $categories = AssetCategory::latest()->paginate(10);

        return view('admin.asset-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.asset-categories.create');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI: Pastikan kode_kategori unik untuk menghindari SQL crash
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:20|unique:asset_categories,kode_kategori',
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. EKSEKUSI
        AssetCategory::create($validated);

        return redirect('/admin/asset-categories')->with('success', 'Kategori aset berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $category = AssetCategory::findOrFail($id);

        return view('admin.asset-categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = AssetCategory::findOrFail($id);

        $validated = $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:20',
                Rule::unique('asset_categories', 'kode_kategori')->ignore($category->id)
            ],
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $category->fill($validated);

       
        if ($category->isDirty()) {
            $category->save();
            return redirect('/admin/asset-categories')->with('success', 'Data kategori berhasil diperbarui.');
        }

        return redirect('/admin/asset-categories')->with('info', 'Tidak ada perubahan data kategori yang disimpan.');
    }

    public function destroy(int $id)
    {
        $category = AssetCategory::findOrFail($id);

        // 1. STRATEGI KEAMANAN RELASI: Cek apakah kategori ini masih dipakai oleh tabel assets
        // Ganti 'assets' dengan nama method relasi yang ada di model AssetCategory kamu
        if ($category->assets()->exists()) {
            return redirect('/admin/asset-categories')->with('info', 'Kategori tidak dapat dihapus karena masih digunakan oleh beberapa aset.');
        }

        // 2. EKSEKUSI JIKA AMAN
        $category->delete();

        return redirect('/admin/asset-categories')->with('success', 'Kategori aset berhasil dihapus.');
    }
}
