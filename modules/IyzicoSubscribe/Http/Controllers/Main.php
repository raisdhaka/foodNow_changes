<?php

namespace Modules\IyzicoSubscribe\Http\Controllers;
require __DIR__.'/../../../Iyzico/vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Iyzipay\Options;
use Iyzipay\Request\CreatePayWithIyzicoInitializeRequest;
use Iyzipay\Request\Subscription\SubscriptionCreateCheckoutFormRequest;   
use Iyzipay\Model\PayWithIyzicoInitialize;


class Main extends Controller
{
    public function showUserForm()
    {
        return view('iyzico-subscribe::userform',['user'=>auth()->user()]);
    }

    public function pay(Request $form_request)
    {
        Log::info('iyzico subscribe pay');
        Log::info($form_request);
        
        $options = new Options();
        $options->setApiKey(config('iyzico.api_key',''));
        $options->setSecretKey(config('iyzico.api_secret',''));
        if(config('iyzico.mode')=="sandbox"){
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        }else{
            $options->setBaseUrl("https://api.iyzipay.com");
        }

       

        $request = new SubscriptionCreateCheckoutFormRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId(auth()->user()->id);
        $request->setPricingPlanReferenceCode($form_request->plan_id);


        $request->setSubscriptionInitialStatus("ACTIVE");
        $request->setCallbackUrl(config('app.url').'/iyzicosubscribe/callback');

        //Create customer - data is in the $form_request
        $customer = new \Iyzipay\Model\Customer();
        $customer->setName($form_request->name);
        $customer->setSurname($form_request->surname);
        $customer->setGsmNumber($form_request->idnumber);
        $customer->setEmail($form_request->email);
        $customer->setIdentityNumber($form_request->idnumber);

        $customer->setShippingContactName($form_request->name." ".$form_request->surname);
        $customer->setShippingCity($form_request->city);
        $customer->setShippingCountry($form_request->country);
        $customer->setShippingAddress($form_request->address);
        $customer->setShippingZipCode($form_request->zipcode);


        $customer->setBillingContactName($form_request->name." ".$form_request->surname);
        $customer->setBillingCity($form_request->city);
        $customer->setBillingCountry($form_request->country);
        $customer->setBillingAddress($form_request->address);
        $customer->setBillingZipCode($form_request->zipcode);


        $request->setCustomer($customer);

        $result = \Iyzipay\Model\Subscription\SubscriptionCreateCheckoutForm::create($request,$options);

        Log::info('iyzico subscribe pay result');
        try {
            Log::info($result);
        } catch (\Throwable $th) {
            Log::info('iyzico subscribe pay result - was not able to log the result');
        }
       

        if($result->getStatus()!="success"){
            return redirect()->back()->with('error',$result->getErrorMessage());
        }

        return view('iyzico-subscribe::pay',['form'=>$result->getCheckoutFormContent()]);
    }

    public function callback(Request $request)
    {

        Log::info('iyzico subscribe callback');
        Log::info($request);

        //Update the user subscription status
        $user=auth()->user;
        $user->plan_id = $request->plan_id;
        $user->subscription_status='active';
        $user->update();

        return view('iyzico-subscribe::callback');
    }

}
