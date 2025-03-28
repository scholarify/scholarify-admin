<?php

use App\Models\School;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');
Route::get('/', function () {
    return redirect('/admin');
})->name('home');
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
    // return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/test-session', function () {
    try {
        // $users = DB::connection('mongodb')->table('users')->get();
        // return response()->json($users);
        Session::put('test_key', 'test_value');
        return Session::get('test_key');
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
