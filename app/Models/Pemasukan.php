<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = "tb_pemasukan";
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['tanggal_pemasukan'];


    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'sumber_dana');
    }
}
