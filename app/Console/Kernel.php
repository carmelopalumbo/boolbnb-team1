<?php

namespace App\Console;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $this->checkSponsored();
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function checkSponsored(){
        $results = DB::table('property_sponsor')
            ->select('property_id', 'end_date')
            ->get()
            ->groupBy('property_id')->values()->toArray();
            foreach ($results as $result) {
                // dd($result[0]->end_date);
                // dd(Carbon::parse($result[0]->end_date)->timestamp);
                // dd(Carbon::now()->timestamp);
                $property = Property::where('id', $result[0]->property_id)->first();
                if($property->is_sponsored){
                    dump('IO SONO QUI');
                    $date1 = strtotime(Carbon::now('+01:00')->toDateTimeString());
                    $date2 = strtotime($result[0]->end_date);
                    dump($date1);
                    dump($date2);
                    if($date1 > $date2){
                        dump('IO SONO befuiafoaebeaiofbaeo');
                        $property->update(['is_sponsored' => 0]);
                    }
                }
            }
    }
}
