<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasSheet;
use App\Rules\MatchOldPassword;
use App\Models\Sheet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session([ 'prevURL' => url()->current() ]);

        return view('models.user.index', [
            'users' => User::orderBy('name')->where('id', '!=', 1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.user.create', [
            'categories' => Category::all(),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $genPW = Str::random(8);

        $request->merge([
            'password' => Hash::make($genPW),
            'genPW'    => $genPW,
        ]);

        $validator = Validator::make($request->all(), [
            'firstname'     => ['required'],
            'name'          => ['required'],
            'email'         => ['required', 'unique:users,email'],
            'phone'         => ['nullable', 'regex:/^[0-9]{10}$/', 'unique:users,phone'],
            'roles_id'      => ['required'],
            'categories_id' => ['required'],
        ], [
            'required' => 'x',
        ]);

        if($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create(
            $validator->getData()
        );

        if($request->hasFile('img')) {

            $imageName = hash('md5', $user->id . $user->fullName) . '.' . $request->file('img')->extension();
            request()->img->move(public_path('pb'), $imageName);

            $user->pb = $imageName;
            $user->saveQuietly();
        }

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session([ 'prevURL2' => url()->current() ]);

        return view('models.user.edit', [
            'user'  => User::with('userHasSheets.sheet')->find($id),
            'roles' => Role::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'firstname'     => ['required'],
            'name'          => ['required'],
            'email'         => ['required', 'unique:users,email,' . $user->id],
            'phone'         => ['nullable', 'regex:/^[0-9]{10}$/', 'unique:users,phone,' . $user->id],
            'roles_id'      => ['required'],
            'categories_id' => ['required'],
        ], [
            'required' => 'x',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $user->fill($validator->getData())->save();

        if($request->hasFile('img')) {

            $imageName = hash('md5', $user->id . $user->fullName) . '.' . $request->file('img')->extension();
            request()->img->move(public_path('pb'), $imageName);

            $user->pb = $imageName;
            $user->saveQuietly();
        }

        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
