<?php

return [
    'title' => 'OTA API for Capacitor with Capgo',
    'subtitle' => 'This API manages Over-The-Air (OTA) updates for your Capacitor applications. It is compatible with the Capgo system and allows you to distribute updates without going through app stores.',

    'base_url' => 'API Base URL',
    'active_token' => 'Active API Token',
    'no_token' => 'No active token. Generate one with:',

    'capacitor_config' => [
        'title' => 'Capacitor Configuration',
        'step1' => [
            'title' => 'Installing Capgo',
        ],
        'step2' => [
            'title' => 'Configuration in your application',
        ],
        'step3' => [
            'title' => 'Configure capacitor.config.ts',
        ],
    ],

    'endpoint' => 'Endpoint',
    'parameters' => 'Parameters',
    'parameter' => 'Parameter',
    'description' => 'Description',
    'request_examples' => 'Request Examples',
    'success_response' => 'Success Response',
    'error_response' => 'Error Response',
    'copy' => 'Copy',
    'copied' => 'Copied!',

    'authentication' => [
        'title' => 'API Authentication',
        'description' => 'All API routes are protected by a token authentication system. The token must be provided in the URL of each request via the api_token parameter.',
        'security_title' => 'Important - Token Security',
        'security_tips' => [
            'Never share your API token publicly',
            'Store the token securely in your environment variables',
            'Use HTTPS in production to protect the token in transit',
            'Regenerate your token regularly for better security',
        ],
        'management_title' => 'Token Management',
        'commands_description' => 'Available Artisan commands:',
        'commands' => [
            'show' => '# Display the active token',
            'generate' => '# Generate a new token',
            'list' => '# List all tokens',
            'revoke' => '# Revoke the active token',
        ],
    ],

    'best_practices' => [
        'title' => 'Best Practices',
        'tips' => [
            'Check for updates at application startup and periodically',
            'Use semantic versioning (e.g., 1.2.0) for easier comparison',
            'Test your bundles before deploying to production',
            'Maintain a detailed changelog for each version',
            'Handle download errors and provide a fallback',
            'Protect the upload endpoint with appropriate authentication',
        ],
    ],

    'build_deploy' => [
        'title' => 'Create a bundle for OTA',
        'step1_title' => '1. Build your React application',
        'step1_command' => '# Build path for Capacitor files',
        'step2_title' => '2. Upload via Filament interface',
        'step2_description' => 'Use the "Versions" section in the administration to upload your bundle. You can also use the API endpoint',
    ],

    'troubleshooting' => [
        'title' => 'Troubleshooting',
        'update_not_downloading' => [
            'title' => 'Update not downloading',
            'solution' => 'Check that the storage symbolic link exists:',
        ],
        'error_404' => [
            'title' => '404 error on endpoints',
            'solution' => 'Verify that the API routes are loaded and that the file exists.',
        ],
        'app_not_updating' => [
            'title' => 'Application not updating',
            'solution' => 'Make sure you have called after your application loads.',
        ],
    ],

    'examples' => [
        'lastversion' => [
            'title' => 'Get the latest version',
            'description' => 'Retrieves information about the latest version available for an application.',
            'params' => [
                'identifier' => 'The unique application identifier (required)',
                'current_version' => 'The current application version (optional)',
                'api_token' => 'Your API authentication token (required)',
            ],
        ],
        'check_update' => [
            'title' => 'Check if an update is available',
            'description' => 'Compares the current version with the latest available version.',
            'params' => [
                'identifier' => 'The unique application identifier (required)',
                'current_version' => 'The current application version (required)',
                'api_token' => 'Your API authentication token (required)',
            ],
        ],
        'download' => [
            'title' => 'Download a specific version',
            'description' => 'Downloads the bundle for a specific version.',
            'params' => [
                'identifier' => 'The unique application identifier',
                'version' => 'The version code to download',
                'api_token' => 'Your API authentication token (required)',
            ],
        ],
        'upload' => [
            'title' => 'Upload a new version (Admin)',
            'description' => 'Uploads a new update bundle (requires authentication).',
            'params' => [
                'identifier' => 'The application identifier (required)',
                'version' => 'The version code (required, e.g., 1.2.0)',
                'bundle' => 'The ZIP file containing the update (required)',
                'changelog' => 'The changelog as a JSON array (optional)',
            ],
        ],
    ],
];
