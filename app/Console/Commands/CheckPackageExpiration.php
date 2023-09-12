<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CheckPackageExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:package-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update package expiration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $users = User::where('package_id', '!=', 1)->get();

        foreach ($users as $user) {
            $purchaseDate = Carbon::parse($user->purchase_date);
            $expirationDate = $purchaseDate->addMonths($user->purchase_duration);

            if (Carbon::now()->greaterThan($expirationDate)) {
                $user->update(['package_id' => 1]);
            }
        }

        $this->info('Package expiration checked and updated successfully.');
    }
}