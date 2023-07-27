<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    public $datauser;
    public $correo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent'),'correo'=>$this->correo]);
        }

        return response()->json($user);
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
            'codigo'=> 'required|numeric',    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $request): User
    {
        try{
            $user=$this->datauser;
            $this->correo=trim($user['Correo Institucional']);
            $u= User::create([
                'name' => $user['Nombres'].' '.$user['Apellido paterno'].' '.$user['Apellido materno'],
                'email' => $this->correo,
                'password' => bcrypt($request['password']),
                'codigo'=>$request['codigo'],
                'dni'=>$user['Dni'],
                'rol_id'=>4,
            ]);
            
            return $u;
        }catch(Exception $e){
            abort(405,'Error al crear el usuario');
        }
    }

    protected function registrar(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
            'codigo'=> 'required|numeric|unique:users,codigo',    
        ]);
        try{    
            $this->datauser=$this->get_data_user($request->codigo);
            if(isset($this->datauser['message']) ){
                return response()->json(['message'=>$this->datauser['message']],405);
            }

            $correo=trim($this->datauser['Correo Institucional']);
            $validate= (false !==filter_var($correo, FILTER_VALIDATE_EMAIL));
            if(!$validate){
                return response()->json(['message'=>'El correo no es valido por favor actualiza'],409);
            } 

            return $this->register($request);

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    protected function get_data_user($codigo){
        try{
            $response = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/'.$codigo);
            return $response;                   
        }catch(Exception $e){
            return array('message' => 'Error de conexion con servicion de UNDAC',405 );
        }
    }
}
