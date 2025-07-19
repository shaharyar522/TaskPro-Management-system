    <?php

    use App\Http\Controllers\ApproveUsers;
    use App\Http\Controllers\PendingController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\UserDataController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use Spatie\Permission\Traits\hasRole;

    Route::get('/', function () {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }
        }
        return view('auth.login');
    });



    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard'); // Your admin dashboard view
        })->name('admin.dashboard');

        // user pending k luey route  jin ka staus =0 and blocke= 0
        Route::get('/PendingUser', [UserController::class, 'pendingIndex'])->name('user.pending');
        Route::get('/pending-users/{id}', [UserController::class, 'show']);
        Route::post('/pending-users/{id}/approve', [UserController::class, 'approve']);

        // approved ka leuy route users ka  ji ka status =1 or block =0 hnga 
        Route::get('/ApprovedUser', [UserController::class, 'approvedIndex'])->name('user.approve');
        Route::get('/approved-users', [UserController::class, 'approvedIndex'])->name('approved.users');
        Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');



        //blocked users 
        Route::get('/BlockedUser', [UserController::class, 'blockedIndex'])->name('user.blocked');
        Route::post('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
        Route::put('/users/updateblock/{id}', [UserController::class, 'Blockupdate'])->name('usersblock.update');
    });





    // Group for User only
    Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard'); // Your user dashboard view
        })->name('user.dashboard');

        Route::post('/users-data/store', [UserDataController::class, 'store'])->name('userdata.store');
        Route::get('/dashboard', [UserDataController::class, 'dashboard'])->name('user.dashboard');
        Route::put('/Users/update/{id}',[UserDataController::class, 'update'])->name('userdata.update');
Route::delete('/userdata/delete', [UserDataController::class, 'destroy'])->name('userdata.destroy');






      
        
    });
    //->middleware(['auth', 'verified'])





    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__ . '/auth.php';
