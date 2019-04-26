<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Session;

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
    // protected $redirectTo = '/welcome/profile';

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
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
       $value = Session::get('prev_url');

       $baseUrl = url('/');
       //dd($baseUrl);
        //$data = $request->session()->all();
        //dd($data);
        return Socialite::driver('facebook')->redirectUrl($baseUrl . '/' . 'login/facebook/callback')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        //  dd($request->all());

        $value = Session::get('prev_url');
        $data = $request->session()->all();
        //dd($data);
        dd(Session::get('prev_url'));

      
        $userSocial = Socialite::driver('facebook')->stateless()->user();
        //dd($userSocial);

        if ($userSocial) {
            $findUser = User::where('email', $userSocial->email)->first();

            if($findUser) {
                Auth::login($findUser);
                return redirect()->route('home');
            }else{
                $user = New User; 
                $user->firstName = $userSocial->name;
                $user->email = $userSocial->email;
                $user->password = bcrypt(123456);
                $user->email_verified_at = '2019-04-11 17:14:16';

                $user->save();

                
                
                Auth::login($user);
                return redirect()->route('home');

            }
        }else{
            return redirect()->back();
        }
        
    }
}
