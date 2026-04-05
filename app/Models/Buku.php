<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;
use App\Models\Category;

class Buku extends Model
{
    protected $table = 'books'; // nama tabel sesuai kondisi awal

    protected $fillable = [
        'title',
        'judul',
        'author',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'category_id',
        'status',
        'deskripsi',
        'cover',
        'available',
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['title'] ?? $this->attributes['judul'] ?? null;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['judul'] = $value;
    }

    public function getJudulAttribute()
    {
        return $this->attributes['judul'] ?? $this->attributes['title'] ?? null;
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['title'] = $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getPenulisAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        return $this->attributes['author'] ?? null;
    }

    public function setPenulisAttribute($value)
    {
        $this->attributes['author'] = $value;
        $this->attributes['penulis'] = $value;
    }

    public function getStatusAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return ($this->attributes['available'] ?? 0) ? 'tersedia' : 'dipinjam';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;
        $this->attributes['available'] = $value === 'tersedia' ? 1 : 0;
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
