<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use DB;

class GiftController extends Controller
{
    public function GiftCheck(Request $request)
	{
		//DBからデータ取得
		$user_id = $request->user_id;
		$user_profile = UserProfile::where('user_id', $user_id)->first();
        $return_user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_profile->user_name = $user_name;
		$user_profile->food_num = $food_num;

        //gift 確認
        $gift_check = false;
        if($user_profile->gift_diamonds > 0){
            $user_profile->gift_diamonds = 0;
            $gift_check = true;
        }

        if($gift_check){
            //データの書き込み 
            try {
                $user_profile->save();
                \DB::commit();
            } catch (\PDOException $e) {
                \DB::rollback();
                logger($e->getMessage());
                return config('error.ERROR_DB_UPDATE');
            }
            $user_profile = $return_user_profile;
        }
		$response = array(
			'user_profile' => $user_profile,
		);    
        return json_encode($response);
    }
}
