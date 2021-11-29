<?php

namespace App\Observers;

use App\Models\News;
use App\Models\NewsAudit;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function created(News $news)
    {
        NewsAudit::create([
           'news_id' => $news->id,
           'user_id' => auth()->user()->id,
           'action'  => 'CREATE',
        ]);
    }

    /**
     * Handle the News "updated" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function updated(News $news)
    {
        NewsAudit::create([
            'news_id' => $news->id,
            'user_id' => auth()->user()->id,
            'action'  => 'UPDATE',
        ]);
    }

    /**
     * Handle the News "deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function deleted(News $news)
    {
        NewsAudit::create([
            'news_id' => $news->id,
            'user_id' => auth()->user()->id,
            'action'  => 'DELETE',
        ]);
    }

    /**
     * Handle the News "restored" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function restored(News $news)
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function forceDeleted(News $news)
    {
        //
    }
}
