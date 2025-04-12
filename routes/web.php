<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    // Hogares
    Route::resource('homes', HomeController::class);
    
    // Electrodomésticos (anidado en hogares)
    Route::prefix('homes/{home}')->group(function () {
        Route::resource('appliances', ApplianceController::class)
            ->except(['index'])
            ->names([
                'create' => 'homes.appliances.create',
                'store' => 'homes.appliances.store',
                'show' => 'homes.appliances.show',
                'edit' => 'homes.appliances.edit',
                'update' => 'homes.appliances.update',
                'destroy' => 'homes.appliances.destroy',
            ]);
            
        Route::get('appliances', [ApplianceController::class, 'index'])
            ->name('homes.appliances.index');
            
        // Iluminación (anidado en hogares)
        Route::resource('lightings', LightingController::class)
            ->except(['index'])
            ->names([
                'create' => 'homes.lightings.create',
                'store' => 'homes.lightings.store',
                'show' => 'homes.lightings.show',
                'edit' => 'homes.lightings.edit',
                'update' => 'homes.lightings.update',
                'destroy' => 'homes.lightings.destroy',
            ]);
            
        Route::get('lightings', [LightingController::class, 'index'])
            ->name('homes.lightings.index');
            
        // Consumo
        Route::prefix('consumption')->group(function () {
            Route::get('analyze', [ConsumptionController::class, 'analyze'])
                ->name('homes.consumption.analyze');
            Route::post('analyze', [ConsumptionController::class, 'storeAnalysis'])
                ->name('homes.consumption.store');
            Route::get('history', [ConsumptionController::class, 'history'])
                ->name('homes.consumption.history');
        });
        
        // Recomendaciones
        Route::prefix('recommendations')->group(function () {
            Route::get('/', [RecommendationController::class, 'index'])
                ->name('homes.recommendations.index');
            Route::post('generate', [RecommendationController::class, 'generate'])
                ->name('homes.recommendations.generate');
            Route::put('{recommendation}/implement', [RecommendationController::class, 'markAsImplemented'])
                ->name('homes.recommendations.implement');
        });
        
        // Metas
        Route::resource('goals', GoalController::class)
            ->except(['index'])
            ->names([
                'create' => 'homes.goals.create',
                'store' => 'homes.goals.store',
                'show' => 'homes.goals.show',
                'edit' => 'homes.goals.edit',
                'update' => 'homes.goals.update',
                'destroy' => 'homes.goals.destroy',
            ]);
            
        Route::get('goals', [GoalController::class, 'index'])
            ->name('homes.goals.index');
            
        // Reportes
        Route::prefix('reports')->group(function () {
            Route::get('excel', [ReportController::class, 'exportExcel'])
                ->name('homes.reports.excel');
            Route::get('pdf', [ReportController::class, 'exportPdf'])
                ->name('homes.reports.pdf');
        });
    });
});

// Para la página de inicio si necesitas una pública
Route::get('/about', function () {
    return view('about');
})->name('about');

require __DIR__.'/auth.php';
