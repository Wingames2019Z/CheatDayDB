<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\UserFriend;
use DB;

class FriendController extends Controller
{


    public function ShowFriendList(Request $request)
	{
        $user_id = $request->user_id;
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

        $length = count($friend_id);
        $friend_list = array();
        for ($i = 0; $i < $length; $i++) {
            $friend = UserProfile::where('user_friend_id', $friend_id[$i])->select('user_name','user_friend_id','food_num')->get();
            array_push($friend_list,$friend);
        }

        $response = array(
            'friend_list' => $friend_list,
		);
		return json_encode($response);
    }
    public function ShowPendingFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;

        $query = UserFriend::query();
        $pending_list = $query->where('dst','like', '%' .$my_friend_id. '%')->select('src')->get();
        $_query = UserFriend::query();
        $delete_list =  $_query->where('src','like', '%' .$my_friend_id. '%')->select('dst')->get();
        if($pending_list !=null){
            foreach ($pending_list as $k => $value){       
            foreach ($delete_list as $_value){ 
                if($value->src == $_value->dst){
                    unset($pending_list[$k]);
                }
                }
            }
        }

        $response = array(
            'pending_list' => $pending_list,
		);
		return json_encode($response);
    }

    public function SearchFriend(Request $request)
	{
        $search_term = $request->search_term;
        $query = UserProfile::query();
        $searched_user = $query->where(DB::raw('CONCAT(user_name, user_friend_id)'),'like', '%' .$search_term. '%')->select('user_name','user_friend_id','food_num')->get();
        $response = array(
            'user_profile' => $searched_user,
		);
		return json_encode($response);
    }

    public function RequestFriend(Request $request)
	{ 
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();

        $my_friend_id = $user_profile->user_friend_id;
        $request_friend_id = $request->request_friend_id;

        $sent = false;
        $query = UserFriend::query();
        $sent_list =$query->where('src','like', '%' .$my_friend_id. '%')->select('dst')->get();

        if($sent_list !=null){
            foreach ($sent_list as $value){       
                if($value->dst == $request_friend_id){
                    $sent = true;
                }
            }
        }

        $response = "";
        if($sent){
            $response = "false";

        }else{
            $user_friend = new UserFriend;
            $user_friend->src = $my_friend_id;
            $user_friend->dst = $request_friend_id;
            try {
                $user_friend->save();
                \DB::commit();
            } catch (\PDOException $e) {
                \DB::rollback();
                logger($e->getMessage());
                return config('error.ERROR_DB_UPDATE');
            }

            $response = "true";
        }
        
        return json_encode($response);
    }

    public function DenyFriend(Request $request)
	{

    }

    public function DeleteFriend(Request $request)
	{

    }
}
