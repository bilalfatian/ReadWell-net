<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
