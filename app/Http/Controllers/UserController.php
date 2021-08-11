<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Rules\MatchOldPassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        return view('index', [
            'news' => News::all()->sortByDesc('created_at'),
        ]);
    }

    public function profile()
    {
        return view('profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'          => ['required', new MatchOldPassword],
            'password'              => ['required', 'min:5', 'confirmed'],
        ], [
            'same'      => 'Das Neue Passwort und die Passwortwiederholung müssen übereinstimmen.',
            'confirmed' => 'Neues Passwort stimmt nicht überein.',
            'min'       => 'Passwort mind. 5 Zeichen lang.',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return view('profile.index', [
            'user'  => auth()->user(),
            'msg'   => 'Passwort wurde erfolgreich aktualisiert.',
        ]);

    }

}
