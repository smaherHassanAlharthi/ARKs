<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Consumption;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function avgUsage(Request $request)
    {
        $consumptions = \App\Consumption::latest()->limit(5)->get();


        if ($request->has('date_filter')) {
            $parts = explode(' - ' , $request->input('date_filter'));
            $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
            $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
       } else {
            $date_from = new Carbon('last Monday');
            $date_to = new Carbon('this Sunday');
       }
      $reportTitle = 'SUM Usage';
      $reportLabel = 'SUM';
      $chartType   = 'bar';

      $results = Consumption::where('created_at', '>=', $date_from)->where('created_at', '<=', $date_to)->get()->sortBy('created_at')->groupBy(function ($entry) {
          if ($entry->created_at instanceof \Carbon\Carbon) {
              return \Carbon\Carbon::parse($entry->created_at)->format('Y-m-d');
          }
          try {
             return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->created_at)->format('Y-m-d');
          } catch (\Exception $e) {
               return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->created_at)->format('Y-m-d');
          }        })->map(function ($entries, $group) {
          return $entries->sum('liters');
      });
      $alerts = \App\Alert::limit(5)->get();

        return view('home', compact('reportTitle', 'results', 'chartType', 'reportLabel','consumptions','alerts'));
    }


    public function index()
    {


        $consumptions = \App\Consumption::latest()->limit(5)->get();

        return view('home', compact( 'consumptions' ));
    }
}
