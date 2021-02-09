<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use Validator;

class UserEditController extends Controller
{
    public function show_profile($user_id)
    {   
        $user_name = User::find($user_id)->name;

        $profile = UserProfile::where('user_id', $user_id)->first();

        return view('users.profile', compact('user_name', 'profile'));
    }

    public function show_edit_profile(Request $request)
    {   
        return view('form.userProfileEdit');
    }

    public function register_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_icon' => 'nullable|image',
            'introduction' => 'required|string|max:255',
        ]);
            

        if ($validator->fails()) {
            return redirect(route('edit_profile'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $event = [
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
        $user_profile = UserProfile::where('user_id', $user_id)->first();

        // DBにプロフィールカラムが存在しない場合（新たに作成）
        if($user_profile == null){
            $new_user_profile = new UserProfile;

            $new_user_profile->fill([
                'user_id' => $user_id,
                'image_icon' => $request->image_icon,
                'introduction' => $request->introduction])->save();

            return redirect(route('show_profile', compact('user_id')));
        }

        // 存在していた場合（更新）
        $user_profile->fill([
            'image_icon' => $request->image_icon,
            'introduction' => $request->introduction,
        ])->save();

        return redirect(route('show_profile', compact('user_id')));
    }
}
