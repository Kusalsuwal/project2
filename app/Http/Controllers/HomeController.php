<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class HomeController extends Controller
{


    public function index()
    {
        // Retrieve user emails from your database or wherever you store user information
        $users = User::all(); // Assuming you have a User model
    
        // Iterate over each user and send an email
        foreach ($users as $user) {
            Mail::to($user->email)->send(new MailNotify([
                'title' => 'The Title',
                'body' => 'The Body',
                'username' => $user->username, // Assuming you have a username field in your user table
            ]));
        }
    }
    


    public function verifymail()
    {
        return view('Admin.restore', );
    }



    public function profile()
        {
            $users = User::all();
            return view ('Admin.profile',compact('users'));
        }
        public function edit($id)
        {
            $data = User::where('id',$id)->first();
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
        // dd($request->all());
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->password);
        $data->number = $request->number;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->pan = $request->pan;
    
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

        return redirect()->route('profile')->with('success', 'Data updated successfully.');
    }

 
    public function landingpage()
    {
        return view('homepage.landingpage');
    }
    public function Register()
    {
        return view('Account.Register');
    }
    public function Dashboard($username)
    {

        return view('Account.Dashboard', compact('username'));
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
        return redirect()->route('Dashboard',compact('username'));
    } else {
        return redirect()->route('login')->with('error', 'Invalid username or password.');
    }
}


    public function store(StoreRequest $request)
    {
        // dd($request->all());
        $student = new User;
        $student->name = $request->input('name');
        $student->number = $request->input('number');
        $student->address = $request->input('address');
        $student->email = $request->input('email');
        $student->pan = $request->input('pan');
        $student->username = $request->input('username');
        $student->password = Hash::make($request->password);
    
        // Save student image if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/students/', $filename);
            $student->image = $filename;
        }
    
        // Save student record
        $student->save();
        $this->index();
    
    
        return redirect()->route('login')->with('success', 'Form submitted successfully!');

    }
    public function logout()
{
    // Perform logout logic here
    Session::forget('username'); // Assuming you store the username in the session
    return redirect()->route('landingpage');
}
public function Member()
{
    // $data = User::where('id',$id)->first();
    $users = User::all();
    return view('Account.Member', compact('users'));
    // return view('Account.Member', );
}
    

}
