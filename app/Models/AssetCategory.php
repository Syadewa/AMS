<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;

    protected $table = 'asset_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
    ];

    public function assets()
    {
        // 'kategori_id' adalah Foreign Key yang ada di tabel assets
        // 'id' adalah Primary Key yang ada di tabel asset_categories
        return $this->hasMany(Asset::class, 'kategori_id', 'id');
    }
}
