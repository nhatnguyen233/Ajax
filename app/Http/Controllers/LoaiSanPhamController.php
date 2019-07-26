<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\ProductType;
use View;
use App\Repositories\Post\PostRepositoryInterface;

class LoaiSanPhamController extends Controller
{

    protected $postRepository;

    protected $rules = [
                'loaisanpham' => 'required|min:2|max:32|',
                'noidung' => 'required|min:2|max:500|',
                'thuonghieu' => 'required'
             ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = ProductType::all();
        return view('admincp.loaisanpham.list', ['type'=>$type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rules);
        if($validator->fails()){
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }else{

            $type = new ProductType;

            $type->loaisanpham    = $request->loaisanpham;
            $type->noidung        = $request->noidung;
            $type->thuonghieu     = $request->thuonghieu;

            $type->save();
            return response()-> json($type);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $edit = ProductType::findOrFail($id);

            $edit->loaisanpham = $request->loaisanpham;
            $edit->noidung     = $request->noidung;
            $edit->thuonghieu  = $request->thuonghieu;

            $edit->save();
            return response()->json($edit);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ProductType::findOrFail($id);
        $delete->delete();
        return response()->json(['success'=>'Xóa thành công']);
    }
}
