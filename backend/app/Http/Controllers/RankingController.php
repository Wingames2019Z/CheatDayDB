<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\UserFriend;
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
                $ranking = DB::select("SELECT user_id , user_name , title , food_num , tap FROM user_profile order by tap desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'eat_count':
                $ranking = DB::select("SELECT user_id , user_name , title , food_num , eat_count FROM user_profile order by eat_count desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'level':
                $ranking = DB::select("SELECT user_id , user_name , title , food_num , level FROM user_profile order by level desc limit 100");
                foreach ($ranking as $value){       
                        if($value->user_id != $user_id){
                            $value->user_id = NULL;
                        }
                    }
            break;

            case 'stage':
                $ranking = DB::select("SELECT user_id , user_name , title , food_num , stage FROM user_profile order by stage desc limit 100");
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



    public function FriendRankingGet($user_id, $tap, $eat_count, $level ,$stage ,$type)
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
        
        /////////friends data get/////////
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;

        $query = UserFriend::query();
        $pending_list = $query->where('dst','like', '%' .$my_friend_id. '%')->select('src')->get();
        $_query = UserFriend::query();
        $sent_list =  $_query->where('src','like', '%' .$my_friend_id. '%')->select('dst')->get();
        $friend_id = array();

        if($pending_list !=null){
            foreach ($pending_list as $value){     
            foreach ($sent_list as $_value){ 
                if($value->src == $_value->dst){
                    array_push($friend_id, $value->src);
                }
                }
            }
        }
        /////////friends data get/////////

        //add my friend id
        array_push($friend_id, $user_profile->user_friend_id);
        switch ($type) {
            case 'tap':
                //get ranking 
                $friend_ranking = array();
                $ranking = DB::select("SELECT user_id , user_name , user_friend_id , title , food_num , tap FROM user_profile order by tap desc");
                foreach ($ranking as $value){
                    if($value->user_id != $user_id){
                        $value->user_id = NULL;
                    }

                    //search friend
                    $length = count($friend_id);                
                    for ($i = 0; $i < $length; $i++) {
                        if($friend_id[$i] == $value->user_friend_id){
                            $friend=array(
                                'user_id'=>$value->user_id,
                                'user_name'=>$value->user_name,
                                'title'=>$value->title,
                                'food_num'=>$value->food_num,
                                'tap'=>$value->tap,
                            );
                            array_push($friend_ranking, $friend);
                        }
                    }
                }
                //slice if length > max
                 $max = 100;
                 $length_friend_ranking = count($friend_ranking); 
                 if($length_friend_ranking >$max){
                     $friend_ranking = array_slice($friend_ranking, 0, $max);
                    }
            break;

            case 'eat_count':
                //get ranking 
                $friend_ranking = array();
                $ranking = DB::select("SELECT user_id , user_name , user_friend_id , title , food_num , eat_count FROM user_profile order by eat_count desc");
                foreach ($ranking as $value){
                    if($value->user_id != $user_id){
                        $value->user_id = NULL;
                    }

                    //search friend
                    $length = count($friend_id);                
                    for ($i = 0; $i < $length; $i++) {
                        if($friend_id[$i] == $value->user_friend_id){
                            $friend=array(
                                'user_id'=>$value->user_id,
                                'user_name'=>$value->user_name,
                                'title'=>$value->title,
                                'food_num'=>$value->food_num,
                                'eat_count'=>$value->eat_count,
                            );
                            array_push($friend_ranking, $friend);
                        }
                    }
                }
                //slice if length > max
                 $max = 100;
                 $length_friend_ranking = count($friend_ranking); 
                 if($length_friend_ranking >$max){
                     $friend_ranking = array_slice($friend_ranking, 0, $max);
                    }
            break;

            case 'level':
                //get ranking 
                $friend_ranking = array();
                $ranking = DB::select("SELECT user_id , user_name , user_friend_id , title , food_num , level FROM user_profile order by level desc");
                foreach ($ranking as $value){
                    if($value->user_id != $user_id){
                        $value->user_id = NULL;
                    }

                    //search friend
                    $length = count($friend_id);                
                    for ($i = 0; $i < $length; $i++) {
                        if($friend_id[$i] == $value->user_friend_id){
                            $friend=array(
                                'user_id'=>$value->user_id,
                                'user_name'=>$value->user_name,
                                'title'=>$value->title,
                                'food_num'=>$value->food_num,
                                'level'=>$value->level,
                            );
                            array_push($friend_ranking, $friend);
                        }
                    }
                }
                //slice if length > max
                 $max = 100;
                 $length_friend_ranking = count($friend_ranking); 
                 if($length_friend_ranking >$max){
                     $friend_ranking = array_slice($friend_ranking, 0, $max);
                    }
            break;

            case 'stage':
                 //get ranking 
                 $friend_ranking = array();
                 $ranking = DB::select("SELECT user_id , user_name , user_friend_id , title , food_num , stage FROM user_profile order by stage desc");
                 foreach ($ranking as $value){
                     if($value->user_id != $user_id){
                         $value->user_id = NULL;
                     }
 
                     //search friend
                     $length = count($friend_id);                
                     for ($i = 0; $i < $length; $i++) {
                         if($friend_id[$i] == $value->user_friend_id){
                             $friend=array(
                                 'user_id'=>$value->user_id,
                                 'user_name'=>$value->user_name,
                                 'title'=>$value->title,
                                 'food_num'=>$value->food_num,
                                 'stage'=>$value->stage,
                             );
                             array_push($friend_ranking, $friend);
                         }
                     }
                 }
                 //slice if length > max
                  $max = 100;
                  $length_friend_ranking = count($friend_ranking); 
                  if($length_friend_ranking >$max){
                      $friend_ranking = array_slice($friend_ranking, 0, $max);
                     }
            break;
        
        }


        $response = array(
			'ranking' => $friend_ranking,
		);    
        return json_encode($response);
    }
}
