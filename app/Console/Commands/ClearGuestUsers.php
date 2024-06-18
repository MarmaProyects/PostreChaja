<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearGuestUsers extends Command
{
    
    protected $signature = 'clear:guest-users';
    protected $description = 'Clear inactive guest users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expiryDate = Carbon::now()->subDays(1);

        User::where('is_guest', true)
            ->where('created_at', '<', $expiryDate)
            ->delete();

        $this->info('Inactive guest users cleared successfully.');
    }
}
