<?php

namespace App\Providers;

use App\Models\ItemCategory;
use App\Models\items;
use App\Models\User;
use App\Policies\ItemCategoryPolicy;
use App\Policies\ItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ItemCategory::class => ItemCategoryPolicy::class,
        items::class => ItemPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('delete_item_category', fn(User $user) => $user->role == 1 );

        //
    }
}
