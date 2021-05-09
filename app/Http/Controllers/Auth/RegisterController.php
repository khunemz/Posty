<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }
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
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'max' => ':attribute จำนวนตัวอักษรห้ามเกิน :max',
            'email' => 'รูปแบบอีเมลล์ไม่ถูกต้อง',
            'confirmed' => 'รหัสผ่านและยืนยันรหัสผ่านต้องตรงกัน',
            'unique:email' => ':attribute ได้มีผู้อื่นใช้ไปแล้ว'
        ];
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:8',
        ], $messages);


        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        
        // sign in

        auth()->attempt([
            'email' => $email,
            'password' => $password,
        ]);

        return redirect()->route('dashboard');
    }
}
