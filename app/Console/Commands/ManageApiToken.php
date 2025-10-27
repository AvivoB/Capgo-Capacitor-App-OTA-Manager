<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use Illuminate\Console\Command;

class ManageApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-token:manage {action} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage API tokens (actions: show, generate, revoke, activate)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'show':
                $this->showToken();
                break;
            case 'generate':
                $this->generateToken();
                break;
            case 'revoke':
                $this->revokeToken();
                break;
            case 'activate':
                $this->activateToken();
                break;
            case 'list':
                $this->listTokens();
                break;
            default:
                $this->error("Invalid action. Available actions: show, generate, revoke, activate, list");
                return 1;
        }

        return 0;
    }

    /**
     * Show the current active token
     */
    private function showToken()
    {
        $token = ApiToken::getActiveToken();

        if (!$token) {
            $this->warn('No active API token found.');
            $this->info('Run "php artisan api-token:manage generate" to create one.');
            return;
        }

        $this->info('Active API Token:');
        $this->line('');
        $this->line('Name: ' . $token->name);
        $this->line('Token: ' . $token->token);
        $this->line('Created: ' . $token->created_at->format('Y-m-d H:i:s'));
        $this->line('Last used: ' . ($token->last_used_at ? $token->last_used_at->format('Y-m-d H:i:s') : 'Never'));
    }

    /**
     * Generate a new API token
     */
    private function generateToken()
    {
        $name = $this->option('name') ?? 'API Token ' . now()->format('Y-m-d H:i:s');

        // Désactive les anciens tokens
        ApiToken::where('is_active', true)->update(['is_active' => false]);

        $token = ApiToken::createToken($name);

        $this->info('New API Token generated successfully!');
        $this->line('');
        $this->warn('IMPORTANT: Save this token securely, it will not be shown again:');
        $this->line('');
        $this->line($token->token);
        $this->line('');
    }

    /**
     * Revoke the active token
     */
    private function revokeToken()
    {
        $token = ApiToken::getActiveToken();

        if (!$token) {
            $this->warn('No active API token found.');
            return;
        }

        $token->update(['is_active' => false]);
        $this->info('API Token revoked successfully.');
    }

    /**
     * Activate a revoked token
     */
    private function activateToken()
    {
        $tokens = ApiToken::where('is_active', false)->get();

        if ($tokens->isEmpty()) {
            $this->warn('No revoked tokens found.');
            return;
        }

        $this->info('Available revoked tokens:');
        foreach ($tokens as $index => $token) {
            $this->line(($index + 1) . '. ' . $token->name . ' (Created: ' . $token->created_at->format('Y-m-d H:i:s') . ')');
        }

        $choice = $this->ask('Enter the number of the token to activate');

        if (!is_numeric($choice) || $choice < 1 || $choice > $tokens->count()) {
            $this->error('Invalid choice.');
            return;
        }

        $selectedToken = $tokens[$choice - 1];

        // Désactive tous les tokens actifs
        ApiToken::where('is_active', true)->update(['is_active' => false]);

        // Active le token sélectionné
        $selectedToken->update(['is_active' => true]);

        $this->info('Token activated successfully.');
        $this->line('Token: ' . $selectedToken->token);
    }

    /**
     * List all tokens
     */
    private function listTokens()
    {
        $tokens = ApiToken::all();

        if ($tokens->isEmpty()) {
            $this->warn('No API tokens found.');
            return;
        }

        $this->info('All API Tokens:');
        $this->line('');

        foreach ($tokens as $token) {
            $status = $token->is_active ? '✓ ACTIVE' : '✗ REVOKED';
            $this->line($status . ' | ' . $token->name);
            $this->line('  Token: ' . $token->token);
            $this->line('  Created: ' . $token->created_at->format('Y-m-d H:i:s'));
            $this->line('  Last used: ' . ($token->last_used_at ? $token->last_used_at->format('Y-m-d H:i:s') : 'Never'));
            $this->line('');
        }
    }
}
