<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     public function createAdmin()
//     {
//         return view('register.register-admin');
//     }

//     public function storeAdmin(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'type' => 'admin',
//         ]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect()->route('admin.dashboard');
//     }

//     public function createUser()
//     {
//         return view('register.register-user');
//     }

//     public function storeUser(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'type' => 'user',
//         ]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect()->route('user.dashboard');
//     }
// }

//

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function createAdmin()
    {
        return view('register.register-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin',
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to input brand page
        return redirect()->route('input.brand.page');
    }

    public function inputBrandPage()
    {
        return view('register.input_brand_name');
    }

    public function storeBrand(Request $request)
    {
        $user = Auth::user();
        $user->brand_name = $request->input('brand_name');
        $user->save();

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard');
    }

    public function createUser()
    {
        return view('register.register-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}