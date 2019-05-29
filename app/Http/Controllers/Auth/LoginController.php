<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param $driver
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param $driver
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        try{
        $oAuthUser = Socialite::driver($driver)->user();
//        dd($oAuthUser );
        }catch (\Exception $e){
            return redirect()->route('login');
        }

        $existingUser =User::where('email', $oAuthUser->getEmail())->first();

//        dd($user);


        if ($existingUser) {
            auth()->login($existingUser, true);
        } else{
//            $user = User::create([
//                'name'=>$oAuthUser->getNickname(),
//                'email'=> $oAuthUser->getEmail(),
//                'provider_id'=> $oAuthUser->getId(),
//            ]);
            $newUser                    = new User;
//            $newUser->{'provider_name'}     = $driver;
            $newUser->{'provider_id'}       = $oAuthUser->getId();
            $newUser->{'name'}              = $oAuthUser->getName() ?? $oAuthUser->getNickname();
            $newUser->{'email'}             = $oAuthUser->getEmail();
            $newUser->{'email_verified_at'} = now();

            $avatar = $oAuthUser->getAvatar();
            if ($avatar) $newUser->{'avatar'}= $avatar;

            $newUser->save();

            auth()->login($newUser, true);
        }

        return redirect($this->redirectTo);
    }
}
