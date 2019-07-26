<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sanpham = SanPham::all();
        return view('admincp.product.list', ['sanpham'=>$sanpham]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        //
        $sanpham = new SanPham;
        
        $sanpham->name      = $rq->name;
        $sanpham->anh       = $rq->anh;
        $sanpham->danhgia   = $rq->danhgia;
        $sanpham->gia       = $rq->gia;

        $sanpham->save();

        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công.');
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
        //
        $sanpham = SanPham::find($id);
        // return view('admincp.sanpham.sua', ['sanpham'=>$sanpham]);
        return response()->json($sanpham,200);
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
        //
        $sanpham = SanPham::find($id);

        $validator = Validator::make($request->all(),
        [
            'name' => 'min:3|max:100',
            // 'gia'   => 'min:3'
        ],
        [
            'name.min' => 'Tên sản phẩm ít nhất 3 ký tự',
            'name.max' => 'Tên sản phẩm không quá 100 ký tự',
            // 'gia.min' => 'Gia sản phẩm ít nhất 3 ký số',
        ]);
        // $sanpham->name      = $rq->name;
        // $sanpham->anh       = $rq->anh;
        // $sanpham->danhgia   = $rq->danhgia;
        // $sanpham->gia       = $rq->gia;
        if($validator->fails()){
            return response()->json(['error'=>'true', 'message' => $validator->errors()],200);
        }
        // var_dump($request->anh); die;
        $sanpham->update([
            'name'      => $request->name,
            'anh'       => $request->anh,
            'danhgia'   => $request->danhgia,
            'gia'       => $request->gia       
        ]);

        return response()->json(['success'=>'Sửa thành công']);
        // $sanpham->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sanpham = SanPham::find($id);
        $sanpham->delete();
        return response()->json(['success'=>'Xóa thành công']);
    }
}
