<?php

namespace Modules\PaddlebillingSubscribe\Http\Controllers;

use App\Models\Plans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class Main extends Controller
{
    public function webhook(Request $request)
    {

         //Email - find the user
         //dd($request->data['payments'][0]['status']);
         $email = $request->data['custom_data']['email'];
         $user = User::where('email', $email)->firstOrFail();
 
         //subscription_id -- Find the plan
         $subscription_plan_id = $request->data['items'][0]['price']['id'];
         $plan = Plans::where('paddle_id', $subscription_plan_id)->firstOrFail();

        
        //Status is to decide what to do
        $status = $request->data['payments'][0]['status'];

        if ($status == 'active' || $status == 'trialing' || $status == 'captured') {
            //Assign the user this plan
            $user->plan_id = $plan->id;
            $user->plan_status = $status;
           
            //Todo - Add the cancel and update url

            $user->subscription_plan_id = $subscription_plan_id;
            $user->update();
            return response()->json([
                'status' => true,
                'msg' => 'Plan activated',
            ]);
        }

        if ($status == 'deleted') {
            //Remove assigned plan to user
            $user->plan_id = null;
            $user->plan_status = '';
            $user->cancel_url = '';
            $user->update_url = '';
            $user->subscription_plan_id = null;
            $user->update();
            return response()->json([
                'status' => true,
                'msg' => 'Plan removed',
            ]);
        }


    }
}
