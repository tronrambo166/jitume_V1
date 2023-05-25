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

//private $auth_id;
   public function __construct()
    {
        $this->middleware('business');   
    }

public function auth_id(){
  $auth_email = Session::get('business_email');
  $auth= User::where('email',$auth_email)->first();
  return $auth->id;
}

public function logoutB(){
  Session::forget('service_login');
  return redirect('home');
}


public function business(){
$business = listing::where('user_id',$this->auth_id())->get();
return view('business.index',compact('business'));
}

public function add_listing(){
//$events = Events::latest()->get();
return view('business.add-listing');

}

public function home(){
$business = listing::where('user_id',$this->auth_id())->get();
return view('business.index',compact('business'));
}


public function listings(){
$listings = Listing::where('user_id',$this->auth_id())->latest()->get();
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
$reason = $request->reason;
$y_turnover = $request->y_turnover;

$pin = $request->pin;
$identification = $request->identification;
$document = $request->document;
$video = $request->video;
$user_id = $this->auth_id();

$listing = Listing::latest()->first();
$listing = ($listing->id)+1;

//FILES
 $image=$request->file('image');
 if($image) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          if($ext!='jpg' && $ext!= 'png' && $ext!='jpeg' && $ext!= 'svg'&& $ext!='gif')
          {
            Session::put('error','For Cover, Only images are allowed!');
            return redirect()->back();
          }
          $create_name=$uniqid.'.'.$ext;
          $loc='images/listing/';
          //Move uploaded file
          $image->move($loc, $create_name);
          $final_img=$loc.$create_name;
             }
          else $final_img='';

 $pin=$request->file('pin');
 if($pin) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($pin->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            Session::put('error','For pin, Only pdf & docx are allowed!');
            return redirect()->back();
          }

          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/business/'.$listing)) 
          mkdir('files/business/'.$listing, 0777, true);

          $loc='files/business/'.$listing.'/';
          //Move uploaded file
          $pin->move($loc, $create_name);
          $final_pin=$loc.$create_name;
             }else $final_pin='';


 $identification=$request->file('identification');
 if($identification) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($identification->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            Session::put('error','For identification, Only pdf & docx are allowed!');
            return redirect()->back();
          }

          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/business/'.$listing)) 
          mkdir('files/business/'.$listing, 0777, true);

          $loc='files/business/'.$listing.'/';
          //Move uploaded file
          $identification->move($loc, $create_name);
          $final_identification=$loc.$create_name;
             }else $final_identification='';


 $document=$request->file('document');
 if($document) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($document->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            Session::put('error','For business document, Only pdf & docx are allowed!');
            return redirect()->back();
          }

          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/business/'.$listing)) 
          mkdir('files/business/'.$listing, 0777, true);

          $loc='files/business/'.$listing.'/';
          //Move uploaded file
          $document->move($loc, $create_name);
          $final_document=$loc.$create_name;
             }else $final_document='';
             


 $video=$request->file('video');
 if($video) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($video->getClientOriginalExtension());
          if($ext!='mpg' && $ext!= 'mpeg' && $ext!='webm' && $ext!= 'mp4' 
            && $ext!='avi' && $ext!= 'wmv')
          { 
            Session::put('error','For video, Only mpg || mpeg || webm || mp4 
            avi || wmv are allowed!');
             
            return redirect()->back();
          }

          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/business/'.$listing)) 
          mkdir('files/business/'.$listing, 0777, true);

          $loc='files/business/'.$listing.'/';
          //Move uploaded file
          $video->move($loc, $create_name);
          $final_video=$loc.$create_name;
             }else $final_video=$request->link;                     

          

//FILES

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
            'reason' => $reason,
            'y_turnover' => $y_turnover,
            'pin' => $final_pin,
            'identification' => $final_identification,
            'document' => $final_document,
            'video' => $final_video
            
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
$user_id = $this->auth_id();
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

        Session::put('success_update','Business Updated!');
        return redirect()->back();

}


public function delete_listing($id){

$milestone = Listing::where('id',$id)->first();

if($milestone->document!= null && file_exists($milestone->document)) 
  unlink($milestone->document);  
  
if($milestone->image!= null && file_exists($milestone->image)) 
  unlink($milestone->image);

if($milestone->pin!= null && file_exists($milestone->pin)) unlink($milestone->pin);

if($milestone->identification  != null && file_exists($milestone->identification)) 
  unlink($milestone->identification);
if($milestone->video!= null && file_exists($milestone->video)) 
  unlink($milestone->video);

$milestones = Listing::where('id',$id)->delete();
return redirect()->back();
}


public function add_eqp(Request $request){
$listing_id = $request->id;
$eq_name = $request->eq_name;
$value = $request->value;
$amount = $request->amount;
$details = $request->details;
$user_id = $this->auth_id();

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
$milestones = Milestones::where('user_id',$this->auth_id())->latest()->get();
$business = listing::where('user_id',$this->auth_id())->get();
return view('business.add_milestones',compact('business','milestones'));
}

public function getMilestones($id){ 
 $milestones = Milestones::where('listing_id',$id)->get(); $c=0;$d=0;$test='';
  foreach($milestones as $mile){
  if($mile->status == 'In Progress') $c++;
  if($mile->status != 'Done') $d++;
}

 if($c==0 && $d!=0){
  
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
$user_id = $this->auth_id();
$status = 'Created';

$mile = Milestones::where('listing_id',$business_id)->where('status','Created')->first();

if(isset($mile->status) &&  $mile->status ==  'Created')
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
$user_id = $this->auth_id();
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
$user_id = $this->auth_id();

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
$user_id = $this->auth_id();


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
$user_id = $this->auth_id();

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
