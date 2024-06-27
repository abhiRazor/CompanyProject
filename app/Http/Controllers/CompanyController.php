<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        
         if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('dashboard')->with('success', 'You are logged in!');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
      

    }

    public function registration()
    {
        return view('registration');
    }

    public function registration_save(Request $request)
    {
           
        $request->validate([
        'name' =>'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' =>'required|min:8',
        ]);
      
        
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
        $user->password = Hash::make($request->password);// Hash the password before saving it to the database
       
        if($request->password_confirmation == $request->password)
       {
        $user->save();
        return back()->with('success','User saved');
       }
       else
       {
        return back()->with('error','User password mismatched');
       }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function dashboard()
    {
       
      $tasks = DB::table('tasks')
    ->select('tasks.id','tasks.title', 'tasks.description', 'tasks.status')
    ->join('users', 'tasks.user_id', '=', 'users.id')
    ->where('users.id', '=', Auth::id())  // Replace 123 with the actual authenticated user's ID
    ->get();
   
        return view('dashboard',compact('tasks'));
    }
}
