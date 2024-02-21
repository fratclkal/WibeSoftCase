<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(){
        $token = Str::random(60);

        return view('auth.register',compact('token'));
    }

    public function registerPost(Request $request){

        $token = Str::random(60);

        $data = request()->only([
           'name',
           'email',
            'token' => $token,
        ]);

        if (request()->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $controll = User::where('email', $data['email'])->first();

        if ($controll){
            return redirect()->back()
                ->with('mesaj', 'Bu Email Daha Önce Kaydedilmiş')
                ->with('mesaj_tur', 'warning');
        }else{

            $create = User::create($data);

            return redirect()->route('home')
                ->with('mesaj','Kayıt İşlemi Başarılı')
                ->with('mesaj_tur','success');
        }


    }

    public function apiRegisterPost(Request $request){
        $token = Str::random(60);

        $data = [
          'name' => $request->name,
          'email' => $request->email,
        ];

        $data['token'] = $token;


        if (request()->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $controll = User::where('email', $data['email'])->first();

        if ($controll){
            return response()->json($controll);
        }else{

            $create = User::create($data);

            return response()->json($data);
        }

    }

    public function login(){
        return view('auth.login');
    }

    public function apiLoginPost(Request $request){

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)){
            if (Auth::user()->Admin()) {
                return response()->json($data);
            } else {
                return response()->json($data);
            }
        }
        response()->json([
            'message' => 'Hesap Bilgilerinizi Tekrar Kontrol Ediniz.',
            'message_type' => 'danger'
        ], 422);
    }

    public function loginPost(Request $request){
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)){
            if (Auth::user()->Admin()) {
                return redirect()->route('task');
            } else {
                return redirect()->route('task');
            }
        }
        return redirect()->back()
            ->with('mesaj','Hesap Bilgilerinizi Tekrar Kontrol Ediniz.')
            ->with('mesaj_tur', 'danger');
    }

    public function logout(){
        Auth::logout();

        return redirect('/login');
    }

}
