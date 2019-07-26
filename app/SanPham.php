<?php

namespace App;

use App\ProductType;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table ="sanpham";

    protected $fillable = ['name', 'tomtat','danhgia', 'gia', 'id_type'];

    public function showLaptop()
    {
        $sanpham = SanPham::all();
        // dd($laptop);
        return $sanpham;
    }

    public function add($input)
    {
        return $sanpham = SanPham::create($input);
    }

    public function producttype(){
        return $this->belongsTo('App\ProductType','id_type', 'id');
    }

}
