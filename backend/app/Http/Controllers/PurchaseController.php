<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\UserProfile;
use DB;

class PurchaseController extends Controller
{
    //
    public function Shop($user_id, $product_id)
	{
        //初期データの設定　user_profile
        $purchase = new Purchase;

        $purchase->user_id = $user_id;
        $purchase->product_id = $product_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();

        $diamonds = 0;
        switch ($product_id) {
            case "com.cheatday.diamonds180":
                $diamonds = 180;
                break;
            case "com.cheatday.diamonds510":
                $diamonds = 510;
                break;
            case "com.cheatday.diamonds1200":
                $diamonds = 1200;
                break;  
            case "com.cheatday.diamonds3100":
                $diamonds = 3100;
                break; 
            case "com.cheatday.diamonds6500":
                $diamonds = 6500;
                break;
            }
        $user_profile->purchased_diamonds += $diamonds;


        //データの書き込み 
        try {
            $user_profile->save();
            $purchase->save();
            \DB::commit();
        } catch (\PDOException $e) {
            \DB::rollback();
            logger($e->getMessage());
            return config('error.ERROR_DB_UPDATE');
        }

        //クライアントへのレスポンス  
        $response = array(
            'user_profile' => $user_profile,
		);
		return json_encode($response);
        //controller
    }
}
