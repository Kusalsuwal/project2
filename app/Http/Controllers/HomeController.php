<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRequest;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Http\Requests\LoginRequest as RequestsLoginRequest;

class HomeController extends Controller
{
    public function index()
    {
        // You may not need to send emails to all users here, as this could be heavy.
        // If you want to send emails to all users, consider queueing this operation separately.
        $users = User::all(); 
        foreach ($users as $user) {
            SendEmailJob::dispatch($user);
        }
    }

    public function profile()
    {
        $users = User::all();
        return view('Admin.profile', compact('users'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('Admin.edit', compact('data'));
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('profile')->with('success', 'Record deleted successfully.');
    }

    public function restore()
    {
        $deletedData = User::onlyTrashed()->get();
        return view('Admin.restore', compact('deletedData'));
    }

    public function restores($id)
    {
        $deletedData = User::onlyTrashed()->find($id);
        if ($deletedData) {
            $deletedData->restore();
            return redirect()->route('restore');
        } else {
            return redirect()->route('restore');
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $data->title = $request->title;
        $data->body = $request->body;

        if ($request->hasFile('new_image')) {
            if ($data->image) {
                Storage::delete('uploads/students'. $data->image);
            }

            $file = $request->file('new_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/students', $filename);
            $data->image = $filename;
        }

        $data->save();

        return redirect()->route('Dashboard')->with('success', 'Data updated successfully.');
    }

    public function landingpage()
    {
        return view('homepage.landingpage');
    }

    public function Register()
    {
        return view('Account.Register');
    }

    public function Dashboard()
    {
        return view('Account.Dashboard');
    }

    public function login(Request $request)
    {
        return view('Account.login');
    }

    public function Slogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->route('Dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid username or password.');
        }
    }

    public function store(LoginRequest $request)
    {
        $student = new User;
        $student->name = $request->input('name');
        $student->number = $request->input('number');
        $student->address = $request->input('address');
        $student->email = $request->input('email');
        $student->pan = $request->input('pan');
        $student->username = $request->input('username');
        $student->password = Hash::make($request->input('password'));
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/students/', $filename);
            $student->image = $filename;
        }
    
        $student->save();
    
        // Dispatch SendEmailJob after user registration
        dispatch(new SendEmailJob($student));
    
        return redirect()->route('login')->with('success', 'Form submitted successfully!');
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect('/landingpage');
    }

    public function Member()
    {
        $users = User::all();
        return view('Account.Member', compact('users'));
    }

    public function LoginProfile()
    {
        return view('Account.LoginProfile');
    }
}
