<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\User;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
        $pendingCount = User::where('status', 0)->where('blocked', 0)->count();
        $approvedCount = User::where('status', 1)->where('blocked', 0)->count();
        $blockedCount = User::where('blocked', 1)->count();

        $view->with([
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'blockedCount' => $blockedCount,
        ]);
    });
    }
}
