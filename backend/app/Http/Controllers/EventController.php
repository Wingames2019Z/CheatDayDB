<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use DB;
class EventController extends Controller
{
    public function GetEvents(){
        $events = DB::table('events')->get();

        //クライアントへのレスポンス  
        $response = array(
            'events' => $events,
		);
        
        return json_encode($response);
    }
}
