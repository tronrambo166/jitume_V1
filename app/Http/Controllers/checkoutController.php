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
use App\Models\serviceBook;
use App\Models\ServiceMileStatus;
use Session; 
use Hash;
use Auth;
use Mail;
use Stripe\StripeClient;
use App\Models\taxes;
use App\Models\BusinessBids;
use App\Models\BusinessSubscriptions;
use App\Models\AcceptedBids;


class checkoutController extends Controller
{
     public function __construct(StripeClient $client)
    {
        $this->Client = $client;
    }

    //UNLOCK PAYMENT
     public function goCheckout($amount, $listing_id)
    {
      // $id=$request->id;
      // $listing=$request->listing;
      // $value=$request->value;
      // $amount=$request->amount;
      $listing=base64_decode($listing_id);

      $base_price=base64_decode($amount);
      $price = round( $base_price+($base_price*0.05),2 );
      //$ids=Crypt::decryptString($ids);

    Session::put('small_fee_new_price', $price);
      
        return view('checkout.stripe',compact('price','listing'));
    }

   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

     public function stripeConversation(Request $request)
    {
        $listing_id=$request->listing;
        $package=$request->package;

        //Stripe
    try{

        $curr='USD'; //$request->currency; 
        $amount= Session::get('small_fee_new_price'); //$request->price;
        $transferAmount= round($amount-($amount*.05),2);

        $this->validate($request, [
            'stripeToken' => ['required', 'string']
        ]);
        $charge = $this->Client->charges->create ([ 
                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is test purpose only!"
        ]);
        }
      catch(\Exception $e){
      Session::put('Stripe_failed',$e->getMessage());
      return redirect()->back();
    }

    $business_id = $request->listing;
    $Business = listing::where('id',$business_id)->first();
    $owner = User::where('id', $Business->user_id)->first();

//Split
 try{

        $curr='USD'; //$request->currency; 
        $tranfer = $this->Client->transfers->create ([ 
                //"billing_address_collection": null,
                "amount" => $transferAmount*100, //100 * 100,
                "currency" => $curr,
                "source_transaction" => $charge->id,
                'destination' => $owner->connect_id
        ]);
        }

catch(\Exception $e){
  Session::put('Stripe_failed',$e->getMessage());
    return redirect()->back();
}

 //Stripe


//DB INSERT
    Conversation::create([
        'investor_id' => Auth::id(),
        'listing_id' => $listing_id,
        'package' => $package,
        'price' => $amount
    ]);

        // $info=['eq_name'=>$Equipment->eq_name, 
        //     'Name'=>$investor->name,'amount'=>$amount,
        //     'email' => $investor->email, 'type'=>'invest']; 
        // $user['to'] = 'sohaankane@gmail.com';//$listing->contact_mail;

        // Mail::send('invest_mail', $info, function($msg) use ($user){
        //     $msg->to($user['to']);
        //     $msg->subject('Test Invest Alert!');
        // });  

       Session::put('Stripe_pay','Success!');
       return redirect("/");

    }

    //UNLOCK PAYMENT



