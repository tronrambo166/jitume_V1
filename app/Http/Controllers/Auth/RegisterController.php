<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    { 

 // $passport=$data['id_passport'];
 // if(isset($data['pin']))
 // $pin=$data['pin'];

 // if(isset($pin) && $pin !=null) {
 //          $uniqid=hexdec(uniqid());
 //          $ext=strtolower($pin->getClientOriginalExtension());
 //          if($ext!='pdf' && $ext!= 'docx')
 //          {
 //            Session::put('login_err','For pin, Only pdf & docx are allowed!');
 //            return redirect()->back();
 //          }

 //          $create_name=$uniqid.'.'.$ext;
 //          //if (!file_exists('files/investor/'.$listing)) 
 //          //mkdir('files/investor/'.$listing, 0777, true);

 //          $loc='files/investor/';
 //          //Move uploaded file
 //          $pin->move($loc, $create_name);
 //          $final_pin=$loc.$create_name;
 //             }else $final_pin=null;

 //   if($passport) {
 //          $uniqid=hexdec(uniqid());
 //          $ext=strtolower($passport->getClientOriginalExtension());
 //          if($ext!='pdf' && $ext!= 'docx')
 //          {
 //            Session::put('login_err','For passport, Only pdf & docx are allowed!');
 //            return redirect()->back();
 //          }

 //          $create_name=$uniqid.'.'.$ext;
 //          $loc='files/investor/';
 //          //Move uploaded file
 //          $passport->move($loc, $create_name);
 //          $final_passport=$loc.$create_name;
 //             }else $final_passport='';          


        return User::create([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            //'pin' => $final_pin,
            //'id_passport' => $final_passport,
        ]);
    }
}
