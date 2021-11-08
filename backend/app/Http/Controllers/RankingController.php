<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use DB;

class RankingController extends Controller
{
    public function RankingGet($user_id, $tap, $eat_count, $level ,$stage ,$type)
    {
        //DBからデータ取得
		$user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_profile->tap = $tap;
        $user_profile->eat_count = $eat_count;
        $user_profile->level = $level;
        $user_profile->stage = $stage;

        //データの書き込み 
        try {
            $user_profile->save();
            \DB::commit();
		} catch (\PDOException $e) {
            \DB::rollback();
			logger($e->getMessage());
			return config('error.ERROR_DB_UPDATE');
		}
        

        switch ($type) {
            case 'tap':
                $ranking = DB::select("SELECT user_id , user_name , tap FROM user_profile order by tap desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'eat_count':
                $ranking = DB::select("SELECT user_id , user_name , eat_count FROM user_profile order by eat_count desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'level':
                $ranking = DB::select("SELECT user_id , user_name , level FROM user_profile order by level desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'stage':
                $ranking = DB::select("SELECT user_id , user_name , stage FROM user_profile order by stage desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;
        
        }


        $response = array(
			'ranking' => $ranking,
		);    
        return json_encode($response);
    }
}