     //__________________________SUBSCRIBE________________________
     public function stripeSubscribeGet($amount,$plan,$days,$range)
    {
      //$listing=base64_decode($listing_id);
      $days=base64_decode($days);
      $range=base64_decode($range);
      $plan=base64_decode($plan);
      $base_price=base64_decode($amount);
      $price = round( $base_price+($base_price*0.05),2 );
      Session::put('subscribe_price', $price); 

    //If trial
      $trial_price = 0;
      if($plan == 'silver-trial'){ $trial_price = 9.99;  $payLink = 'https://buy.stripe.com/test_aEU4jm4kNg0PgF2000'; }

      else if($plan == 'gold-trial'){ $trial_price = 29.99; $payLink = 'https://buy.stripe.com/test_4gw3fi18B6qffAY3cd'; }

      else if($plan == 'platinum-trial'){ $trial_price = 69.99; $payLink = 'https://buy.stripe.com/test_00g9DGeZr15V88w5km'; }

      else $trial_price = $price;
      if($price == 0)
        return view('checkoutSubscribe.stripe',compact('price','plan','payLink','trial_price','base_price'));
    //If trial

      if($plan == 'silver' && $days == 30) $price_id = 'price_1O6uaiJkjwNxIm6zzQ5b2t46';
      if($plan == 'gold' && $days == 30) $price_id = 'price_1M7aX9JkjwNxIm6z5ut8ixWC';
      if($plan == 'platinum' && $days == 30) $price_id = 'price_1O7bheJkjwNxIm6zutl9T3HR';

      if($plan == 'silver' && $days == 365) $price_id = 'price_1O7bXyJkjwNxIm6zpTcQdjYg';
      if($plan == 'gold' && $days == 365) $price_id = 'price_1O7bdzJkjwNxIm6zwGCyyLpg';
      if($plan == 'platinum' && $days == 365) $price_id = 'price_1O7bhfJkjwNxIm6zMLsZZTGP';

      $session = $this->Client->checkout->sessions->create([
              'success_url' => 'https://test.jitume.com/stripeSubscribeSuccess?session_id={CHECKOUT_SESSION_ID}',
              'cancel_url' => 'https://example.com/canceled.html',
              'mode' => 'subscription',
              'line_items' => [[
                'price' => $price_id,
                // For metered billing, do not pass quantity
                'quantity' => 1,
              ]],
              'client_reference_id' =>$plan.'_'.$range
            ]);
            echo "<script>location.href='$session->url'</script>";
            //header("Location: " . $session->url);

      //return view('checkoutSubscribe.stripe',compact('price','plan','days','range','trial_price','base_price'));
    }


     public function stripeSubscribeSuccess()
    {
        $session_id = $_GET['session_id'];
        $checkout = $this->Client->checkout->sessions->retrieve(
          $session_id,
          []
        );
        //echo '<pre>'; print_r($checkout);  echo '<pre>'; exit;
        $stripe_sub_id = $checkout->subscription;

        if($checkout->amount_total == 0){
            $sub = $this->Client->subscriptions->retrieve(
              $stripe_sub_id, []
        );
        $transferAmount=0;
        $original_amount = ($sub->items->data[0]->plan->amount)/100;
        if($original_amount == 69.99) $plan = 'platinum-trial';
        if($original_amount == 29.99) $plan = 'gold-trial';
        if($original_amount == 9.99) $plan = 'silver-trial';
        $range = null;
       }

       else{
        $transferAmount=($checkout->amount_total)/100;
        $plan_range=explode('_',$checkout->client_reference_id);
        $plan = $plan_range[0];
        $range = $plan_range[1];
       }

       
        $start_date = date('Y-m-d');
        $expire_date = date('Y-m-d', strtotime($start_date. '+30 days'));

        $token_remaining = null;
        if($plan == 'silver' || $plan == 'gold' || $plan=='silver-trial' || $plan=='gold-trial'){
            $token_remaining = 10;
        }

        $trial = 0;
        if($plan=='silver-trial' || $plan=='gold-trial' || $plan =='platinum-trial'){
            $trial = 1;
            $expire_date = date('Y-m-d', strtotime($start_date. '+7 days'));
        }

    //Stripe
    try{

         //DB INSERT
         BusinessSubscriptions::create([
        'plan' => $plan,
        'investor_id' => Auth::id(),
        'amount' => $transferAmount,
        'start_date' => $start_date,
        'expire_date' => $expire_date,
        'token_remaining' => $token_remaining,
        'chosen_range' => $range,
        'trial' => $trial,
        'stripe_sub_id' => $stripe_sub_id
        ]); 

        if($trial == 1)
        $message = 'Your trial expires in 7 days';
        else if( $original_amount == 95.99 || $original_amount == 287.99 || $original_amount == 671.99 )
            $message = 'Your '.ucwords($plan).' plan expires in 365 days';
        else
        $message = 'Your '.ucwords($plan).' plan expires in 30 days';
       Session::put('Stripe_pay','Success! '.$message);
       return redirect("/");

        }
      catch(\Exception $e){
      Session::put('Stripe_failed',$e->getMessage());
      return redirect("/");
    }

    //Stripe


    }


