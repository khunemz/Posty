<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $name =$request['name'];
        $username =$request['username'];
        $email =$request['email'];
        $password =$request['password'];
        $password_confirmation =$request['password_confirmation'];

        $messages = [
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน'
        ];
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|confirmed',
        ], $messages);


    }
}
