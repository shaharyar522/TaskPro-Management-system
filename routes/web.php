    <?php

    use App\Http\Controllers\ApproveUsers;
    use App\Http\Controllers\PendingController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserCCIController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\UserFrontierController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use Spatie\Permission\Traits\hasRole;
    use App\Exports\UserFrontierExport;
    use App\Exports\UserCCIExport;
    use Maatwebsite\Excel\Facades\Excel;


    Route::get('/', function () {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('user')) {
                if ($user->project_name === 'Frontier') {
                    return redirect()->route('user.dashboardFrontier');
                } elseif ($user->project_name === 'CCI') {
                    return redirect()->route('user.dashboardCCI');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('warning', 'Invalid project selected.');
                }
            }
        }
        return view('auth.login');
    });


    Route::get('/test-global-var', function () {
        return "This is a global variable";  // ✅ Should return "This is a global variable"
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


        // ✅ FIXED: This route now uses the controller, which passes $userCCI to the view
        Route::get('/dashboard', [UserFrontierController::class, 'index'])->name('user.dashboardFrontier');
        Route::post('/users-data/store', [UserFrontierController::class, 'store'])->name('userfrontier.store');
        Route::get('/dashboard/edit/{id}', [UserFrontierController::class, 'edit'])->name('userfrontier.edit');
        Route::put('/Users/update/{id}', [UserFrontierController::class, 'update'])->name('userfrontier.update');
        Route::delete('/user/userdata/delete/{id}', [UserFrontierController::class, 'destroy'])->name('userfrontier.destroy');


        // Routes for UserCCIController
        Route::get('/dashboard-cci', [UserCCIController::class, 'index'])->name('user.dashboardCCI');
        Route::post('dashboard/cci', [UserCCIController::class, 'store'])->name('usercci.store');
        Route::get('dashboard/cci/edit/{id}', [UserCCIController::class, 'edit'])->name('usercci.edit');
        Route::put('update/{id}', [UserCCIController::class, 'update'])->name('usercci.update');
        Route::delete('user/dashboard/delete/{id}', [UserCCIController::class, 'destroy'])->name('usercci.destroy');

        /// for dowanload  user frontire excle and SCV file
        //Excel frontire
        Route::get('/export/frontier-excel', function () {
            return Excel::download(new UserFrontierExport, 'user_data.xlsx');
        })->name('userfrontier.export.excel');
        //CSV frontire
        Route::get('/export/frontier-csv', function () {
            return Excel::download(new UserFrontierExport, 'user_data.csv', \Maatwebsite\Excel\Excel::CSV);
        })->name('userfrontier.export.csv');
        //PDF frontire
        Route::get('/user-frontier/download-pdf', [UserFrontierController::class, 'exportPDF'])->name('userfrontier.export.pdf');



        /// for dowanload user CCI  excle and SCV file
        //Excel CCI
        Route::get('/export/cci-excel', function () {
            return Excel::download(new UserCCIExport, 'user_data.xlsx');
        })->name('usercci.export.excel');
        //CSV CCI
        Route::get('/export/cci-csv', function () {
            return Excel::download(new UserCCIExport, 'user_data.csv', \Maatwebsite\Excel\Excel::CSV);
        })->name('usercci.export.csv');
        //PDF CCI
        Route::get('/user-cci/download-pdf', [UserCCIController::class, 'exportPDF'])->name('usercci.export.pdf');
    });


    //->middleware(['auth', 'verified'])
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__ . '/auth.php';