     public function cancelSubscription($id)
    {
        $investor_id = Auth::id();
        $subs = BusinessSubscriptions::where('id',$id)->first();

    try{
        $cancel = $this->Client->subscriptions->cancel(
        $subs->stripe_sub_id,[]
        );
    }
    catch(\Exception $e){
        Session::put('failed','Subscription does not exist!');
        BusinessSubscriptions::where('id',$id)->delete();
        return redirect()->back();
    }


        BusinessSubscriptions::where('id',$id)->update(['active' => 0]);

        Session::put('Stripe_pay','Subscription Canceled!');
        return redirect("/");
    }
//SUBSCRIBE________________________



    public function stripePost(Request $request)
    {
    $id = $request->id;
    $listing_id = $request->listing;
    $amount = $request->value;
    $realAmount = $request->realAmount;


    //Stripe
    try{

        $curr='USD'; //$request->currency; 
        $amount=$request->price;
        $transferAmount=$amount-($amount*.05);

        $this->validate($request, [
            'stripeToken' => ['required', 'string']
        ]);
        $charge = $this->Client->charges->create ([ 
                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is test purpose only!"
        ]);
        }
      catch(\Exception $e){
      Session::put('Stripe_failed',$e->getMessage());
      return redirect()->back();
    }

    $business_id = $request->listing;
    $Business = listing::where('id',$business_id)->first();
    $owner = User::where('id', $Business->user_id)->first();

//Split
 try{

        $curr='USD'; //$request->currency; 
        $tranfer = $this->Client->transfers->create ([ 
                //"billing_address_collection": null,
                "amount" => $transferAmount*100, //100 * 100,
                "currency" => $curr,
                "source_transaction" => $charge->id,
                'destination' => $owner->connect_id
        ]);
        }

catch(\Exception $e){
  Session::put('Stripe_failed',$e->getMessage());
    return redirect()->back();
}

 //Stripe

   

//DB INSERT
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
            'email' => $investor->email, 'type'=>'invest']; 

        $user['to'] = 'sohaankane@gmail.com';//$listing->contact_mail;

        Mail::send('invest_mail', $info, function($msg) use ($user){
            $msg->to($user['to']);
            $msg->subject('Test Invest Alert!');
        });  


