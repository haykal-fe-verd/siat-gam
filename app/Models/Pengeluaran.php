<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = "tb_pengeluaran";
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['tanggal_pengeluaran'];


    public function pemasukan()
    {
        return $this->belongsTo(Pemasukan::class, 'sumber_dana');
    }
}
