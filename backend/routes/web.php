<?php

Route::get('registration', 'RegistrationController@Registration');

Route::get('update_profile/user_id/{user_id}/user_name/{user_name}/food_num/{food_num}', 'RegistrationController@Update');

Route::get('ranking_get/user_id/{user_id}/tap/{tap}/eat_count/{eat_count}/level/{level}/stage/{stage}/type/{type}/', 'RankingController@RankingGet');

Route::get('friend_ranking_get/user_id/{user_id}/tap/{tap}/eat_count/{eat_count}/level/{level}/stage/{stage}/type/{type}/', 'RankingController@FriendRankingGet');

//Route::get('data_download', 'RegistrationController@DataDownLoad');

Route::get('show_friend/user_id/{user_id}/', 'FriendController@ShowFriendList');

Route::get('show_offer_friend/user_id/{user_id}/', 'FriendController@ShowOfferList');

Route::get('cansel_friend/user_id/{user_id}/cansel_friend_id/{cansel_friend_id}/', 'FriendController@CanselFriend');

Route::get('show_pending_friend/user_id/{user_id}/', 'FriendController@ShowPendingFriend');

Route::get('search_friend/user_id/{user_id}/search_term/{search_term}/', 'FriendController@SearchFriend');

Route::get('request_friend/user_id/{user_id}/request_friend_id/{request_friend_id}/request_type/{request_type}', 'FriendController@RequestFriend');

Route::get('accept_friend', 'FriendController@AcceptFriend');

Route::get('deny_friend/user_id/{user_id}/pending_friend_id/{pending_friend_id}', 'FriendController@DenyFriend');

Route::get('delete_friend/user_id/{user_id}/delete_friend_id/{delete_friend_id}', 'FriendController@DeleteFriend');

//purchase
Route::get('shop/user_id/{user_id}/product_id/{product_id}', 'PurchaseController@Shop');