       Session::put('Stripe_pay','Invest request sent successfully!');
       return redirect("/");

    }



     public function milestoneCheckout(Request $request)
    {

    if(Auth::check())
                $investor_id = Auth::id();
            else {
                if(Session::has('investor_email')){   
                $mail = Session::get('investor_email');
                $investor = User::where('email',$mail)->first();
                $investor_id = $investor->id;
              }
            }

    $tax = taxes::where('id',1)->first();
    $tax = $tax->tax+$tax->vat;
    $amount =($request->amount)+($request->amount)*($tax/100);
    $milestone_id =$request->milestone_id;

                //First ML check
                $discount='';
                $first_ml = Milestones::where('investor_id',$investor_id)->where('status','Done')->first();

                $conv = Conversation::where('investor_id',$investor_id)
                ->where('listing_id',$request->lisitng_id)->first();
                
                if(!$first_ml && $conv){
                    $amount = $amount-15;
                    $discount = 'discount - $15! from '.($amount+15).' (conversation fee)';
                    
                }
                //Frist ML check
 
        return view('milestone.stripe',compact('amount','milestone_id','tax','discount'));
    }

   
    public function milestoneStripePost(Request $request)
    {
            if(Auth::check())
                $investor_id = Auth::id();
            else {
                if(Session::has('investor_email')){   
                $mail = Session::get('investor_email');
                $investor = User::where('email',$mail)->first();
                $investor_id = $investor->id;
              }
            }

            try{

            $id = $request->milestone_id; //explode(',',$request->ids);
            $mile = Milestones::where('id',$id)->first();    
            $tax = taxes::where('id',1)->first();$tax = $tax->tax+$tax->vat;
            $amount =($mile->amount)+($mile->amount)*($tax/100);
            $user_id = $mile->user_id;

                //First ML check
                $first_ml = Milestones::where('investor_id',$investor_id)->where('status','Done')->first();
                $conv = Conversation::where('investor_id',$investor_id)
                ->where('listing_id',$mile->listing_id)->first();
                if(!$first_ml){
                    $amount = $amount-15;
                }
                //Frist ML check


                //STRIPE
                 $curr='USD'; //$request->currency; 
                 $amount=round($amount);

                Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');

                Stripe\Charge::create ([ 

                        //"billing_address_collection": null,
                        "amount" => $amount*100, //100 * 100,
                        "currency" => $curr,
                        "source" => $request->stripeToken,
                        "description" => "This payment is tested purpose only!"
                ]);
           


           //MAIL
                $business = listing::where('id',$mile->listing_id)->first();

                $info=[  'name'=>$mile->title,  'amount'=>$mile->amount, 'business'=>$business->name, ]; 
                $user['to'] = $request->email;//'sohaankane@gmail.com';

                 Mail::send('milestone.milestone_mail', $info, function($msg) use ($user){
                     $msg->to($user['to']);
                     $msg->subject('Milestone Status Changed!');
                 });  


        //DB INSERT
            $old_investment = $business->investment_needed;
            $new_investment = $old_investment - $mile->amount;
            listing::where('id',$mile->listing_id)->update(['investment_needed' => $new_investment]);

            Milestones::where('id',$id)->update([ 
                'status' => 'Done'
            ]);

        $mileLat = Milestones::where('investor_id',$investor_id)->where('status','To Do')->first();

        if($mileLat != null) {
            Milestones::where('id',$mileLat->id)->update([ 'status' => 'In Progress']);
        }
        else {
            $mileLat = Milestones::where('status','To Do')
            ->where('listing_id',$mile->listing_id)->first();
            if($mileLat != null) {
            Milestones::where('id',$mileLat->id)->update([ 'status' => 'In Progress']);
        }
        }

               Session::put('Stripe_pay','Milestone paid successfully!');
               return redirect("/");
         }
            catch(\Exception $e){
            Session::put('Stripe_failed',$e->getMessage());
            return redirect()->back();
        }

    }


    //__________ MILESTONES Services _________________________________________

     public function milestoneCheckoutS($milestone_id, $amount)
    {
    $tax = taxes::where('id',1)->first();
    $tax = $tax->tax;
    $amountReal = base64_decode($amount);
    $amount =($amountReal)+($amountReal*($tax/100));
    $milestone_id =base64_decode($milestone_id);

    Session::put('service_part_amount', $amount);
    Session::put('service_part_amount_real', $amountReal);
 
        return view('milestoneS.stripe',compact('amount','milestone_id','tax'));
    }

   
    public function milestoneStripePostS(Request $request)
    {

    if(Auth::check())
        $investor_id = Auth::id();
    else {
        if(Session::has('investor_email')){   
        $mail = Session::get('investor_email');
        $investor = User::where('email',$mail)->first();
        $investor_id = $investor->id;
      }
    }

    $rep_id = $request->milestone_id; //For Replica table
    $mileRep = ServiceMileStatus::where('id',$rep_id)->first();

    $id = $mileRep->mile_id; 

    $mile = Smilestones::where('id',$id)->first();    
    $tax = taxes::where('id',1)->first();$tax = $tax->tax+$tax->vat;

        $amount= Session::get('service_part_amount');//$request->price; 
        $amountReal= Session::get('service_part_amount_real');
    //$amount =($mile->amount)+($mile->amount)*($tax/100);

    $user_id = $mile->user_id;
    $business_id = $mile->listing_id;


    //Stripe
    try{

        $curr='USD'; //$request->currency; 
        $amount=round($amount,2);
        $transferAmount=round($amountReal,2);

        $this->validate($request, [
            'stripeToken' => ['required', 'string']
        ]);
        $charge = $this->Client->charges->create ([ 
                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is test purpose only!"
        ]);
        }
      catch(\Exception $e){
      Session::put('Stripe_failed',$e->getMessage());
      return redirect()->back();
    }

    
    $Business = Services::where('id',$business_id)->first();
    $owner = User::where('id', $Business->shop_id)->first();

//Split
 try{

        $curr='USD'; //$request->currency; 
        $tranfer = $this->Client->transfers->create ([ 
                //"billing_address_collection": null,
                "amount" => $transferAmount*100, //100 * 100,
                "currency" => $curr,
                "source_transaction" => $charge->id,
                'destination' => $owner->connect_id
        ]);
        ServiceMileStatus::where('id',$rep_id)->update([ 'status' => 'In Progress']);
        
    //Check if Asset-related Milestone

        if ($Business->category == '0') 
        {
        $investor = User::where('id',$investor_id)->first();
        $booking = serviceBook::where('service_id',$business_id)
        ->where('booker_id',$investor_id)->first();
        $accepted_bids = AcceptedBids::where('bid_id',$booking->business_bid_id)
        ->first();
        //$realBusiness = listing::where('id',$accepted_bids->business_id)->first();

        $info=[ 'business_owner'=>$accepted_bids->business_id, 'manager'=>$owner->id];
        $user['to'] = $investor->email;
         Mail::send('services.equip_release_request', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Equipment release request!');
         });
        }

    //Check if Asset-related Milestone
        }

