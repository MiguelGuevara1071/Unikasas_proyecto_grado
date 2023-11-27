<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailRestaurarPassword;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->intended('usuarios');
        }else{
        return view('login/login');
        }
    }

    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'estado_usuario' => 'Activo'])) {
            return redirect()->intended('usuarios');
        }

        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function restore(){
        return view('login.forgotPassword');
    }

    public function restorePassword(Request $request){
        $email = $request->email;
        $userUpdate = request()->except('_token', '_method', 'telefono', 'email');
        $user = User::where('email', '=', $email)->get();
        if($user){
            foreach($user as $user){
                $telefono = $user->telefono_usuario;
            }
            $password = $this->randomPassword();
            $userUpdate['password'] = bcrypt($password);
            if($request->telefono == $telefono){
                User::where('email', '=', $email)->update($userUpdate);
                $user->passwordUser = $password;
                Mail::to($user->email)->send(new emailRestaurarPassword($user));
            }
        }else{
            return redirect('/forgot');
        }

    }
}
