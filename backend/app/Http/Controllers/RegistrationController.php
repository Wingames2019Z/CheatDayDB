<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PlayerData;
use App\Models\SkillStatus;
use App\Models\UserProfile;
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
		$user_profile->user_name = $request->user_name;
		$user_profile->eat_count = config('constants.NULL_COUNT_DEFAULT');
        $user_profile->boss_count = config('constants.NULL_COUNT_DEFAULT');
        $user_profile->prestage = config('constants.NULL_COUNT_DEFAULT');
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



    public function DataDownLoad(Request $request)
	{

		$table_name = $request->table_name;
        //クライアントへのレスポンス
        // $player_needed_coin =PlayerNeededCoin::all();
        // $player_tap_damage = PlayerTapDamage::all();
        // $food_purchase_coin = FoodPurchaseCoin::all();
        // $skill_status = SkillStatus::all();
        

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
