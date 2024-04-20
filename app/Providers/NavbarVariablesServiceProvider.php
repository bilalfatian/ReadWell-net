<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\User;

class NavbarVariablesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('default._navbar', function ($view) {
            $user = \Auth::user();

            if ($user && $user->user_role == "admin") {
                $view->with([
                    'user' => $user,
                    'books' => \App\Models\Book::all(),
                    'users' => \App\Models\User::all(),
                    'searchResults' => \App\Models\Book::all()->concat(\App\Models\User::all())->sortBy('name'),
                ]);
            } else {
                $books = \App\Models\Book::where('approved', 1)
                    ->where('hidden', 1)
                    ->get();
                $users = \App\Models\User::where('user_role', '!=', 'admin')
                    ->whereHas('books', function ($query) {
                        $query->where('approved', 1)
                            ->where('hidden', 1);
                    })
                     ->where('id', '!=', $user->id)
                     ->get();
                $view->with([
                    'user' => $user,
                    'books' => $books,
                    'users' => $users,
                    'searchResults' => $books->concat($users)->sortBy('name'),
                ]);
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
