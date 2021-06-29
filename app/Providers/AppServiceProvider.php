<?php

namespace App\Providers;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['conversations.create', 'conversations.index', 'conversations.show'], function ($view) {
            $conversations = auth()->user()->conversations()->orderBy('last_message_at', 'desc')->get();
            $view->with('conversations', $conversations);
        });

        Builder::macro('search', function ($fields, $string, $caseSensitive = true) {
            if ($string) {
                $this->where(function ($query) use ($fields, $string, $caseSensitive) {
                    foreach ($fields as $field) {
                        if (str_contains($field, '.')) {
                            $relationship = strtok($field, '.');
                            $column = strtok('');

                            $query->orWhereHas($relationship, function ($query) use ($column, $string, $caseSensitive) {
                                if ($caseSensitive) {
                                    $query->where($column, 'like', '%'.$string.'%');
                                } else {
                                    $query->whereRaw("upper({$column}) like ?", '%'.Str::of($string)->upper().'%');
                                }
                            });
                        } elseif ($caseSensitive) {
                            $query->orWhere($field, 'like', '%'.Str::of($string)->replace('/', '%/').'%');
                        } else {
                            $query->orWhereRaw("upper({$field}) like ?", '%'.Str::of($string)->replace('/', '%/')->upper().'%');
                        }
                    }
                });
            }

            return $this;
        });
    }
}
