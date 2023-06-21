<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function users(Request $request){

        $response["status"] = 1;
        $response["msg"] = '';

        if (Auth::User()->can('listarUsuario')){
            $usuarios = User::all();
            $response["status"] = 200;
            $response["msg"] = 'Exito';
            $response['data'] = $usuarios;
            return response()->json($response, 200);

        }else{
            $response["msg"] = 'Permiso denegado, comuniquese con su adminstrador';
            return response()->json($response, 401);
        }
        //$users = Hash::make('Admin1234');


        return response()->json($usuarios, 200);
        //return response(["mensaje"=>'Ok'], $users,Response::HTTP_OK);
    }

    public function crearUsuario(Request $request){
        //$response = new StdClass();
        $response["status"] = 1;
        $response["msg"] = '';
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
    //if(Auth::User()->can('listarUsuario')){
        DB::connection('mysql')->beginTransaction();
        try {
            User::create(['name' => $name, 'email' => $email, 'password' => $password]);
            DB::connection('mysql')->commit();
            $response["status"]  = 200;
            $response["msg"] = 'Usuario creado con exito';
             $usuarios = User::all();
             $response['data'] = $usuarios;
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            $response["status"]  = 404;
            $response["msg"] = $th->getMessage();
            return response()->json($response, 404);
        }
    
    //}else{
    //   $response["status"]  = 404;
    //   $response["msg"] = "permiso denegado";
    //   return response()->json($response, 404);
    // }
    return response()->json($response); 
    }

    //--------------------------------------------------------------------------------------------------------------------------------------
    public function eliminarUsuario($id){
        //$response = new StdClass();
        $response["status"] = 1;
        $response["msg"] = '';
        $usuario = User::where('id',$id)->first();

    if(Auth::User()->can('listarUsuario')){
        DB::connection('mysql')->beginTransaction();
        try {
            if (empty($usuario)){

                $response["status"]  = 200;
                $response["msg"] = 'Usuario no existe';
                 $usuarios = User::all();
                 $response['data'] = $usuarios;
                return response()->json($response, 200);
            }else{
                $usuario->delete();
                DB::connection('mysql')->commit();
                $response["status"]  = 200;
                $response["msg"] = 'Usuario eliminado exitosamente';
                 $usuarios = User::all();
                 $response['data'] = $usuarios;
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            $response["status"]  = 404;
            $response["msg"] = $th->getMessage();
            return response()->json($response, 404);
        }
    
    }else{
      $response["status"]  = 404;
      $response["msg"] = "permiso denegado";
      return response()->json($response, 404);
    }
    return response()->json($response); 
    }




    public function eliminarRoles($id){
        //$response = new StdClass();
        $response["status"] = 1;
        $response["msg"] = '';
        $roles = Role::where('id',$id)->first();

    if(Auth::User()->can('listarRoles')){
        DB::connection('mysql')->beginTransaction();
        try {
            if (empty($roles)){

                $response["status"]  = 200;
                $response["msg"] = 'Rol no existe';
                 $roles = Role::all();
                 $response['data'] = $roles;
                return response()->json($response, 200);
            }else{
                $roles->delete();
                DB::connection('mysql')->commit();
                $response["status"]  = 200;
                $response["msg"] = 'Rol eliminado exitosamente';
                 $roles = Role::all();
                 $response['data'] = $roles;
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            $response["status"]  = 404;
            $response["msg"] = $th->getMessage();
            return response()->json($response, 404);
        }
    
    }else{
      $response["status"]  = 404;
      $response["msg"] = "permiso denegado";
      return response()->json($response, 404);
    }
    return response()->json($response); 
    }



    public function eliminarPermisos($id){
        //$response = new StdClass();
        $response["status"] = 1;
        $response["msg"] = '';
        $permisos = Permission::where('id',$id)->first();

    if(Auth::User()->can('listarPermisos')){
        DB::connection('mysql')->beginTransaction();
        try {
            if (empty($permisos)){

                $response["status"]  = 200;
                $response["msg"] = 'Rol no existe';
                 $permisos = Permission::all();
                 $response['data'] = $permisos;
                return response()->json($response, 200);
            }else{
                $permisos->delete();
                DB::connection('mysql')->commit();
                $response["status"]  = 200;
                $response["msg"] = 'Rol eliminado exitosamente';
                 $permisos = Permission::all();
                 $response['data'] = $permisos;
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            $response["status"]  = 404;
            $response["msg"] = $th->getMessage();
            return response()->json($response, 404);
        }
    
    }else{
      $response["status"]  = 404;
      $response["msg"] = "permiso denegado";
      return response()->json($response, 404);
    }
    return response()->json($response); 
    }


//------------------------------------------------------------------------------------------------------------------------------------------------





    public function create() {
        $mensaje= "hola mundo";
        return response()->json($mensaje); 
    }



public function crearPermiso(Request $request){
      
      $response["status"] = 1;
      $response["msg"] = '';
      $name = $request->name;
  //if(Auth::User()->can('listarPermisos')){
      DB::connection('mysql')->beginTransaction();
      try {
          Permission::create(['name' => $name, 'guard_name' => "web"]);
          DB::connection('mysql')->commit();
          $response["status"]  = 200;
          $response["msg"] = 'Permiso creado con exito';
           $permisos = Permission::all();
           $response['data'] = $permisos;
          return response()->json($response, 200);
          } catch (\Throwable $th) {
          DB::connection('mysql')->rollBack();
          $response["status"]  = 404;
          $response["msg"] = $th->getMessage();
          return response()->json($response, 404);
      }
  
  
//   }else{
//     $response["status"]  = 404;
//     $response["msg"] = "permiso denegado";
//     return response()->json($response, 404);
//   }
       return response()->json($response); 
  }

public function asignarPermiso(Request $request){
        //$response = new StdClass();
        $response["status"] = 1;
        $response["msg"] = '';
        $permission_id = $request->permission_id;
        $role_id = $request->role_id;
    //if(Auth::User()->can('listarPermisos')){
        DB::connection('mysql')->beginTransaction();
        try {

            $roles = Role::where('id',$role_id)->first();

            if (!empty($roles)) {
                $permisos = Permission::where('id',$permission_id)->first();
                 if (!empty($permisos)) {
                    $roles->givePermissionTo($permisos); 
                 }
            }else{
            $response["status"]  = 401;
            $response["msg"] = 'No existe el rol enviado ';
            $permisos = Permission::all();
            $response['data'] = $permisos;
            return response()->json($response, 401);
        
            }

            DB::connection('mysql')->commit();
            $response["status"]  = 200;
            $response["msg"] = 'Role asignado a permiso exitosamente';
            $permisos = Permission::all();
            $response['data'] = $permisos;
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::connection('mysql')->rollBack();
            $response["status"]  = 200;
            $response["msg"] = $th->getMessage();
            return response()->json($response, 200);
        }
    
    // }else{
    //   $response["status"]  = 404;
    //   $response["msg"] = "permiso denegado";
    //   return response()->json($response, 404);
    // }
    return response()->json($response); 
    }


public function asignarRol(Request $request){
    
    $response["status"] = 1;
    $response["msg"] = '';
    $model_id = $request->model_id;
    $role_id = $request->role_id;
//if(Auth::User()->can('listarRoles')){
    DB::connection('mysql')->beginTransaction();
    try {
        
        $user = User::where('id',$model_id)->first();


        if (!empty($user)) {
            $role = Role::where('id',$role_id)->first();
             if (!empty($role)) {
                $user->assignRole($role); 
             }

        }else{
            $response["status"]  = 401;
            $response["msg"] = 'No existe el Usuario asignado ';
            $role = Role::all();
            $response['data'] = $role;
            return response()->json($response, 401);
        }
        DB::connection('mysql')->commit();
        $response["status"]  = 200;
        $response["msg"] = 'Usuario asignado a rol exitosamente';
        $role = Role::all();
        $response['data'] = $role;
        return response()->json($response, 200);
    
    } catch (\Throwable $th) {
        DB::connection('mysql')->rollBack();
        $response["status"]  = 200;
        $response["msg"] = $th->getMessage();
        return response()->json($response, 200);
    }

// }else{
//       $response["status"]  = 404;
//       $response["msg"] = "permiso denegado";
//       return response()->json($response, 404);

// }
return response()->json($response);        

}

public function roles(Request $request){

    $response["status"] = 1;
    $response["msg"] = '';

    if (Auth::User()->can('listarRoles')){
        $roles = Role::all();
        $response["status"] = 200;
        $response["msg"] = 'Exito';
        $response['data'] = $roles;
        return response()->json($response, 200);

    }else{
        $response["msg"] = 'Permiso denegado, comuniquese con su adminstrador';
        return response()->json($response, 401);
    }
    //$users = Hash::make('Admin1234');


    return response()->json($users, 200);
    //return response(["mensaje"=>'Ok'], $users,Response::HTTP_OK);
}




public function crearRole(Request $request){
    //$response = new StdClass();
    $response["status"] = 1;
    $response["msg"] = '';
    $name = $request->name;
//if(Auth::User()->can('listarRoles')){
    DB::connection('mysql')->beginTransaction();
    try {
        Role::create(['name' => $name, 'guard_name' => "web"]);
        DB::connection('mysql')->commit();
        $response["status"]  = 200;
        $response["msg"] = 'Rol creado con exito';
         $roles = Role::all();
         $response['data'] = $roles;
        return response()->json($response, 200);
        } catch (\Throwable $th) {
        DB::connection('mysql')->rollBack();
        $response["status"]  = 404;
        $response["msg"] = $th->getMessage();
        return response()->json($response, 404);
    }


//}
// else{
//   $response["status"]  = 404;
//   $response["msg"] = "permiso denegado";
//   return response()->json($response, 404);
// }
     return response()->json($response); 
}


public function permisos(Request $request){

    $response["status"] = 1;
    $response["msg"] = '';

    if (Auth::User()->can('listarPermisos')){
        $permisos = Permission::all();
        $response["status"] = 200;
        $response["msg"] = 'Exito';
        $response['data'] = $permisos;
        return response()->json($response, 200);

    }else{
        $response["msg"] = 'Permiso denegado, comuniquese con su adminstrador';
        return response()->json($response, 401);
    }
    //$users = Hash::make('Admin1234');


    return response()->json($users, 200);
    //return response(["mensaje"=>'Ok'], $users,Response::HTTP_OK);
}



public function logout(Request $request)
    {
        //Auth::logout();
    
        //$request->session()->invalidate();

        $request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        //$user->tokens()->where('id', $tokenId)->delete();

        //$request->session()->regenerateToken();
    
        $response["msg"] = "Sesion Finalizada";
        $error_codigo = 200;
        return response()->json($response, $error_codigo);   
             
    }
        
    public function chektoken(Request $request)
    {

        $response["msg"] = "Token Valido";
        $response["status"] = 200;
        $error_codigo = 200;
        return response()->json($response, $error_codigo);  
    }

}

