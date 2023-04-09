<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Listing;
use App\Models\Services;
use App\Models\Equipments;
use App\Models\User;
use Session; 
use Hash;
use Auth;
use Mail;


class PagesController extends Controller
{
    //

    public function home(){       
         return view('home')->with('auth_user', auth()->user());
    	
    }


public function getAddress($search){
// Read the JSON file
$json = file_get_contents("js/airports.json");
  
// Decode the JSON file
$array = json_decode($json, true);
// Display data
$results=array();$i=0;
foreach ($array as $loc) {

    if(strtolower($loc['name']) == $search || strtolower($loc['city']) == $search || strtolower($loc['country']) == $search) {
    $results[$i]['name']  = $loc['name'];
    $results[$i]['city']  = $loc['city'];
    $results[$i]['country']  = $loc['country'];$i++;
}

   else if(str_contains(strtolower($loc['name']), $search) || str_contains(strtolower($loc['city']), $search) || str_contains(strtolower($loc['country']), $search)) {
    $results[$i]['name']  = $loc['name'];
    $results[$i]['city']  = $loc['city'];
    $results[$i]['country']  = $loc['country'];$i++;
}
}
return response()->json(['data'=>$results]);
        
    }


public function search(Request $request){
$listing_name = $request->listing_name;
$location = $request->search;
$category = $request->category;
$results = array();
//return response()->json(['success' => $category]);

$check_listing = Listing::where('location',$location)
//->where('category',$category)
->get();

foreach($check_listing as $service){ 
    if (str_contains(strtolower($service->name), $listing_name)) {
        $results[] = $service;
} }

foreach($check_listing as $service){ 
    if (!str_contains(strtolower($service->name), $listing_name)) {
        $results[] = $service;
} }

$listings = $results;
return response()->json(['results'=>$listings, 'success' => "Success"]);

}

public function searchResults($ids){
$results = array();
$ids = explode(',',$ids); 
foreach($ids as $id){ 
    if($id!=''){ 
    $listing = Listing::where('id',$id)->first();
    $results[] = $listing;
}
}
return response()->json([ 'data' => $results] );
}


public function equipments($id){

    $Equipment = Equipments::where('listing_id',$id)->get();
    return response()->json(['data' => $Equipment] );
}


public function invest($listing_id,$id,$amount,$realAmount,$type){
    $investor = User::where('id',Auth::id())->first();

    $Equipment = Equipments::where('id',$id)->first();
    Equipments::where('id',$id)->update([
        'status' => 'inactive'
    ]);

    $listing = listing::where('id',$listing_id)->first();
    $old_amount = $listing->investment_needed;
    $old_share = $listing->share;
    $new_share = ($amount*$old_share)/$old_amount;

    if($old_amount<$amount)
    return response()->json(['response' => '<p class="font-weight-bold text-danger">Error: Value needed is less than given value!</p>'] );

    listing::where('id',$listing_id)->update([
        'investment_needed' => $old_amount-$amount,
        'share' => $old_share-$new_share
    ]); 

        $info=['eq_name'=>$Equipment->eq_name, 
            'Name'=>$investor->name,'amount'=>$amount,
            'email' => $investor->email, 'type'=>$type]; 

        $user['to'] = 'sohaankane@gmail.com';//$listing->contact_mail;

        Mail::send('invest_mail', $info, function($msg) use ($user){
            $msg->to($user['to']);
            $msg->subject('Test Invest Alert!');
        });  

    if($type=='donate')
    return response()->json(['response' => 'Donate request sent successfully!'] );
    else
    return response()->json(['response' => 'Invest request sent successfully!'] );
}



public function create_service(){
$events = Events::latest()->get();
return view('create_service',compact('events'));

}

public function save_event(Request $request){
$name = $request->name;
$type = $request->type;
$category = $request->category;
$event_type = $request->event_type;
$isFree = $request->isFree;
$ev_start = $request->ev_start;
$ev_end = $request->ev_end;
$details = $request->details;
$address = $request->address;
if($request->isFree == 'no'){
$per_day = $request->per_day;
$per_hour = $request->per_hour;
}
else $per_day = $per_hour =null;

$user_id = Auth::id();


Events::create([
            'user_id' => $user_id,
            'name' => $name,
            'type' => $type,
            'category' => $category,
            'event_type' => $event_type,
            'isFree' => $isFree,
            'ev_start' => $ev_start,
            'ev_end' => $ev_end,
            'details' => $details,
            'per_day' => $per_day,
            'per_hour' => $per_hour
           ]);

          $image=$request->file('posters'); //print_r($image);

          if($image) {
          foreach ($image as $single_img) { 
            # code...
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='images/events/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_img=$loc.$create_name;
           //getting event id
          $ev=Events::orderBy('id', 'DESC')->first();
          $ev_id=($ev->id);

           Images::create([
            'img_name' => $create_name,
            'ev_id' => $ev_id
           ]);

             } }

        Session::put('success','Event added!');
        return redirect('home');

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

public function booking_request(Request $request){
    return $request->all();
}

public function up_profile(Request $req){
       
// if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
     // return redirect()->route('dashboard');} else return redirect()->back();
// use above or below both are okay
         $user_id=Auth::id();      
         $data['fname'] = $req->fname;
         $data['lname'] = $req->lname;
         $data['name'] =  $req->name;
         $data['email'] = $req->email;
         if($req->password!=null)
         $data['password'] = password_hash($req->password,PASSWORD_DEFAULT);
        
         User::where('id',$user_id)->update($data);
         return back()->with('success', 'Updated!');
       
    }
    


public function profile(){
$id = Auth::id();
$user = User::where('id',$id)->first();
return view('profile',compact('user'));

}



//Class closes
}
