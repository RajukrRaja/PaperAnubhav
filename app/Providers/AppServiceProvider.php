<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider { public function register(): void {} public function boot(): void { \Illuminate\Support\Facades\Gate::define('manage-content', fn($user) => in_array($user->role, ['admin', 'moderator'], true)); } }
