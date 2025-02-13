<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\DB;

class IncrementMemberCount
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // Check if the 'members' table has a record
        $member = DB::table('members')->first();

        if ($member) {
            // Increment the member count
            DB::table('members')
                ->where('id', $member->id)
                ->increment('count');
        } else {
            // Create the record if it doesn't exist and set the initial count to 1
            DB::table('members')->insert(['count' => 1]);
        }
    }
}
