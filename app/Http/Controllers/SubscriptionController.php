<?php

namespace App\Http\Controllers;//the original one

use App\Http\Middleware\isamember;
use Illuminate\Http\Request;
use App\Http\Middleware\isEmployer;
use App\Mail\PurchaseMail;
use App\Models\User as ModelsUser;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Stmt\TryCatch;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT=20;
    const MONTHLY_AMOUNT=100;
    const YEARLY_AMOUNT=200;
    const CURRENCY='usd';

    public function __construct()
    {
        $this->middleware(['auth',isEmployer::class]);
        $this->middleware(['auth',isamember::class])->except('subscribe');
    }
    public function subscribe(){
        return view('subscription.index');
    }

    public function initiatepayment(Request $request){
         
        $plans=[
             'weekly'=>[
                'name'=>'weekly',
                'description'=>'weekly payiment',
                'amount'=>self::WEEKLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity'=>1,
             ],
             'monthly'=>[
                'name'=>'monthly',
                'description'=>'monthly payiment',
                'amount'=>self::MONTHLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity'=>1,
             ],
             'yearly'=>[
                'name'=>'yearly',
                'description'=>'yearly payiment',
                'amount'=>self::YEARLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity'=>1,
             ],


             ];

        //initiate payment
        
        Stripe::setApiKey(config('services.stripe.secret'));

        try{
           $selectplan=null;

           if($request->is('pay/weekly')){
              $selectplan=$plans['weekly'];
              $billingEnds=now()->addWeek()->startOfDay()->toDateString();
           }
           elseif($request->is('pay/monthly')){
              $selectplan=$plans['monthly'];
              $billingEnds=now()->addMonth()->startOfDay()->toDateString();
           }
           elseif ($request->is('pay/yearly')) {
              $selectplan=$plans['yearly'];
              $billingEnds=now()->addYear()->startOfDay()->toDateString();
           }

           if($selectplan){
           
            $successURl=URL::signedRoute('payment.success',[
                'plan'=>$selectplan['name'],
                'billing_ends'=>$billingEnds
            ]);
           
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => $selectplan['currency'],    //i add some edit to this part from chat gpt;
                        'product_data' => [
                            'name' => $selectplan['name'],
                            'description' => $selectplan['description'],
                        ],
                        'unit_amount' => $selectplan['amount'] * 100,
                    ],
                    'quantity' => $selectplan['quantity'],
                ]],
                'mode' => 'payment',
                'success_url' => $successURl,
                'cancel_url' => route('payment.cancel'),
            ]);
            
            return redirect($session->url);
           }
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function paymentsuccess(Request $request){
        $plan=$request->plan;
        $billingEnds=$request->billing_ends;
        ModelsUser::where('id',auth()->user()->id)->update([
            'plan'=>$plan,
            'billing_ends'=>$billingEnds,
            'status'=>'paid'

        ]);

        try {
            Mail::to(auth()->user())->queue(new PurchaseMail($plan,$billingEnds));
        } catch (\Exception $e) {
            return response()->json($e);
        }
        

        return redirect()->route('dashboard')->with('success','paid successfully');
    }
    public function cancel(){
        
        return redirect()->route('dashboard')->with('error','payment was unsuccessfull');
    }
}