catch(\Exception $e){
    Session::put('Stripe_failed',$e->getMessage());
    return redirect()->back();
}

 //Stripe
   


   //MAIL
        $business = Services::where('id',$mile->listing_id)->first();
        $booking = serviceBook::where('booker_id',Auth::id())
        ->where('service_id',$business->id)
        ->where('status', 'Confirmed')->latest()->first();
        $customer = User::where('id',$booking->booker_id)->first();

        $info=[  'name'=>$mile->title,  'amount'=>$mile->amount, 'business'=>$business->name, 's_id' => $business_id, 'customer'=>$customer->fname. ' '.$customer->lname ]; 
        $user['to'] = $owner->email;//'sohaankane@gmail.com';

         Mail::send('milestoneS.milestone_mail', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Milestone Paid!');
         });  


//DB INSERT
    $mileLat = Smilestones::where('listing_id',$business_id)->where('status','On Hold')->first();

// if($mileLat == null) 
// {
//     try{
//         $total = 0;
//         $all_milestone = Smilestones::where('listing_id',$mile->listing_id)->get();
//         foreach($all_milestone as $all_m){
//             $total = $total+$all_m->amount;
//         }
//         orders::create([
//             'user_id' => $mile->user_id,
//             'service_id' => $mile->listing_id,
//             'price' => $total
//         ]);
//     }
//     catch(\Exception $e){
//     Session::put('Stripe_pay', $e->getMessage());
//     return redirect("/");
// }
// }

       Session::put('Stripe_pay','Milestone paid successfully!');
       return redirect("/");

    }


     public function milestoneInvestEQP($listing_id,$mile_id,$investor_id,$owner_id)
    {
        $investor = User::where('id',$investor_id)->first();
        $investor_name = $investor->fname.' '.$investor->lname;
        $owner = User::where('id',$owner_id)->first();
        $business = listing::where('id',$listing_id)->first();
        $mile = Milestones::where('id',$mile_id)->first();

        //MAIL
        try{

        $info=[ 'mile_name'=>$mile->title, 
        'inv_name'=>$investor_name, 
        'inv_contact'=>$investor->email ];

        $user['to'] =  $owner->email; //'tottenham266@gmail.com';

         Mail::send('milestone.milestone_eqp', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Request to invest with equipments!');
         });

        return response()->json(['success' => 'success']);
        }

        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

//BIDS

public function bidCommitsForm($amount,$business_id,$percent)
{   $amount = base64_decode($amount);
    $amountBase = $amount;
    $business_id = base64_decode($business_id);
    $percent = base64_decode($percent);
    $total = $amount+($amount*0.05);
    $amount = round($total,2);
    $amountReal = $amountBase;

    Session::put('bid_new_price', $amount);
    Session::put('bid_original_price', $amountReal);
 
        return view('bids.stripe',compact('amountReal','amount','business_id','percent'));
}

