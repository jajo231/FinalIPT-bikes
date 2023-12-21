<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Courier;

class UpdateCourierAvailability extends Command
{
    protected $signature = 'courier:update-availability';
    protected $description = 'Updates the availability of couriers every ten seconds';

    public function handle()
    {
        $startTime = time();
        while (true) {
            Courier::where('availability', false)
                   ->update(['availability' => true]);

            sleep(10);

            if (time() - $startTime > 59) {
                break;
            }
        }

        // $this->info('Courier availability updated.');
    }
}
