<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SanctumAuthController extends Controller
{
    public function index()
    {     
        //$posts = User::latest('updated_at')->paginate()->rol();

        $posts = User::find(1)->rol();

        //dd($posts);
        
        return $posts;
    }

    public function registro(Request $request){
        $request->validate([
            'name' =>  'required|unique:users',           
            'email' =>  'required',
            'password' =>  'required|confirmed'
        ]);

        //1 forma
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;        
        $user->password=Hash::make($request->password);
        $user->rol_id=$request->rol_id;        
        $user->save();

        //2 forma
        //User::create(request()->all());

        //3 forma
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);

        return response()->json(["mensaje"=>"usuario registrado exitosamente"],201);
    }

    public function login(Request $request){
        $request->validate([
            'name' =>  'required',                       
            'password' =>  'required'
        ]);

        $user=User::where("name","=", $request->name)->first();
        if(isset($user)){
            if(Hash::check($request->password,$user->password)){

                $token=$user->createToken("auth_token")->plainTextToken;
                return response()->json(["mensaje"=>"inicio exitoso","error"=>false,"access_token"=>$token],201);
            }
            else{
                return response()->json(["mensaje"=>"contraseña incorrecta","error"=>true],200);    
            }
        }
        else{
            return response()->json(["mensaje"=>"usuario no existe","error"=>true],200);
        }

    }

    public function perfil(){
        return Auth::user();
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(["status"=>1,"mensaje"=>"se cerró correctamente"]);
    }
}
