<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function processLogin(Request $request )
    {
        $user = User::query()
        ->where('email', $request->get('email'))
        ->firstOrFail();
        if(!Hash::check($request->get('password'), $user->password))
        {
            throw new Exception('Invalid password');
        }
        session()->put('id', $user->id);
        session()->put('name', $user->name);
        session()->put('avatar', $user->avatar);
        session()->put('level', $user->level);
       
        return redirect()->route('user.index');
        // try {
        // } catch (\Throwable $e) {
        //     return redirect()->route('register');
        // }
  
    }


    public function processRegister(Request $request)
    {
        User::query()
            ->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),  // Mã hóa mật khẩu
                'level' => '0' ,
            ]);
        // $fields =$request->validate([
        //     'name' => ['required' , 'max:255'],
        //     'email' => ['required' , 'max:255', 'email','unique:users'],
        //     'password' => ['required' , 'min:3','confimed'],
        //     'level' => 0 ,
        // ]);
        // $user = User::create($fields);
        // return redirect()->route('login');

        // try {
        //     User::query()
        //     ->create([
        //         'name' => $request->get('name'),
        //         'email' => $request->get('email'),
        //         'password' => Hash::make($request->get('password')),  // Mã hóa mật khẩu
        //         'lavel' => 0 ,
        //     ]);
        //     return redirect()->route('login');

        // } catch (\Throwable $e) {
        //     return redirect()->route('register');
        // }

    }

}
