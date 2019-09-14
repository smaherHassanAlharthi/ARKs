<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAlertsRequest;
use App\Http\Requests\Admin\UpdateAlertsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;


class AlertsController extends Controller
{
    public function index()
    {

            $alerts = Alert::all();


            return response()->json($alerts);
        }
    /**
     * Store a newly created Alert in storage.
     *
     * @param  \App\Http\Requests\StoreAlertsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $false="false";
        $score=$request->score;
        if($score>=0.80){
            $alert = Alert::create($request->all());
            $basic  = new \Nexmo\Client\Credentials\Basic('dd1593ca', 'dJwLLRknxC9Z3dzZ');
            $client = new \Nexmo\Client($basic);
            
            $message = $client->message()->send([
                                                'to' => '966556060813',
                                                'from' => 'Nexmo',
                                                'text' => 'There is water leak'
                                                ]);
            
            return response()->json($alert);
           
        }else
            return response()->json($false);
        
        
        return response()->json($false);
    }
/*

         $basic  = new \Nexmo\Client\Credentials\Basic('dd1593ca', 'dJwLLRknxC9Z3dzZ');
         $client = new \Nexmo\Client($basic);

         $message = $client->message()->send([
             'to' => '966556060813',
             'from' => 'Nexmo',
             'text' => 'Hello from Nexmo'
         ]);

*/
}
