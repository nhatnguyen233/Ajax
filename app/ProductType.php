<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table ="producttype";

    protected $fillable = ['loaisanpham', 'thuonghieu','noidung'];

    public function sanpham(){
        return $this->hasMany('App\SanPham','id_type', 'id');
    }

    public function saveData($loaisp, $noidung, $thuonghieu){
        $post = new ProductType();

        $post->loaisanpham = $loaisp;
        $post->noidung = $noidung;
        $post->thuonghieu = $thuonghieu;
    }

    public function publish()
    {
        $this->published_at = now();
        $this->save();
    }
}
