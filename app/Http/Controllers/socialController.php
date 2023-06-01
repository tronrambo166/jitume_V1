<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;
use Mail;
use Laravel\Socialite\Facades\Socialite;
use DateTime;
use DateTimeZone;
use DB;

class socialController extends Controller
{

     //Social Login
    public  function google(){
       $user = Socialite::driver('google')->user(); 
        try { 
        $register = $this->patient_reg($user);
        Session::put('social_reg',true);
        if($register == 'services' || $register == 'business' || $register == '/')
        return redirect($register);

        return redirect('social_login'); 
        }
         catch (Exception $e) {
            return $e->message();
        }
             
    }

    public  function facebook(){ 
        $user = Socialite::driver('facebook')->user();
        try { 
        
        $register = $this->patient_reg($user);
        Session::put('social_reg',true);

        if($register == 'services' || $register == 'business' || $register == '/')
        return redirect($register);

        return redirect('social_login'); 
        }
         catch (Exception $e) {
            return $e->message();
        }
    }

    //Social Login


    //PATIENTS
    public function patient_reg($hos)
    {     
      $name=explode(' ',$hos->name);
      $fname = $name[0];
      if (isset($name[2]))
      $lname = $name[1].' '.$name[2];
      else $lname = $name[1];
      $email=$hos->email;

    if($email == null) {
        $email='test@gmail.com';
        Session::put('email_err','You must have an email associated with the facebook id!'); //return redirect('home');
    }

     $user= User::where('email', $email)->get(); 
     if($user->count() >0 ) {
     
      if($user[0]['service'] ==1){ 
          Session::put('service_email', $email);    
          Session::put('service_auth',true);
          return 'services';
      }
      else if($user[0]['business'] == 1){
        Session::put('business_email', $email);    
        Session::put('business_auth',true);
        return 'business';
      }

      else if($user[0]['investor'] == 1){
        Session::put('investor_email', $email);    
        Session::put('investor_auth',true);
        return '/';

      } else return '/';

      }
      else{ 

        try{
          $user = User::create([
          'fname' =>  $fname,
          'lname' =>  $lname,
          'email' =>  $email
          ]);
      }
      catch (Exception $e) {
            return $e->message();
        }

     }

    }



}
