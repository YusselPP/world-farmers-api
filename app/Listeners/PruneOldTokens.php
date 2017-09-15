<?php

namespace App\Listeners;

use Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Log;

class PruneOldTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        //
        Log::info('RefreshTokenCreated');
        Log::info('accessTokenId = '.$event->accessTokenId);
        Log::info('refreshTokenId = '.$event->refreshTokenId);
    }
}
