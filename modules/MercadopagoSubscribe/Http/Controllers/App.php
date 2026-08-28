<?php

namespace Modules\MercadopagoSubscribe\Http\Controllers;

class App
{

    public function validate($user)
    {
        $user->plan_id = null;
        $user->cancel_url = null;
        $user->update_url = null;
        //ss$user->update();
    }
}
