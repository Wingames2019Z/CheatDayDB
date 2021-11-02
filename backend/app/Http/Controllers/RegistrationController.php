<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FoodPurchaseCoin;
use App\Models\PlayerNeededCoin;
use App\Models\PlayerTapDamage;
use App\Models\SkillStatus;
use App\Models\StageBossFoodHp;
use App\Models\StageCoin;
use App\Models\StageFoodHp;
use App\Models\BossCoin;
use App\Models\UserProfile;
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
        $player_needed_coin =PlayerNeededCoin::all();
        $player_tap_damage = PlayerTapDamage::all();
        $food_purchase_coin = FoodPurchaseCoin::all();
        $skill_status = SkillStatus::all();
        
        $response = array(
			'player_needed_coin' => $player_needed_coin,
			'player_tap_damage' => $player_tap_damage,
			'food_purchase_coin' => $food_purchase_coin,
			'skill_status' => $skill_status,
            'user_profile' => $user_profile,
		);
		return json_encode($response);
    }
}
