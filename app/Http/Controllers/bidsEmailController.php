<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Listing;
use App\Models\Services;
use App\Models\Shop;
use App\Models\Equipments;
use App\Models\User;
use App\Models\Cart;
use App\Models\orders;
use App\Models\Conversation;
use App\Models\Milestones;
use App\Models\Smilestones;
use Session; 
use Hash;
use Auth;
use Mail;
use Stripe;
use App\Models\taxes;
use App\Models\BusinessBids;

class bidsEmailController extends Controller
{
    
public function bidsAccepted(Request $request)
{

    try { 
    $bid_ids = $request->bid_ids;
    //$investor_mails = array();
    $business_id = $request->business_id;
    foreach($bid_ids as $id){
        if($id !=''){
        $bid = BusinessBids::where('id',$id)->first();
        $investor = User::where('id',$bid->investor_id)->first();
        $investor_mail = $investor->email;

        $list = listing::where('id',$bid->business_id)->first();
        $info=[ 'business_name'=>$list->name ];
        $user['to'] = 'tottenham266@gmail.com'; //$investor_mail;
         Mail::send('bids.accepted', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Bid accepted!');
         });

         //remove
         $bid_remove = BusinessBids::where('id',$id)->delete();
         }
       }
        Session::put('success','Accepted!');
        return redirect()->back();
     
       }
        catch(\Exception $e){
            return response()->json(['failed' =>  $e->getMessage()]);
       }  

   }


public function milestoneCommits($amount,$business_id,$percent){
  try{

   if(Auth::check())
        $investor_id = Auth::id();
    else {
        if(Session::has('investor_email')){   
        $mail = Session::get('investor_email');
        $investor = User::where('email',$mail)->first();
        $investor_id = $investor->id;
      }
    }

    $type = 'Monetery';
    $bids = BusinessBids::create([
      'date' => date('Y-m-d'),
      'investor_id' => $investor_id,
      'business_id' => $business_id,
      'type' => $type,
      'amount' => $amount,
      'representation' => $percent
    ]);

if($bids)
  return response()->json(['success' => 'Success!']);
}

catch(\Exception $e){
  return response()->json(['failed' =>  $e->getMessage()]);
}

}

public function bidCommitsEQP(Request $request){ 

  try{

   if(Auth::check())
        $investor_id = Auth::id();
    else {
        if(Session::has('investor_email')){   
        $mail = Session::get('investor_email');
        $investor = User::where('email',$mail)->first();
        $investor_id = $investor->id;
      }
    }

        $listing_id=$request->listing_id;
        $amount=$request->amount;
        $percent=$request->percent;
        $serial=$request->serial;

        $legal_doc=$request->file('legal_doc');
        $optional_doc=$request->file('optional_doc');

// DOCS UPLOAD
         if($legal_doc) { 
          $uniqid=hexdec(uniqid());
          $ext=strtolower($legal_doc->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            return response()->json(['failed' => 'For business document, Only pdf & docx are allowed!']);
          } 
          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/bidsEquip/'.$listing_id.'/'.$investor_id)) 
          mkdir('files/bidsEquip/'.$listing_id.'/'.$investor_id, 0777, true);

          $loc='files/bidsEquip/'.$listing_id.'/'.$investor_id.'/';
          //Move uploaded file
          $legal_doc->move($loc, $create_name);
          $final_legal_doc=$loc.$create_name;
             }else $final_legal_doc='';


          if($optional_doc) {
          $uniqid=hexdec(uniqid());
          $ext=strtolower($optional_doc->getClientOriginalExtension());
          if($ext!='pdf' && $ext!= 'docx')
          {
            return response()->json(['failed' => 'For business document, Only pdf & docx are allowed!']);
          }
          $create_name=$uniqid.'.'.$ext;
          if (!file_exists('files/bidsEquip/'.$listing_id.'/'.$investor_id)) 
          mkdir('files/bidsEquip/'.$listing_id.'/'.$investor_id, 0777, true);

          $loc='files/bidsEquip/'.$listing_id.'/'.$investor_id.'/';
          //Move uploaded file
          $optional_doc->move($loc, $create_name);
          $final_optional_doc=$loc.$create_name;
             }else $final_optional_doc='';
               

          $photos=$request->file('photos');$total_img='';
          if($photos !='') {
          foreach ($photos as $single_img) { 
            # code... 
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_img->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext;
          $loc='files/bidsEquip/'.$listing_id.'/'.$investor_id.'/';
          //Move uploaded file
          $single_img->move($loc, $create_name);
          $final_img=$loc.$create_name;

          $total_img = $total_img.$final_img.',';
            }
           }  
// DOCS UPLOAD

    $type = 'Asset';
    $bids = BusinessBids::create([
      'date' => date('Y-m-d'),
      'investor_id' => $investor_id,
      'business_id' => $listing_id,
      'type' => $type,
      'amount' => $amount,
      'representation' => $percent,
      'serial' => $serial,
      'legal_doc' => $final_legal_doc,
      'optional_doc' => $final_optional_doc,
      'photos' => json_encode($total_img)
    ]);

    if($bids)
      return response()->json(['success' => 'Success! You will get a notification if your bid is accepted!']);
    }

    catch(\Exception $e){
      return response()->json(['failed' =>  $e->getMessage()]);
    }

}


    //Class Ends Below
}
