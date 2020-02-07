<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;
use Illuminate\Http\Request;
class GoogleController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existUser = User::where('email', $googleUser->email)->first();

            if ($existUser) {
                $find=User::find($existUser->id);
                    Auth::login($find,true);
                return redirect()->to('/profile');
            } else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->verified =1;
                $user->password = md5(rand(1, 10000));
                $user->save();
            }
            return redirect()->to('/profile');

        } catch (Exception $e) {
            return 'error';
        }
    }
}
