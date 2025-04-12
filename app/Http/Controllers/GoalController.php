<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Exports\HomeConsumptionExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportExcel(Home $home)
    {
        $this->authorize('view', $home);
        return Excel::download(new HomeConsumptionExport($home), "consumo-{$home->name}.xlsx");
    }

    public function exportPdf(Home $home)
    {
        $this->authorize('view', $home);
        
        $home->load(['appliances', 'lightings', 'energyConsumptions' => function($q) {
            $q->latest()->limit(6);
        }]);
        
        $pdf = Pdf::loadView('reports.home', compact('home'));
        return $pdf->download("reporte-{$home->name}.pdf");
    }
}