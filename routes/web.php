<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EngagementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StudentToolsController;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'))
    ->name('home');


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('throttle:5,1');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:8,1');

    // Password reset
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.update');

});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Exams
Route::get('/exams', [ExamController::class, 'index'])
    ->name('exams.index');

Route::get('/exams/{exam:slug}', [ExamController::class, 'show'])
    ->name('exams.show');

// Public user profile
Route::get('/u/{username}', [ProfileController::class, 'show'])
    ->name('profile.public');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Study planner, goals, progress log, exam watchlist and community safety reports
    Route::get('/tools', [StudentToolsController::class, 'index'])->name('tools.index');
    Route::post('/tools/goals', [StudentToolsController::class, 'storeGoal'])->name('tools.goals.store');
    Route::patch('/tools/goals/{goal}', [StudentToolsController::class, 'updateGoal'])->name('tools.goals.update');
    Route::delete('/tools/goals/{goal}', [StudentToolsController::class, 'destroyGoal'])->name('tools.goals.destroy');
    Route::post('/tools/sessions', [StudentToolsController::class, 'storeSession'])->name('tools.sessions.store');
    Route::post('/tools/polls', [StudentToolsController::class, 'storePoll'])->middleware('throttle:5,1')->name('tools.polls.store');
    Route::post('/tools/polls/{poll}/vote', [StudentToolsController::class, 'votePoll'])->middleware('throttle:20,1')->name('tools.polls.vote');
    Route::delete('/tools/sessions/{session}', [StudentToolsController::class, 'destroySession'])->name('tools.sessions.destroy');
    Route::post('/exams/{exam}/follow', [StudentToolsController::class, 'followExam'])->name('exams.follow');
    Route::delete('/exams/{exam}/follow', [StudentToolsController::class, 'unfollowExam'])->name('exams.unfollow');
    Route::post('/experiences/{experience}/report', [StudentToolsController::class, 'reportExperience'])->middleware('throttle:10,1')->name('experiences.report');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'password'])
        ->name('profile.password');

    Route::post('/profile/check-in', [ProfileController::class, 'activity'])
        ->name('profile.activity');


    // Discover active candidates to follow
    Route::get('/people', [SocialController::class, 'people'])
        ->name('people.index');


    /*
    |--------------------------------------------------------------------------
    | Follow / Unfollow / Follow Back
    |--------------------------------------------------------------------------
    */

    Route::post('/users/{user}/follow', [SocialController::class, 'follow'])
        ->middleware('throttle:30,1')
        ->name('users.follow');

    Route::delete('/users/{user}/follow', [SocialController::class, 'unfollow'])
        ->middleware('throttle:30,1')
        ->name('users.unfollow');

    // Followers / Following list
    Route::get('/my-followers/{type}', [SocialController::class, 'list'])
        ->name('social.list');


    /*
    |--------------------------------------------------------------------------
    | Direct Messages / Inbox
    |--------------------------------------------------------------------------
    */

    Route::get('/messages', [SocialController::class, 'inbox'])
        ->name('messages.index');

    Route::get('/messages/{user:username}', [SocialController::class, 'conversation'])
        ->name('messages.show');

    Route::post('/messages/{user:username}', [SocialController::class, 'send'])
        ->middleware('throttle:30,1')
        ->name('messages.send');

        


    /*
    |--------------------------------------------------------------------------
    | Community
    |--------------------------------------------------------------------------
    */

    // Community listing
    Route::get('/community', [CommunityController::class, 'index'])
        ->name('community.index');

    // Community chat page
    Route::get('/community/{community}/chat', [CommunityController::class, 'chat'])
        ->name('community.chat');

    // Join community
    Route::post('/community/{community}/join', [CommunityController::class, 'join'])
        ->middleware('throttle:20,1')
        ->name('community.join');

    // Leave community
    Route::delete('/community/{community}/leave', [CommunityController::class, 'leave'])
        ->name('community.leave');

    // Fetch community messages
    Route::get('/community/{community}/messages', [CommunityController::class, 'messages'])
        ->name('community.messages');

    // Send community message
    Route::post('/community/{community}/messages', [CommunityController::class, 'sendMessage'])
        ->middleware('throttle:30,1')
        ->name('community.messages.send');


    /*
    |--------------------------------------------------------------------------
    | Experience Management
    |--------------------------------------------------------------------------
    */

    // Keep create route before dynamic experience routes
    Route::get('/experiences/create', [ExperienceController::class, 'create'])
        ->name('experiences.create');

    Route::post('/experiences', [ExperienceController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('experiences.store');

    Route::get('/experiences/{experience}/edit', [ExperienceController::class, 'edit'])
        ->name('experiences.edit');

    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])
        ->name('experiences.update');

    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])
        ->name('experiences.destroy');


    /*
    |--------------------------------------------------------------------------
    | Likes / Bookmarks / Comments
    |--------------------------------------------------------------------------
    */

    Route::post('/experiences/{experience}/like', [EngagementController::class, 'like'])
        ->middleware('throttle:30,1')
        ->name('experiences.like');

    Route::post('/experiences/{experience}/bookmark', [EngagementController::class, 'bookmark'])
        ->name('experiences.bookmark');

    Route::post('/experiences/{experience}/comments', [EngagementController::class, 'comment'])
        ->middleware('throttle:15,1')
        ->name('experiences.comments.store');

    Route::get('/bookmarks', [EngagementController::class, 'bookmarks'])
        ->name('bookmarks.index');

});

// This wildcard route must be registered after /experiences/create above.
// Otherwise Laravel treats "create" as an experience slug and model binding returns 404.
Route::get('/experiences/{experience:slug}', [ExperienceController::class, 'show'])
    ->name('experiences.show');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'can:manage-content'])
    ->group(function () {

        // Admin dashboard
        Route::get('/', [AdminController::class, 'index'])
            ->name('dashboard');

        // Experience moderation
        Route::post('/experiences/{experience}/moderate', [AdminController::class, 'moderate'])
            ->name('experiences.moderate');

        // User management
        Route::get('/users', [AdminController::class, 'users'])
            ->name('users.index');

        Route::put('/users/{user}', [AdminController::class, 'updateUser'])
            ->name('users.update');

        Route::patch('/users/{user}/toggle', [AdminController::class, 'toggleUser'])
            ->name('users.toggle');

        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])
            ->name('users.delete');

        // Post management
        Route::get('/posts', [AdminController::class, 'posts'])
            ->name('posts.index');

        Route::patch('/posts/{experience}', [AdminController::class, 'updatePost'])
            ->name('posts.update');

        // User-submitted content reports
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports.index');
        Route::patch('/reports/{report}', [AdminController::class, 'updateReport'])->name('reports.update');

        // Website settings
        Route::get('/settings', [AdminController::class, 'settings'])
            ->name('settings');

        Route::put('/settings', [AdminController::class, 'saveSettings'])
            ->name('settings.save');

    });
