<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use Illuminate\Database\Seeder;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifie si un token existe déjà
        if (ApiToken::count() === 0) {
            $token = ApiToken::createToken('Initial API Token');

            $this->command->info('API Token generated successfully!');
            $this->command->line('');
            $this->command->warn('IMPORTANT: Save this token securely, it will not be shown again:');
            $this->command->line('');
            $this->command->info($token->token);
            $this->command->line('');
        } else {
            $this->command->info('API Token already exists. Skipping...');
        }
    }
}
