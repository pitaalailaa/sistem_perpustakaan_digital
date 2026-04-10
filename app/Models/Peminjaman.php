<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Buku;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'buku_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
        'denda',
        'is_denda_paid',
        'denda_paid_at',
    ];

    protected $attributes = [
        'status' => 'pending',
        'is_denda_paid' => false,
    ];

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'date',
            'due_date' => 'date',
            'returned_at' => 'date',
            'denda_paid_at' => 'datetime',
            'is_denda_paid' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function getCalculatedDendaAttribute(): int
    {
        if (!$this->due_date) {
            return (int) ($this->denda ?? 0);
        }

        $comparisonDate = $this->returned_at ?: now();

        if ($comparisonDate->lessThanOrEqualTo($this->due_date)) {
            return 0;
        }

        return $this->due_date->diffInDays($comparisonDate) * 3000;
    }

    public function getOutstandingDendaAttribute(): int
    {
        return $this->is_denda_paid ? 0 : $this->calculated_denda;
    }

    public function getCanPayDendaAttribute(): bool
    {
        return in_array($this->status, ['dipinjam', 'request_kembali', 'dikembalikan'], true)
            && $this->outstanding_denda > 0;
    }
}
