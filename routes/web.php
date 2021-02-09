<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//確認前

Route::get('/verify', function(){
    return view('auth.verify');
});

// 確認後
Route::get('/verified', function(){
    return view('auth.verified');
})->middleware('verified');

// ホーム画面
Route::redirect('/','/home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/{year}/{month}', 'CalendarController@getCalendarDates')->name('calendar');


/**
 * ユーザー登録・ログインのルート
 */

Auth::routes(['verify' => true]);

// ワンタイムパスワードを送る

// 二段階認証ログイン
Route::get('two_factor_auth/login_form', 'TwoFactorAuthController@login_form')->name('login_form');

Route::post('ajax/two_factor_auth/first_auth', 'TwoFactorAuthController@first_auth');
// 入力したワンタイムパスワードを検証してログイン
Route::post('ajax/two_factor_auth/second_auth', 'TwoFactorAuthController@second_auth');

/**
 * イベント投稿のルート
 */

// イベント管理
Route::get('/event/register/{year?}/{month?}/{day?}', 'EventRegisterController@event_form')->name('event_register');

Route::post('/event/register/{year?}/{month?}/{day?}', 'EventRegisterController@register_event');

Route::get('/event/preview/confirm', 'EventRegisterController@preview')->name('preview');

// イベント投稿
Route::post('/event/preview/confirm', 'EventRegisterController@post_event');

// リザルト画面
Route::get('/result', 'EventRegisterController@result')->name('result')->middleware('check.request');
// イベント画面へ遷移
Route::post('/result', 'EventRegisterController@return_page');

/**
 * イベント表示
 */

// イベント表示 
Route::get('/event/event_information/{event_id?}', 'EventController@show_event')->name('event')->middleware('no.event.check', 'event.exist.check');

// イベント一覧
Route::get('/events/list/{year}/{month}/{day}', 'EventController@day_event_list')->name('events_list');

// イベント終了
Route::get('/event/finish/{event_id}/{poster_id}', 'EventController@finish_event')->name('finish_event')->middleware('check.user.logined');

// 論理削除
Route::get('/soft_delete/{event_id}/{poster_id}', 'EventController@soft_delete')->name('soft_delete')->middleware('check.user.logined');

/**
 * イベントユーザーのチケット取り置き（予約）
 */

// イベント表示画面から出演者を押下したときのルート
Route::get('/event/ticket_on_layaway/{event_id}/{performer}', 'EventController@redirect_ticket_on_layaway')->name('redirect_ticket_on_layaway')->middleware('auth');

// 入力したデータをリクエストで渡す
Route::get('/event/layaway_confirmation', 'EventController@layaway_confirmation')->name('layaway_confirmation')->middleware('check.request', 'already.layaway', 'auth');

// 取り置きを確定する
Route::post('/event/layaway_confirmation', 'EventController@save_layaway')->middleware('auth');

/**
 * 投稿者（イベント主催者確認用）
 */

// 出演者リスト
Route::get('/event/performers/{event_id}', 'EventController@performer_list')->name('performers_list');
// 予約（取り置き）リストへ
Route::get('/event/perfomer/layaway_list/{event_id}/{performer}', "EventController@layaway_list")->name('layaway_list');

/**
 * ユーザーページ系
 */
// ユーザーページの表示
Route::get('/user/show/mypage/{user_id}', 'UserEditController@show_profile')->name('show_profile')->middleware('no.user.check', 'auth');
//ユーザーページ編集フォームを表示
Route::get('/user/mypage/edit', 'UserEditController@show_edit_profile')->name('edit_profile')->middleware('auth');
//ユーザーページの登録
Route::post('/user/mypage/edit', 'UserEditController@register_profile')->name('register_profile');
//プレビュー画面
Route::get('/user/mypage/edit/preview', 'UserEditController@preview_profile')->name('preview_profile')->middleware('check.request');

Route::post('/user/mypage/edit/preview', 'UserEditController@save_profile')->name('save_profile');

/**
 *  画像投稿ルート
 */
//画像ファイルをアップロードするボタンを設置するページへのルーティング
Route::get('/upload/image', 'ImageController@input');
//画像ファイルをアップロードする処理のルーティング
Route::post('/upload/image', 'ImageController@upload');
//アップロードした画像ファイルを表示するページのルーティング
Route::get('/output/image', 'ImageController@output');