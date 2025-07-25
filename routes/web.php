    <?php

    use App\Exports\AdminUserFrontierExport;
    use App\Exports\AdminUserCCIExport;
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
    use App\Http\Controllers\AdminCCISidebrController;
    use App\Http\Controllers\AdminFrontierSidebrController;
    use App\Http\Controllers\MailController;
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

        // ========================================= start pending sidebar route =========================================
        // user pending k luey route  jin ka staus =0 and blocke= 0

        Route::get('/PendingUser', [UserController::class, 'pendingIndex'])->name('user.pending');
        Route::get('/pending-users/{id}', [UserController::class, 'show']);
        Route::post('/pending-users/{id}/approve', [UserController::class, 'approve']);

        // ========================================= start pending sidebar route =========================================



        // ========================================= start approved sidebar codee =========================================
        // condition  user approved k luey route  jin ka staus =1 and blocke= 0 then show hnga

        Route::get('/ApprovedUser', [UserController::class, 'approvedIndex'])->name('user.approve');
        Route::get('/approved-users', [UserController::class, 'approvedIndex'])->name('approved.users');
        Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');

        // ========================================= end approved sidebar codee =========================================


        // ======================================================== start blocked sidebar route =========================================

        // condition  user blocked k luey route  jin ka staus =1 and blocke= 1 then show hnga
        Route::get('/BlockedUser', [UserController::class, 'blockedIndex'])->name('user.blocked');
        Route::post('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
        Route::put('/users/updateblock/{id}', [UserController::class, 'Blockupdate'])->name('usersblock.update');

        // ======================================================== end blocked sidebar route ========================================================

        // ======================================================== start Side bar frontier  route =========================================

        Route::get('/Frontier/user', [AdminFrontierSidebrController::class, 'index'])->name('user.frontier');
        Route::get('/Frontier/user/{id}', [AdminFrontierSidebrController::class, 'show'])->name('frontier.show');
        Route::get('user/{id}/edit', [AdminFrontierSidebrController::class, 'edit'])->name('admin.frontier.edit');
        Route::put('/Frontier/user/{id}/update', [AdminFrontierSidebrController::class, 'update'])->name('admin.frontier.update');
        Route::delete('/Frontier/user/{id}/destroy', [AdminFrontierSidebrController::class, 'destroy'])->name('admin.frontier.destroy');

        // ======================================================== end frontier sidebar route ========================================================






        // ======================================================== start Side bar CCI sidebar route =========================================

        Route::get('/CCI/user', [AdminCCISidebrController::class, 'index'])->name('user.cci');
        Route::get('/CCI/user/{id}', [AdminCCISidebrController::class, 'show'])->name('cci.show');
        Route::get('CCI/{id}/edit', [AdminCCISidebrController::class, 'edit'])->name('admin.cci.edit');
        Route::put('/CCI/user/{id}/update', [AdminCCISidebrController::class, 'update'])->name('admin.cci.update');
        Route::delete('/CCI/user/{id}/destroy', [AdminCCISidebrController::class, 'destroy'])->name('admin.cci.destroy');

        // ======================================================== end frontier sidebar route ========================================================



        /// ================================start for Admin dowanload  user frontire excle and SCV  and  pdf file  =========================================

        //Excel Frontier
        Route::get('/export/frontier-excel', function () {
            return Excel::download(new \App\Exports\AdminUserFrontierExport, 'frontier_all_users.xlsx');
        })->name('adminfrontier.export.excel');

        //CSV Frontier
        Route::get('/export/frontier-csv', function () {
            return Excel::download(new \App\Exports\AdminUserFrontierExport, 'user_data.csv', \Maatwebsite\Excel\Excel::CSV);
        })->name('adminfrontier.export.csv');

        //PDF frontir

        Route::get('/admin-frontier/download-pdf', [AdminFrontierSidebrController::class, 'exportPDF'])->name('adminfrontier.export.pdf');

        Route::get('/frontier-and-email-admin', [AdminFrontierSidebrController::class, 'exportAndSendExcel'])->name('admin.frontier.export.email');
        Route::get('/cci-and-admin-email', [AdminCCISidebrController::class, 'exportAndSendExcel'])->name('user.cci.export.email');

        /// ================================end for dowanload  user frontire excle and SCV file  =====================================



        /// ================================start for Admin dowanload  user CCI excle and SCV  and  pdf file  =========================================

        //Excel CCI
        Route::get('/export/cci-excel', function () {
            return Excel::download(new \App\Exports\AdminUserCCIExport, 'cci_users.xlsx');
        })->name('admincci.export.excel');

        //CSV CCI

        Route::get('/export/cci-csv', function () {
            return Excel::download(new \App\Exports\AdminUserCCIExport, 'cci_users.csv', \Maatwebsite\Excel\Excel::CSV);
        })->name('admincci.export.csv');
        //PDF frontir

        Route::get('/admin-cci/download-pdf', [AdminCCISidebrController::class, 'exportPDF'])->name('admincci.export.pdf');

        /// ================================end for dowanload  user CCI excle and SCV file  =====================================


    });





    // Group for User only
    Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {

        /// ================================start route Frontier  =========================================
        Route::get('/dashboard', [UserFrontierController::class, 'index'])->name('user.dashboardFrontier');
        Route::post('/users-data/store', [UserFrontierController::class, 'store'])->name('userfrontier.store');
        Route::get('/dashboard/edit/{id}', [UserFrontierController::class, 'edit'])->name('userfrontier.edit');
        Route::put('/Users/update/{id}', [UserFrontierController::class, 'update'])->name('userfrontier.update');
        Route::delete('/user/userdata/delete/{id}', [UserFrontierController::class, 'destroy'])->name('userfrontier.destroy');
        /// ================================start route Frontier  =========================================



        /// ================================start route CCI   =========================================
        Route::get('/dashboard-cci', [UserCCIController::class, 'index'])->name('user.dashboardCCI');
        Route::post('dashboard/cci', [UserCCIController::class, 'store'])->name('usercci.store');
        Route::get('dashboard/cci/edit/{id}', [UserCCIController::class, 'edit'])->name('usercci.edit');
        Route::put('update/{id}', [UserCCIController::class, 'update'])->name('usercci.update');
        Route::delete('user/dashboard/delete/{id}', [UserCCIController::class, 'destroy'])->name('usercci.destroy');
        /// ================================start route CCI  =========================================



        /// ================================start for dowanload  user frontire excle and SCV  and  pdf file  =========================================


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

        /// ================================end for dowanload  user frontire excle and SCV file  =========================================

        


        /// ================================start for dowanload  user CCI excle and SCV file  =========================================
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


        Route::get('/export-and-email', [UserFrontierController::class, 'exportAndSendExcel'])->name('userfrontier.export.email');
        Route::get('/cci-and-email', [UserCCIController::class, 'exportAndSendExcel'])->name('usercci.export.email');
    });
    /// ================================start for dowanload  user CCI excle and SCV file  =========================================




    //->middleware(['auth', 'verified'])
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__ . '/auth.php';
