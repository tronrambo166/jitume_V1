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


class checkoutController extends Controller
{
    // PAYMENT
     public function goCheckout(Request $request)
    {
      // $id=$request->id;
      // $listing=$request->listing;
      // $value=$request->value;
      // $amount=$request->amount;
      $listing=$request->listing_id;

      $base_price=$request->price;
      $price = round( $base_price+($base_price*0.07),2 );
      //$ids=Crypt::decryptString($ids);
      
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

        //STRIPE
         $curr='USD'; //$request->currency; 
         $price=round($request->price);

        Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');

        Stripe\Charge::create ([ 

                //"billing_address_collection": null,
                "amount" => $price*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose only!"
        ]);
   

//DB INSERT
    Conversation::create([
        'investor_id' => Auth::id(),
        'listing_id' => $listing_id,
        'package' => $package,
        'price' => $price
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



    public function stripePost(Request $request)
    {
    $id = $request->id;
    $listing_id = $request->listing;
    $amount = $request->value;
    $realAmount = $request->realAmount;

    

        //STRIPE
         $curr='USD'; //$request->currency; 
         $price=round($request->price);

        Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');

        Stripe\Charge::create ([ 

                //"billing_address_collection": null,
                "amount" => $price*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose only!"
        ]);
   

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


    //CART

     public function cartCheckout(Request $request)
    {

    $total =0;$cart = Cart::where('user_id',Auth::id())->get();$id='';
    foreach($cart as $c) {
        $total = $total + ($c->price*$c->qty);
        $ids = $id.$c->id.',';

    }
    $total = $total+($total*0.07);
    $total = round(($total/136),2);
 
        return view('cart.stripe',compact('total','ids'));
    }

   
    public function cartStripePost(Request $request)
    {
        $ids = $request->ids; //explode(',',$request->ids);


        //STRIPE
         $curr='USD'; //$request->currency; 
         $amount=round($request->amount);

        Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');

        Stripe\Charge::create ([ 

                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose only!"
        ]);
   

//DB INSERT
  
       
    orders::create([
            'user_id' => Auth::id(),
            'service_id' => str_replace(',','_',$ids),    
            'price' => $amount
           ]);

      $ids = explode(',',$ids);
      foreach ($ids as $id) {
      if($id!=''){
     $cart = Cart::where('id',$id)->delete();

     } }

        $order = orders::latest()->first();
        $info=[ 
            'order_id'=>$order->id
           ]; 

        $user['to'] = 'sohaankane@gmail.com';//$request->email;

        // Mail::send('cart.cart_mail', $info, function($msg) use ($user){
        //     $msg->to($user['to']);
        //     $msg->subject('Test Checkout Alert!');
        // });  


       Session::put('Stripe_pay','Order created successfully!');
       return redirect("/");

    }


    //  MILESTONES

    //CART

     public function milestoneCheckout(Request $request)
    {
    $tax = taxes::where('id',1)->first();
    $tax = $tax->tax+$tax->vat;
    $amount =($request->amount)+($request->amount)*($tax/100);
    $milestone_id =$request->milestone_id;
 
        return view('milestone.stripe',compact('amount','milestone_id','tax'));
    }

   
    public function milestoneStripePost(Request $request)
    {
    $id = $request->milestone_id; //explode(',',$request->ids);

    $mile = Milestones::where('id',$id)->first();    
    $tax = taxes::where('id',1)->first();$tax = $tax->tax+$tax->vat;
    $amount =($mile->amount)+($mile->amount)*($tax/100);

    $user_id = $mile->user_id;


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
        
    Milestones::where('id',$id)->update([ 'status' => 'Done']);
    $mileLat = Milestones::where('user_id',$user_id)->where('status','On Hold')->first();

if(isset($mileLat->id))
    Milestones::where('id',$mileLat->id)->update([ 'status' => 'In Progress']);



       Session::put('Stripe_pay','Milestone paid successfully!');
       return redirect("/");

    }


    //  MILESTONES Services

    //CART

     public function milestoneCheckoutS(Request $request)
    {
    $tax = taxes::where('id',1)->first();
    $tax = $tax->tax+$tax->vat;
    $amount =($request->amount)+($request->amount)*($tax/100);
    $milestone_id =$request->milestone_id;
 
        return view('milestoneS.stripe',compact('amount','milestone_id','tax'));
    }

   
    public function milestoneStripePostS(Request $request)
    {
    $id = $request->milestone_id; //explode(',',$request->ids);

    $mile = Smilestones::where('id',$id)->first();    
    $tax = taxes::where('id',1)->first();$tax = $tax->tax+$tax->vat;
    $amount =($mile->amount)+($mile->amount)*($tax/100);

    $user_id = $mile->user_id;


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
        $business = Services::where('id',$mile->listing_id)->first();

        $info=[  'name'=>$mile->title,  'amount'=>$mile->amount, 'business'=>$business->name, ]; 
        $user['to'] = $request->email;//'sohaankane@gmail.com';

         Mail::send('milestoneS.milestone_mail', $info, function($msg) use ($user){
             $msg->to($user['to']);
             $msg->subject('Milestone Status Changed!');
         });  


//DB INSERT
        
    Smilestones::where('id',$id)->update([ 'status' => 'Done']);
    $mileLat = Smilestones::where('user_id',$user_id)->where('status','On Hold')->first();

if($mileLat != null)
    Smilestones::where('id',$mileLat->id)->update([ 'status' => 'In Progress']);
else {
    //Completed, order place
    try{
        $total = 0;
        $all_milestone = Smilestones::where('listing_id',$mile->listing_id)->get();
        foreach($all_milestone as $all_m){
            $total = $total+$all_m->amount;
        }
        orders::create([
            'user_id' => $mile->user_id,
            'service_id' => $mile->listing_id,
            'price' => $total
        ]);
    }
    catch(\Exception $e){
    Session::put('Stripe_pay', $e->getMessage());
    return redirect("/");
}
}


       Session::put('Stripe_pay','Milestone paid successfully!');
       return redirect("/");

    }


}
