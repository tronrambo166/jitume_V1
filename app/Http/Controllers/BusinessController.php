<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Services;
use App\Models\Shop;
use App\Models\Equipments;
use App\Models\User;
use App\Models\businessDocs;
use App\Models\Milestones;
use Response;
use Session; 
use Hash;
use Auth;
use Mail;
use DB;

class BusinessController extends Controller
{

public function logoutB(){
  Session::forget('service_login');
  return redirect('home');
}


public function registerB(Request $request){
$name = $request->name;
$email = $request->email;
$password = Hash::make($request->password);
$phone = $request->phone;
$business = 1;

User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            //'phone' => $phone,
            'business' => $business           
           ]);       

        Session::put('service_login','true');
        return redirect('/business');

}

public function business(){
$business = listing::where('user_id',Auth::id())->get();
return view('business.index',compact('business'));
}

public function add_listing(){
//$events = Events::latest()->get();
return view('business.add-listing');

}

public function home(){
$business = listing::where('user_id',Auth::id())->get();
return view('business.index',compact('business'));
}


public function listings(){
$listings = Listing::latest()->get();
return view('business.listings',compact('listings'));
}


public function save_listing(Request $request){
$title = $request->title;
$contact = $request->contact;
$category = $request->category;
$details = $request->details;
$location = $request->location;
$investment_needed = $request->investment_needed;
$share = $request->share;
$contact_mail = $request->contact_mail;
$y_turnover = $request->y_turnover;
$user_id = Auth::id();

 $image=$request->file('image');
 if($image) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='images/listing/';
          //Move uploaded file
          $image->move($loc, $create_name);
          $final_img=$loc.$create_name;
             }
          else $final_img='';

Listing::create([
            'name' => $title,
            'user_id' => $user_id,
            'contact' => $contact,
            'contact_mail' => $contact_mail,
            'category' => $category,
            'details' => $details,
            'location' => $location,
            'investment_needed' => $investment_needed,
            'share' => $share,
            'image' => $final_img,
            'y_turnover' => $y_turnover
            
           ]);       

        Session::put('success','Business added!');
        return redirect()->back();

}

public function up_listing(Request $request){
$title = $request->title;
$contact = $request->contact;
$category = $request->category;
$details = $request->details;
$location = $request->location;
$investment_needed = $request->investment_needed;
$share = $request->share;
//$contact_mail = $request->contact_mail;
$user_id = Auth::id();
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

Listing::where('id',$id)->update([
            'name' => $title,
            'contact' => $contact,
            'category' => $category,
            'details' => $details,
            'location' => $location,
            'investment_needed' => $investment_needed,
            'share' => $share     
           ]);       

        Session::put('success','Business Updated!');
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


//MILESTONES
public function delete_milestone($id){
$milestones = Milestones::where('id',$id)->delete();
return redirect()->back();
}

public function add_milestones(){
$milestones = Milestones::where('user_id',Auth::id())->latest()->get();
$business = listing::where('user_id',Auth::id())->get();
return view('business.add_milestones',compact('business','milestones'));
}

public function getMilestones($id){ 
 $milestones = Milestones::where('listing_id',$id)->get(); $c=0;$test='';
  foreach($milestones as $mile)
  if($mile->status == 'In Progress') $c++;

 if($c==0){
  
  $milestones[0]->status = 'In Progress';
}

return response()->json([ 'data' => $milestones ]);

 }

 public function download_milestone_doc($id){
    
    $file="files/milestones/1/1765896965832438.docx";
    $headers = array('Content-Type'=> 'application/pdf');
    return Response::download($file, 'milestone.pdf', $headers);
    return response()->json(['data'=>'success']);

    }



public function milestones(){
$milestones = Milestones::wh()->get();
return view('business.milestones',compact('milestones'));
}



public function save_milestone(Request $request){
$title = $request->title;
$business_id = $request->business_id;
$amount = $request->amount;
$user_id = Auth::id();
$status = 'Created';

$mile = Milestones::where('listing_id',$business_id)->where('status','Created')->first();

if($mile->status == 'Created')
$status = 'On Hold';

 $single_img=$request->file('file');
 
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            Session::put('file_error','Only pdf & docx are allowed!');
            return redirect()->back();
          }

          $create_name=$uniqid.'.'.$ext;

          if (!file_exists('files/milestones/'.$business_id)) 
          mkdir('files/milestones/'.$business_id, 0777, true);

          $loc='files/milestones/'.$business_id.'/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_file=$loc.$create_name;
           

Milestones::create([
            'user_id' => $user_id,
            'title' => $title,
            'listing_id' => $business_id,
            'amount' => $amount,
            'document' => $final_file,
            'status' => $status           
           ]);       

        Session::put('success','Milestone added!');
        return redirect()->back();

}


public function mile_status(Request $request){
$milestones = Milestones::where('id',$request->id)
->update([
'status' => $request->status
]);
return redirect()->back();
}


public function up_milestone(Request $request){
$title = $request->title;
$contact = $request->contact;
$category = $request->category;
$details = $request->details;
$location = $request->location;
$investment_needed = $request->investment_needed;
$share = $request->share;
//$contact_mail = $request->contact_mail;
$user_id = Auth::id();
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
          Milestones::where('id',$id)->update(['image' => $final_img ]); 
             }

Milestones::where('id',$id)->update([
            'name' => $title,
            'contact' => $contact,
            'category' => $category,
            'details' => $details,
            'location' => $location,
            'investment_needed' => $investment_needed,
            'share' => $share     
           ]);       

        Session::put('success','Business Updated!');
        return redirect()->back();

}

//END MILESTONES



public function add_docs(Request $request){
//$name = $request->name;
  //return $request->all();
$listing = $request->listing;
$user_id = Auth::id();

          $files=$request->file('files'); //print_r($files);
 
          foreach ($files as $single_img) { 
            # code...
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            Session::put('file_error','Only pdf & docx are allowed!');
            return redirect('business');
          }

          $create_name=$uniqid.'.'.$ext;

          if (!file_exists('files/business/'.$listing)) 
          mkdir('files/business/'.$listing, 0777, true);

          $loc='files/business/'.$listing.'/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_file=$loc.$create_name;
           
           businessDocs::create([
            'user_id' => $user_id,
            'business_id' => $listing,
            'file' => $final_file         
           ]);

             } 

        Session::put('success','Documents added!');
        return redirect('business');

}


public function add_video(Request $request){
//$name = $request->name;
$listing = $request->listing;
$user_id = Auth::id();


          $single_img=$request->file('files'); //print_r($files);
 
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          if($ext!='mpg' && $ext!= 'mpeg' && $ext!='webm' && $ext!= 'mp4' 
            && $ext!='avi' && $ext!= 'wmv')
          { 
            Session::put('file_error','Only mpg || mpeg || webm || mp4 
            avi || wmv are allowed!');
            return redirect('business');
          }

          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/business/'.$user_id)) 
          mkdir('files/business/'.$user_id, 0777, true);

          $loc='files/business/'.$user_id.'/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_file=$loc.$create_name;
           
           businessDocs::create([
            'user_id' => $user_id,
            'business_id' => $listing,
            'file' => $final_file,
            'media' => 1
          
           ]);

        Session::put('success','Media added!');
        return redirect('business');

}


public function embed_business_video(Request $request){
$link = $request->link;
$listing = $request->listing;
$user_id = Auth::id();

           businessDocs::create([
            'user_id' => $user_id,
            'business_id' => $listing,
            'file' => $link,
            'media' => 1        
           ]);

        Session::put('success','Media Embedded!');
        return redirect('business');

}


//Class Bracket
}
