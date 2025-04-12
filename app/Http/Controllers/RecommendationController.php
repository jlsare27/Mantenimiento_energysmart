<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Recommendation;
use App\Services\RecommendationService;

class RecommendationController extends Controller
{
    public function index(Home $home)
    {
        $this->authorize('view', $home);
        
        $recommendations = $home->recommendations()
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('recommendations.index', compact('home', 'recommendations'));
    }

    public function generate(Home $home, RecommendationService $service)
    {
        $this->authorize('update', $home);
        
        $service->generateForHome($home);
        
        return redirect()->route('homes.recommendations.index', $home)
            ->with('success', 'Nuevas recomendaciones generadas');
    }

    public function markAsImplemented(Home $home, Recommendation $recommendation)
    {
        $this->authorize('update', $home);
        
        $recommendation->update(['implemented' => true]);
        
        return back()->with('success', 'Recomendación marcada como implementada');
    }
}