<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->merge([
            'user_id' => auth()->user()->id,
        ]);

        $validator = Validator::make($request->all(), [
            'header'  => ['required'],
            'detail'  => ['required'],
            'user_id' => ['required'],
        ], [
            'required' => 'x',
        ]);

        if($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        News::create($validator->getData());

        return redirect(route('index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        if(auth()->user()->id == $news->user->id) {
            return view('news.edit', ['news' => $news]);
        }

        return redirect(route('index'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'header'  => ['required'],
            'detail'  => ['required'],
        ], [
            'required' => 'x',
        ]);

        if($validator->fails() || auth()->user()->id != $news->user->id) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $news->update($validator->getData());

        return redirect(route('index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if(auth()->user()->id == $news->user->id) {
            $news->delete();
        }

        return redirect(route('index'));

    }
}
