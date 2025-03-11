<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete users who have been soft deleted for more than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersCount = User::onlyTrashed()
            ->where('deleted_at', '<=', Carbon::now()->subDays(30))
            ->count(); // Get the count of users before deleting

        if ($usersCount > 0) {
            User::onlyTrashed()
                ->where('deleted_at', '<=', Carbon::now()->subDays(30))
                ->forceDelete(); // Delete all in one query

            $this->info("$usersCount old soft-deleted users have been permanently deleted.");
        } else {
            $this->info('No old soft-deleted users found.');
        }
    }
}
