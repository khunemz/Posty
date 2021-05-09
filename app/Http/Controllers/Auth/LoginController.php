<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }
    //
    public function index() {
        return view('auth.login');
    }
    public function store(Request $request) {
        $email = $request['email'];
        $password = $request['password'];

        $messages = [
            'email' => 'รูปแบบอีเมลล์ไม่ถูกต้อง',
        ];
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if(!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->with('status', 'Login Fail, Please try again.');
        }

        return redirect()->route('dashboard');

    }
}
