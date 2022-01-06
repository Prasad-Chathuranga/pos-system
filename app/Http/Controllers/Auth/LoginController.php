<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\HasPermissionsTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    use HasPermissionsTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // $user = User::where('email', $input['email'])->get();
        // dd($user->hasPermissionTo('create-tasks'));

        $user_email = DB::table("users")->where('email',$input['email'])->first();
        // var_dump($user_email); exit();

        if($user_email != NULL){
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
        $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else if ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->route('login')->withErrors(['errors'=>'Email and Passwords are Wrong !']);
        }
    }else{
        return redirect()->route('login')->withErrors(['errors'=> 'Email not Found !']);
    }
    }
}
