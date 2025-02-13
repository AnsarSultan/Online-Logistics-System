<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserRegistered;
class AuthController extends Controller
{
    // public function showLogin(){
    //     return view('login');
    // }
    // public function showSignup(){
    //     return view('signup');
    // }

    public function handleAuth(Request $req, $action)
    {
        if ($req->isMethod('get')) {
            return view('auth', ['action' => $action]);
        }

        if ($action === 'login') {
            $credential = $req->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Enter a valid email address.',
                'password.required' => 'Password is required.',
            ]);
            $user = User::where('email', $req->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'This email is not registered.']);
            }

          
            if (Auth::attempt($credential)) {
                        $role = Auth::user()->role;
                
                            if ($role === 'admin') {
                            return redirect()->route('admin.dashboard');
                        } elseif ($role === 'user') {
                            return redirect()->route('home.page');
                        }
                    } else {
                        // Wrong password
                        return back()->withErrors(['password' => 'The password is incorrect.']);
                    }
        } elseif ($action === 'signup') {
            // Handle signup
            $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'address' => 'max:255',
            ], [
                'name.required' => 'Full name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Enter a valid email address.',
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Passwords must match.',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'address' => $validatedData['address'],
            ]);
            if ($user) {
                event(new UserRegistered());
                return redirect()->route('auth', ['action' => 'login']);
            }
        }
    }



    // public function userSignup(Request $req){
    //     $validatedData = $req->validate([
    //        'name' => 'required | string | max:255',
    //        'email' => 'required | email | unique:users,email',
    //        'password' => 'required | confirmed' ,
    //        'address' => 'max:255',
    //     ],[
    //         'name.required' => 'Full name is required.',
    //         'name.max' => 'Too long name.',
    //         'email.required' => 'email is required.',
    //         'email.email' => 'Enter a valid email address.',
    //         'password.required' => 'Password is required.',
    //         'password.confirmed' => 'Confirm password must be matched.'
    //     ]);
    //     $data = user::create([
    //        'name' => $validatedData['name'],
    //        'email' => $validatedData['email'],
    //        'password' => $validatedData['password'],
    //        'address' => $validatedData['address'],
    //     ]);

    //     if($data){
    //         return redirect()->route('login.page');
    //     }

    // }

    // public function useLogin(Request $req){
    //     $credential = $req->validate([
    //         'email' => 'required | email ',
    //         'password' => 'required ' ,
    //      ],[
    //          'email.required' => 'Email is required.',
    //          'email.email' => 'Enter a valid email address.',
    //          'password.required' => 'Password is required.'
    //      ]);
    //      if(Auth::attempt($credential)){
    //         $role = Auth::user()->role;
    //         // dd('we are in the login function');
    //         if ($role === 'admin') {

    //             return redirect()->route('admin.panel');
    //         } elseif ($role === 'user') {
    //             return redirect()->route('home.page'); 
    //         }else{}
    //      }else{
    //         return redirect()->route(route: 'login.page');
    //      }
    // }

    //     public function useLogin(Request $req)
// {
//     // Validate the login request
//     $credential = $req->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ], [
//         'email.required' => 'Email is required.',
//         'email.email' => 'Enter a valid email address.',
//         'password.required' => 'Password is required.',
//     ]);

    //     // Check if the email exists in the database
//     $user = User::where('email', $req->email)->first();
//     if (!$user) {
//         // Email not found
//         return back()->withErrors(['email' => 'This email is not registered.']);
//     }

    //     // Attempt to log in with the provided credentials
//     if (Auth::attempt($credential)) {
//         $role = Auth::user()->role;

    //         if ($role === 'admin') {
//             return redirect()->route('admin.panel');
//         } elseif ($role === 'user') {
//             return redirect()->route('home.page');
//         }
//     } else {
//         // Wrong password
//         return back()->withErrors(['password' => 'The password is incorrect.']);
//     }
// }


    // public function logout(Request $re){
    //     // dd('hello');
    //     Auth::logout();
    //     return redirect()->route('login.page');
    // }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth', ['action' => 'login']);
    }

}
