<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PlayerData;
use App\Models\SkillStatus;
use App\Models\UserProfile;
use App\Models\UserFriend;
use App\Models\UserFriendRequest;
use App\Models\FoodPurchaseCoin;
use DB;

class RegistrationController extends Controller
{
    public function Registration(Request $request)
	{
        //ユーザーIDの決定
		$user_id = uniqid(); //例:4b3403665fea6
		//初期データの設定　user_profile
		$user_profile = new UserProfile;
		$user_profile->user_id = $user_id;
		do{
			$user_friend_id = random();
			$isExist = UserProfile::where('user_friend_id',$user_friend_id)->first();
		}while ($isExist);
		$user_profile->user_name = $request->user_name;
		$user_profile->user_friend_id = $user_friend_id;
		$user_profile->tap = config('constants.NULL_COUNT_DEFAULT');
        $user_profile->eat_count = config('constants.NULL_COUNT_DEFAULT');
        $user_profile->level = config('constants.ONE_COUNT_DEFAULT');
		$user_profile->stage = config('constants.ONE_COUNT_DEFAULT');
        //データの書き込み 
		try {
			$user_profile->save();
			\DB::commit();
		} catch (\PDOException $e) {
			\DB::rollback();
			logger($e->getMessage());
			return config('error.ERROR_DB_UPDATE');
		}
        //クライアントへのレスポンス
		$user_profile = UserProfile::where('user_id', $user_id)->first();    
        $response = array(
            'user_profile' => $user_profile,
		);
		return json_encode($response);
    }

    public function Update(Request $request)
	{
		//DBからデータ取得
		$user_id = $request->user_id;
		$user_name = $request->user_name;
		$food_num = $request->food_num;

		$user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_profile->user_name = $user_name;
		$user_profile->food_num = $food_num;

        //データの書き込み 
        try {
            $user_profile->save();
            \DB::commit();
		} catch (\PDOException $e) {
            \DB::rollback();
			logger($e->getMessage());
			return config('error.ERROR_DB_UPDATE');
		}

		$response = array(
			'user_profile' => $user_profile,
		);    
        return json_encode($response);
    }

    public function DataDownLoad(Request $request)
	{

		$table_name = $request->table_name;
        //クライアントへのレスポンス

		switch ($table_name) {
			case 'player_data':
				$player_data =PlayerData::all();
				$response = array(
					'player_data' => $player_data,
				);
		        return json_encode($response);
				break;

			case 'food_purchase_coin':
				$food_purchase_coin = FoodPurchaseCoin::all();
				$response = array(
					'food_purchase_coin' => $food_purchase_coin,
				);
		        return json_encode($response);
				break;

			case 'skill_status':
				$skill_status = SkillStatus::all();
				$response = array(
					'skill_status' => $skill_status,
				);
		        return json_encode($response);
				break;

			default:
			$response = array(
				'player_data' => $player_data,
				'food_purchase_coin' => $food_purchase_coin,
				'skill_status' => $skill_status,
			);
			return json_encode($response);
		}


        // $response = array(
		// 	'player_needed_coin' => $player_needed_coin,
		// 	'player_tap_damage' => $player_tap_damage,
		// 	'food_purchase_coin' => $food_purchase_coin,
		// 	'skill_status' => $skill_status,
		// );
		// return json_encode($response);
    }


}

function random($length = 7)
{
	return base_convert(mt_rand(pow(36, $length - 1), pow(36, $length) - 1), 10, 36);
}
