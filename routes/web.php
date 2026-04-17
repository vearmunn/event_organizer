<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Models\Event;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::resource('events', EventController::class);
// });

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function (Request $request) {
       $query = Event::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->latest()->get();

        $categories = Category::all();

        return view('dashboard', compact('events', 'categories'));

    })->name('dashboard');

    Route::resource('events', EventController::class);
}); 

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::get('/my-events', [EventController::class, 'myEvents'])
    ->middleware('auth')
    ->name('events.my');


Route::post('/events/{event}/join', [RegistrationController::class, 'store'])
    ->middleware('auth')
    ->name('events.join');

Route::delete('/events/{event}/cancel', [RegistrationController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.cancel');

Route::get('/my-registrations', [RegistrationController::class, 'index'])
    ->name('registrations.index');

require __DIR__ . '/auth.php';