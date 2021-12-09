<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\UserFriend;
use DB;

class FriendController extends Controller
{

    
    public function ShowOfferList(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;

        $query = UserFriend::query();
        $sent_list =  $query->where('src','like', '%' .$my_friend_id. '%')->select('dst')->get();
        $friend_id = array();
        
        foreach ($sent_list as $value){
            array_push($friend_id, $value->dst);
        }

        $length = count($friend_id);
        $friend_list = array();    
        for ($i = 0; $i < $length; $i++) {
            $condition = ConditionCheck($my_friend_id,$friend_id[$i]);
            if($condition == 1){
                $friend = UserProfile::where('user_friend_id', $friend_id[$i])->select('user_name','user_friend_id','food_num')->first();
                array_push($friend_list,$friend);
            }

        }

        foreach ($friend_list as $k => $value){
            $friend_list[$k]=array(
                'user_name'=>$value->user_name,
                'user_friend_id'=>$value->user_friend_id,
                'food_num'=>$value->food_num,
                'condition'=>$condition
            );      
        }
        $response = array(
            'friends' => $friend_list,
		);
		return json_encode($response);
    }


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
            $friend = UserProfile::where('user_friend_id', $friend_id[$i])->select('user_name','user_friend_id','food_num')->first();
            array_push($friend_list,$friend);
        }
        foreach ($friend_list as $k => $value){         
            $friend_list[$k]=array(
                'user_name'=>$value->user_name,
                'user_friend_id'=>$value->user_friend_id,
                'food_num'=>$value->food_num,
                'condition'=>ConditionCheck($my_friend_id,$value->user_friend_id)
            );
        }
        $response = array(
            'friends' => $friend_list,
		);
		return json_encode($response);
    }


    public function ShowPendingFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;

        //get pending friend
        $query = UserFriend::query();
        $pending_list = $query->where('dst','like', '%' .$my_friend_id. '%')->select('src')->get();

        //get request sent friend
        $_query = UserFriend::query();
        $delete_list =  $_query->where('src','like', '%' .$my_friend_id. '%')->select('dst')->get();

        //get pending friends info
        $length = count($pending_list);
        $friend_list = array();
        for ($i = 0; $i < $length; $i++) {
            //check already friend or not
            $already_friend = false;
            foreach ($delete_list as $_value){ 
                if($pending_list[$i]->src == $_value->dst){
                    $already_friend = true;
                }
            }
            if($already_friend == false){
                $friend = UserProfile::where('user_friend_id', $pending_list[$i]->src)->select('user_name','user_friend_id','food_num')->first();
                array_push($friend_list,$friend);
            }

        }
        //modify friends form
        foreach ($friend_list as $k => $value){
            $friend_list[$k]=array(
                'user_name'=>$value->user_name,
                'user_friend_id'=>$value->user_friend_id,
                'food_num'=>$value->food_num,
                'condition'=>ConditionCheck($my_friend_id,$value->user_friend_id)
            );
        }

        //dd($friend_list);
        $response = array(
            'friends' => $friend_list,
		);
		return json_encode($response);
    }

    public function SearchFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;

        $search_term = $request->search_term;
        $query = UserProfile::query();
        $searched_user = $query->where(DB::raw('CONCAT(user_name, user_friend_id)'),'like', '%' .$search_term. '%')->select('user_name','user_friend_id','food_num')->get();
        
        foreach ($searched_user as $k => $value){      
            $searched_user[$k] = array(
                'user_name'=>$value->user_name,
                'user_friend_id'=>$value->user_friend_id,
                'food_num'=>$value->food_num,
                'condition'=>ConditionCheck($my_friend_id,$value->user_friend_id)
            );
                        if($value->user_friend_id == $my_friend_id){
                unset($searched_user[$k]);
            }
        }
        $response = array(
            'friends' => $searched_user,
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
                if($value->dst == $request_friend_id ||$my_friend_id == $request_friend_id ){
                    $sent = true;
                }
            }
        }

        if($sent == false)
        {
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
        $friends = array(
            'friends' => '',
        );
        return json_encode($friends);
    }

    public function DenyFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;
        $pending_friend_id = $request->pending_friend_id;

        try{
            $query = UserFriend::query();
            $pending_list = $query->where('dst','=', $my_friend_id)
            ->where('src','=', $pending_friend_id)->delete();
            \DB::commit();
        }catch(\PDOException $e) {
            \DB::rollback();
            logger($e->getMessage());
            return config('error.ERROR_DB_UPDATE');
        }

        $friends = array(
            'friends' => '',
        );

        return json_encode($friends);
    }

    public function DeleteFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;
        $delete_friend_id = $request->delete_friend_id;
        
        try{
            $query = UserFriend::query();
            $pending_list = $query->where('src','=', $my_friend_id)
            ->where('dst','=', $delete_friend_id)->delete();

            $_query = UserFriend::query();
            $pending_list = $_query->where('dst','=', $my_friend_id)
            ->where('src','=', $delete_friend_id)->delete();

            \DB::commit();
        }catch(\PDOException $e) {
            \DB::rollback();
            logger($e->getMessage());
            return config('error.ERROR_DB_UPDATE');
        }
        $friends = array(
            'friends' => '',
        );

        return json_encode($friends);
    }

    public function CanselFriend(Request $request)
	{
        $user_id = $request->user_id;
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $my_friend_id = $user_profile->user_friend_id;
        $cansel_friend_id = $request->cansel_friend_id;
        
        try{
            $query = UserFriend::query();
            $pending_list = $query->where('src','=', $my_friend_id)
            ->where('dst','=', $cansel_friend_id)->delete();

            \DB::commit();
        }catch(\PDOException $e) {
            \DB::rollback();
            logger($e->getMessage());
            return config('error.ERROR_DB_UPDATE');
        }
        $friends = array(
            'friends' => '',
        );

        return json_encode($friends);
    }
}
function ConditionCheck($friendA,$friendB){
    //0norequest
    //1request_sent
    //2requested
    //3friends

    $num = -1;
    $query = UserFriend::query();
    $sent_list = $query->where('src','=',$friendA)->select('dst')
    ->where('dst','=', $friendB)->get();
    $sent_list_count = count($sent_list);

    $sent = false;
    if($sent_list_count ==0){
        $sent = false;
    }else{
        $sent = true;
    }
    $_query = UserFriend::query();
    $requested_list = $_query->where('src','=',$friendB)->select('dst')
    ->where('dst','=', $friendA)->get();
    $requested_list_count = count($requested_list);

    $requested = false;
    if($requested_list_count == 0){
        $requested = false;
    }else{
        $requested = true;
    }


    if($sent == false &&  $requested == false){
        $num = 0;
    }elseif($sent == true &&  $requested == false){
        $num = 1;
    }elseif($sent == false &&  $requested == true){
        $num = 2;
    }elseif($sent == true &&  $requested == true){
        $num = 3;
    }

    return $num;
}