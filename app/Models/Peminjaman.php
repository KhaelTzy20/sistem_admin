<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'item_id',
        'employee_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'foto_terima',
        'foto_kembali',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}