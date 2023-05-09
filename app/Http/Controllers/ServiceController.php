<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Services;
use App\Models\Shop;
use App\Models\Equipments;
use App\Models\User;
use Session; 
use Hash;
use Auth;
use Mail;
use DB;

class ServiceController extends Controller
{

public function registerS(Request $request){
$name = $request->name;
$email = $request->email;
$password = Hash::make($request->password);
$phone = $request->phone;
$service = 1;

User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            //'phone' => $phone,
            'service' => $service           
           ]);       

        Session::put('service_login','true');
        return redirect('/services');

}

public function logoutS(){
  Session::forget('service_login');
  return redirect('home');
}

public function services(){
return view('services.index');
}

public function add_listing(){
//$events = Events::latest()->get();
return view('services.add-listing');

}

public function listings(){
$listings = Services::latest()->get();
return view('services.listings',compact('listings'));
}


public function save_listing(Request $request){
$title = $request->title;
$category = $request->category;
$details = $request->details;
$price = $request->price;
$location = $request->location;
$user_id = Auth::id();

 $image=$request->file('image');
 if($image) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='images/services/';
          //Move uploaded file
          $image->move($loc, $create_name);
          $final_img=$loc.$create_name;
             }
          else $final_img='';

Services::create([
            'name' => $title,
            'shop_id' => $user_id,
            'price' => $price,
            'category' => $category,
            'details' => $details,
            'location' => $location,
            'image' => $final_img           
           ]);       

        Session::put('success','Service added!');
        return redirect()->back();

}

public function up_listing(Request $request){
$title = $request->title;
$category = $request->category;
$details = $request->details;
$price = $request->price;
$location = $request->location;
$user_id = Auth::id();
$old_img = $request->old_img;
$id = $request->id;

 $image=$request->file('image');
 if($image) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='images/listing/';
          //Move uploaded file
          $image->move($loc, $create_name);
          $final_img=$loc.$create_name;
          Listing::where('id',$id)->update(['image' => $final_img ]); 
             }
             else $final_img = $old_img;

Services::where('id',$id)->update([
            'name' => $title,
            'shop_id' => $user_id,
            'price' => $price,
            'category' => $category,
            'details' => $details,
            'location' => $location,
            'image' => $final_img    
           ]);       

        Session::put('success','Service Updated!');
        return redirect()->back();

}

public function add_eqp(Request $request){
$listing_id = $request->id;
$eq_name = $request->eq_name;
$value = $request->value;
$amount = $request->amount;
$details = $request->details;
$user_id = Auth::id();

Equipments::create([
            'eq_name' => $eq_name,
            'value' => $value,
            'amount' => $amount,
            'details' => $details,
            'listing_id' => $listing_id  
           ]);       
        Session::put('success','Equipment added!');
        return redirect()->back();
}

public function save_service(Request $request){
$s_name = $request->s_name;
$phone = $request->phone;
$service_cats = implode(',', $request->service_cats);
$instant_book = $request->instant_book;
$s_details = $request->s_details;
$s_loction = $request->s_loction;
$max_guests = $request->max_guests;
$min_guests = $request->min_guests;
$reservation_start = $request->reservation_start;
$reservation_end = $request->reservation_end;
$s_per_day = $request->s_per_day;
$s_per_hour = $request->s_per_hour;

$user_id = Auth::id();



Services::create([
            'user_id' => $user_id,
            's_name' => $s_name,
            'phone' => $phone,
            'service_cats' => $service_cats,
            'instant_book' => $instant_book,
            's_details' => $s_details,
            's_loction' => $s_loction,
            'max_guests' => $max_guests,
            'min_guests' => $min_guests,
            'reservation_start' => $reservation_start,
            'reservation_end' => $reservation_end,
            's_per_day' => $s_per_day,
            's_per_hour' => $s_per_hour
           ]);

          $image=$request->file('s_posters'); //print_r($image);

          if($image) {
          foreach ($image as $single_img) { 
            # code...
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='images/services/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_img=$loc.$create_name;
           //getting event id
          $ev=Services::orderBy('id', 'DESC')->first();
          $ev_id=($ev->id);

           Images::create([
            'img_name' => $create_name,
            's_id' => $ev_id
           ]);

             } }

        Session::put('success','Service added!');
        return redirect('home');

}

}
