<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Support\MessageBag;

class DangnhapController extends Controller
{
    // protected $rules =
    // [
    //     'email'     => 'required|email',
    //     'pass'  => 'required|min:2|max:32'
    // ];
    
    // protected $messages = [
    //     'email.required'    => 'Bạn chưa nhập email',
    //     'email.email'       => 'Email không phù hợp',
    //     'pass.required'     => 'Bạn chưa nhập mật khẩu',
    //     'pass.min'          => 'Mật khẩu ít nhất 2 kí tự',
    //     'pass.max'          => 'Mật khẩu tối đa 32 kí tự'
    // ] ;

    public function getDangnhapAdmin(){
        
        return view('admincp.login');
    }

    public function postDangnhapAdmin(Request $request){
        
        // $this->validate($request,
        // [
        //     'email'     => 'required|email',
        //     'pass'  => 'required|min:2|max:32'
        // ],
        // [
        //     'email.required'    => 'Bạn chưa nhập email',
        //     'email.email'       => 'Email không phù hợp',
        //     'pass.password' => 'Bạn chưa nhập mật khẩu',
        //     'pass.min'      => 'Mật khẩu ít nhất 2 kí tự',
        //     'pass.max'      => 'Mật khẩu tối đa 32 kí tự'
        // ]);

        // $admin = new User;
        // var_dump($admin->password); die;
        // if($request->email == $admin->email && $request->pass == $admin->password ){
        //     return redirect()->route('sanpham.index');
        // }
        
        $rules   = [
            'email'     => 'required|email',
            'pass'  => 'required|min:2|max:32'
        ];

        $messages = [
            'email.required'    => 'Bạn chưa nhập email',
            'email.email'       => 'Email không phù hợp',
            'pass.required'     => 'Bạn chưa nhập mật khẩu',
            'pass.min'          => 'Mật khẩu ít nhất 2 kí tự',
            'pass.max'          => 'Mật khẩu tối đa 32 kí tự'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
            dd($validator->getMessageBag()->toArray());
    		return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
    	} else {
    		$email = $request->input('email');
    		$password = $request->input('pass');

    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
    			return redirect()->route('sanpham.index');
    		} else {
    			$errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}

        // if(Auth::attempt(['email'=> $request->email, 'password' => $request->pass])){
        //     // var_dump($request->pass); die;
        //     return redirect()->route('sanpham.index');
        // }
        // else{
        //     return redirect('admin/dangnhap');
        // }

    }

    public function logout(){
        return redirect('admin/dangnhap')->with(Auth::logout());
        // Auth::logout();
        // return redirect('admin/dangnhap'); 
    }
}


// $admin = new User;
//     var_dump($admin->password); die;
//     if($request->email == $admin->email && $request->pass == $admin->password ){
//         return redirect()->route('sanpham.index');
//     }
