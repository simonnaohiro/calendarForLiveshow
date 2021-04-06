<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\UserProfile;
use Validator;

class UserEditController extends Controller
{
    public function show_profile($user_id)
    {
        $profile = UserProfile::getUser($user_id)->first();
        $posted_events = Event::eventList($user_id, 10)->get();

        return view('users.profile', compact('profile' ,'posted_events'));
    }

    public function show_edit_profile(Request $request)
    {   
        // user_idを取得
        $user = Auth::user();
        // user_idでユーザーのプロフィールを検索
        $profile = UserProfile::getUser($user->id)->first();
        // ユーザープロフィールがない場合
        if(!blank($profile)){
            $edit_or_create = '編集';
            $user_name = null;
        }else{
            $edit_or_create = '作成';
            $user_name = $user->name;
        }

        return view('form.userProfileEdit', compact('profile', 'user_name', 'edit_or_create'));
    }

    public function register_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_icon' => 'nullable|image',
            'user_name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
        ]);
            

        if ($validator->fails()) {
            return redirect(route('edit_profile'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $event = [
            'user_name' => $request->user_name,
            'introduction' => $request->introduction,
            'image_icon' => $request->image_icon,
        ];

        return redirect(route('preview_profile'))->withInput($event);
    }

    public function preview_profile(Request $request)
    {
        $profile = $request->old();

        $user_name = Auth::user()->name;
        return view('users.preview', compact('profile', 'user_name'));
    }

    public function save_profile(Request $request)
    {   
        $user_id = Auth::user()->id;
        $user_profile = UserProfile::getUser($user_id)->first();
        $user = User::find($user_id);
        
        // DBにプロフィールカラムが存在しない場合（新たに作成）
        if($user_profile == null){
            $new_user_profile = new UserProfile;

            $user->name = $request->user_name;
            $user->save();

            $new_user_profile->fill([
                'user_id' => $user_id,
                'image_icon' => $request->image_icon,
                'introduction' => $request->introduction,])->save();

            return redirect(route('show_profile', compact('user_id')));
        }

        // 存在していた場合（更新）
        $user->name = $request->user_name;

        $user->save();
        
        $user_profile->fill([
            'image_icon' => $request->image_icon,
            'introduction' => $request->introduction,])->save();

        return redirect(route('show_profile', compact('user_id')));
    }
}
