<?php

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage');
})->name("homepage");

Route::get('/carbon', function () {
    // dd(CarbonPeriod::create());
    $start_h = "08:00";
    $end_h = "14:00";
     $period = new CarbonPeriod('2022-09-18 '.$start_h, '30 minutes','2022-09-18 '.$end_h);
    $data = [];
         foreach($period as $d){
        echo $d . "  -------------  " .  $d->addMinutes("30");echo "<br/>";
     };
    dd($period);
    //  $period = new CarbonPeriod('2022-09-18', '30 minutes', '2022-09-19');
    // $data = [];
    //  foreach($period as $d){
    //     array_push($data,[
    //         "start" => (string)$d,
    //         "end" => (string)$d->addMinutes("30"),
    //         "created_at" => now(),
    //         "updated_at" => now()
    //     ]);
    //     echo $d . "  -------------  " .  $d->addMinutes("30");
    //     echo "<br/>";
    //  };

    //  Event::insert($data);
    //  dd($data);
    return view('homepage');
});


Route::get("/add",function(Request $request){
    $events = Event::latest()->get();
    // dd($events);
         return response()->json($events,200);
})->name("add");


Route::post("/store",function(Request $request){

    // dd($request->all());
    // dd("ok");
    $date = $request->date;
    $start_h = $request->start_h;
    $end_h = $request->end_h;
    $period = new CarbonPeriod($date." ".$start_h, '30 minutes',$date." ".$end_h);

    $data = [];
     foreach($period as $d){
        array_push($data,[
            "start" => (string)$d,
            "titre" => "appointment",
            "end" => (string)$d->addMinutes("30"),
            "created_at" => now(),
            "updated_at" => now()
        ]);

     };

     Event::insert($data);

     return redirect()->route("homepage");

})->name("store");



//

/*
    $period = CarbonPeriod::since('09:00')->minutes(15)->until('12:00')->toArray();
    foreach($period as $d){
        echo $d->format("H:i");
        echo "<br/>";
     };
     dd("stop");
*/
