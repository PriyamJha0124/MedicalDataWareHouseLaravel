<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\View\View;
use TCPDF;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $vaccinations = Vaccination::orderBy('id','ASC');
        if ($request->country){
            $vaccinations =$vaccinations->where('ReportingCountry',$request->country);
        }
        if ($request->month){
            $vaccinations =$vaccinations->where('YearWeekISO',$request->month);
        }
        if ($request->group){
            $vaccinations =$vaccinations->where('TargetGroup',$request->group);
        }
        if ($request->vaccine){
            $vaccinations =$vaccinations->where('Vaccine',$request->vaccine);
        }

        $totalData =  $vaccinations->count();
        $vaccinations =   $vaccinations->paginate(20);
        return view('dashboard')
            ->with([
                'vaccinations'=>$vaccinations,
                'total'=>$totalData
            ]);
    }

    public function report(Request $request)
    {

            ini_set('max_execution_time',2000);
            ini_set('memory_limit','2056M');

            $vaccinations = Vaccination::orderBy('id','ASC');
            if ($request->country) {
                $vaccinations = $vaccinations->where('ReportingCountry', $request->country);
            }
            if ($request->month) {
                $vaccinations = $vaccinations->where('YearWeekISO', $request->month);
            }
            if ($request->group) {
                $vaccinations = $vaccinations->where('TargetGroup', $request->group);
            }
            if ($request->vaccine) {
                $vaccinations = $vaccinations->where('Vaccine', $request->vaccine);
            }

            $totalData =  $vaccinations->count();
            $vaccinations =   $vaccinations->limit(1000)->get();

            $dompdf = new Dompdf();
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf->setOptions($options);
            // Pass data to view using compact
            $html = \view()->make('pdf', compact('totalData', 'vaccinations'))->render();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream('report.pdf', array('Attachment' => true));


    }

}
