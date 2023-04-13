<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Listing;
use App\Models\Services;
use App\Models\Shop;
use App\Models\Equipments;
use App\Models\User;
use Session; 
use Hash;
use Auth;
use Mail;
use Stripe;

class checkoutController extends Controller
{
    // PAYMENT
     public function goCheckout(Request $request)
    {
      $id=$request->id;
      $listing=$request->listing;
      $value=$request->value;
      $amount=$request->amount;
      $price=$request->price;
      //$ids=Crypt::decryptString($ids);
      
        return view('checkout.stripe',compact('amount','listing','value','id','price'));
    }

   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
    $id = $request->id;
    $listing_id = $request->listing;
    $amount = $request->value;
    $realAmount = $request->realAmount;

    

        //STRIPE
         $curr='USD'; //$request->currency; 
         $amount=round($request->price);

        Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');

        Stripe\Charge::create ([ 

                //"billing_address_collection": null,
                "amount" => $amount*100, //100 * 100,
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

}
