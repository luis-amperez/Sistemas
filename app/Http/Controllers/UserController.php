<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request){

        $response = ["status"=>0,"msg"=>""];

        $data = json_decode($request->getContent());

        $user = User::where('email',$data->email)->first();
        $error_codigo=0;
        if($user){

            if(Hash::check($data->password,$user->password)){

                $token = $user->createToken("example");

                $response["status"] = 1;
                $response["msg"] = $token->plainTextToken;
                $error_codigo = 200;
            }else{
                $response["msg"] = "Credenciales incorrectas.";
                $error_codigo = 401;
                  
            }

        }else{
            $response["msg"] = "Usuario no encontrado.";
            $error_codigo = 404;
            
        }

        return response()->json($response, $error_codigo);   
             
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        $response["msg"] = "Sesion Finalizada";
        $error_codigo = 404;
        return response()->json($response, $error_codigo);   
             
    }
             

}
