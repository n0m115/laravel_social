<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $validate_array = [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4'
        ];

        if (!empty($request['last_name'])) {
            $validate_array['last_name'] = 'required|max:120';
        }
        if (!empty($request['date_of_birth'])) {
            $validate_array['date_of_birth'] = 'required|date';
        }

        $this->validate($request, $validate_array);

        $user = new User();
        $user->email = $request['email'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->date_of_birth = date('Y-m-d H:i:s', strtotime($request['date_of_birth']));
        $user->password = bcrypt($request['password']);

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email_login' => 'required',
            'password_login' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email_login'], 'password' => $request['password_login']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'first_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $old_name = $user->first_name;
        
        $user->first_name = $request['first_name'];
        $user->date_of_birth = date('Y-m-d H:i:s', strtotime($request['date_of_birth']));

        if (!empty($request['last_name'])) {
            $user->last_name = $request['last_name'];
        }

        if (!empty($request['password'])) {
            $user->password = bcrypt($request['password']);
        }

        $user->update();
        $file = $request->file('image');
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';
        // $filename = uniqid() . '_' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}