public function bidCommits(Request $request){
   if(Auth::check())
        $investor_id = Auth::id();
    else {
        if(Session::has('investor_email')){   
        $mail = Session::get('investor_email');
        $investor = User::where('email',$mail)->first();
        $investor_id = $investor->id;
      }
    }

 try{
    //Stripe
        $curr='USD'; //$request->currency;
        $amount= Session::get('bid_new_price');//$request->price; 
        $amountReal= Session::get('bid_original_price'); //$request->amountReal;

        $transferAmount=round($amountReal,2);
        $amount = round($amount,2);

        $this->validate($request, [
            'stripeToken' => ['required', 'string']
        ]);
        $charge = $this->Client->charges->create ([ 
                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is test purpose only!"
        ]);
    //Stripe

        }

catch(\Exception $e){
  return response()->json(['failed' =>  $e->getMessage()]);
}


    $business_id = $request->listing;
    $Business = listing::where('id',$business_id)->first();
    $owner = User::where('id', $Business->user_id)->first();

$business_id = $request->listing;
$percent = $request->percent;

 try{
    $type = 'Monetery';
    $bids = BusinessBids::create([
      'date' => date('Y-m-d'),
      'investor_id' => $investor_id,
      'business_id' => $business_id,
      'owner_id' => $Business->user_id,
      'type' => $type,
      'amount' => $transferAmount,
      'representation' => $percent,
      'stripe_charge_id' => $charge->id
    ]);

// Milestone Fulfill check
    $total_bid_amount = 0;
    $mile1 = Milestones::where('listing_id',$business_id)
    ->where('status','In Progress')->first();
    $this_bids = BusinessBids::where('business_id',$business_id)->get();
    foreach($this_bids as $b)
    $total_bid_amount = $total_bid_amount+($b->amount);

    if($total_bid_amount >= $mile1->amount){
        $list = listing::where('id',$business_id)->first();
        $owner = User::where('id',$list->user_id)->first();
        $info=[ 'business_name'=>$list->name ];
        $user['to'] = $owner->email; //'tottenham266@gmail.com'; //
         Mail::send('bids.mile_fulfill', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Fulfills a milestone!');
         });
     }
// Milestone Fulfill check

}

catch(\Exception $e){
  Session::put('Stripe_failed',$e->getMessage());
    return redirect()->back();
}

if($bids){
    Session::put('Stripe_pay','Bid placed! you will get a notification if your bid is accepted!');
    return redirect("/");
    //return redirect("/#/listingDetails/".$business_id);
         }


}



// Onboarding / Connect to stripe 
 public function connect($id) {
    $seller = User::where('id',$id)->first();
    if(!$seller->completed_onboarding){
        $token = hexdec(uniqid());
        User::where('id',$id)->update(['token'=>$token]);
    }

   if(!$seller->connect_id || !$seller->completed_onboarding){
    try{
    $account = $this->Client->accounts->create([
                'country' => 'us',
                'type' => 'express',
                'settings' => [
                  'payouts' => [
                    'schedule' => [
                      'interval' => 'manual',
                    ],
                  ],
                ],
              ]);
              
$account_id=$account['id']; 
User::where('id',$id)->update(['connect_id'=>$account_id]);

$account_links = $this->Client->accountLinks->create([
              'account' => $account_id,
              'refresh_url' => route('connect.stripe',['id'=>$id]),
              'return_url' => route('return.stripe',['token'=>$token]),
              'type' => 'account_onboarding',
            ]);
    return redirect($account_links->url);

    }
    catch(\Exception $e){
    Session::put('loginFailed', $e->getMessage());
    return redirect()->back();
    }
    }

    
    try{
        $login_link = $this->Client->accounts->createLoginLink($seller->connect_id);
        return redirect($login_link->url);
    }
    catch(\Exception $e){
              Session::put('failed',$e->getMessage());
              DB::table('users')->where('id',$seller->id)
              ->update(['completed_onboarding'=>0]);
              return redirect()->back();
}
    
//echo '<pre>'; print_r($account_links); echo '<pre>';
}


//After return 
public function saveStripe($token) {
    $seller = User::where('token',$token)->first();
    if($seller){
        DB::table('users')->where('id',$seller->id)
        ->update(['completed_onboarding'=>1]);
    }
    return redirect('business/add-listing');
 }
// CONNECT


}
