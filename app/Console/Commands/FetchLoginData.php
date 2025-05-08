<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchLoginData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:login-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch login data from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('http://case-test-api.humanas.io/');
        $data = $response->json();

        foreach ($data['data']['rows'] as $row) {
            User::updateOrCreate(
                ['external_id' => $row['id']],
                ['name' => $row['name'], 'logins' => json_encode($row['logins'])]
            );
        }
    
        $this->info('Data fetched and saved successfully.');
    }
}
