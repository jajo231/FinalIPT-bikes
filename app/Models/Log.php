<?php

namespace App\Models;

use App\Events\UserLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courier() {
        return $this->belongsTo(Courier::class);
    }

    public function handle(UserLog $event)
{
    // Here, write the logic to save log to database
    Log::create([
        'action' => 'create', // or any other field your logs table has
        'description' => $event->log_entry, // log_entry from your event
        'user_id' => auth()->user()->id, // or any other way you fetch the authenticated user's ID
        // ... other necessary fields ...
    ]);
}

}
