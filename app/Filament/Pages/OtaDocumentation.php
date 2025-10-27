<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class OtaDocumentation extends Page
{
  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

  protected static ?int $navigationSort = 3;

  public static function getNavigationLabel(): string
  {
      return __('filament.navigation.documentation');
  }

  public function getTitle(): string
  {
      return __('filament.navigation.documentation');
  }

  public static function getNavigationGroup(): ?string
  {
      return __('filament.resources.app.navigation_group');
  }

  protected string $view = 'filament.pages.ota-documentation';


  public function getViewData(): array
  {
    return [
      'baseUrl' => url('/api/ota'),
      'apiToken' => $this->getActiveToken(),
      'examples' => $this->getExamples(),
      'translations' => [
        'title' => __('documentation.title'),
        'subtitle' => __('documentation.subtitle'),
        'base_url' => __('documentation.base_url'),
        'active_token' => __('documentation.active_token'),
        'no_token' => __('documentation.no_token'),
        'copy' => __('documentation.copy'),
        'copied' => __('documentation.copied'),
        'endpoint' => __('documentation.endpoint'),
        'parameters' => __('documentation.parameters'),
        'parameter' => __('documentation.parameter'),
        'description' => __('documentation.description'),
        'request_examples' => __('documentation.request_examples'),
        'success_response' => __('documentation.success_response'),
        'error_response' => __('documentation.error_response'),
      ],
    ];
  }

  protected function getActiveToken(): ?string
  {
    $token = \App\Models\ApiToken::getActiveToken();
    return $token ? $token->token : null;
  }

  protected function getExamples(): array
  {
    return [
      'lastversion' => [
        'title' => __('documentation.examples.lastversion.title'),
        'method' => 'GET',
        'endpoint' => '/api/ota/lastversion',
        'description' => __('documentation.examples.lastversion.description'),
        'parameters' => [
          'identifier' => __('documentation.examples.lastversion.params.identifier'),
          'current_version' => __('documentation.examples.lastversion.params.current_version'),
          'api_token' => __('documentation.examples.lastversion.params.api_token'),
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/lastversion?identifier=com.example.app&current_version=1.0.0&api_token={{token}}') . '"',
          'javascript' => <<<JS
const API_TOKEN = 'VOTRE_TOKEN_ICI';

fetch('{{url}}/api/ota/lastversion?identifier=com.example.app&current_version=1.0.0&api_token=' + API_TOKEN)
  .then(response => response.json())
  .then(data => console.log(data));
JS,
          'Javascript' => <<<JS
import { CapacitorUpdater } from '@capgo/capacitor-updater'

// Configuration
const API_TOKEN = 'VOTRE_TOKEN_ICI';
const serverUrl = '{{url}}/api/ota'

async function checkForUpdate() {
  const response = await fetch(`\${serverUrl}/lastversion?identifier=com.example.app&current_version=1.0.0&api_token=\${API_TOKEN}`)
  const data = await response.json()

  if (data.version && data.url) {
    // Télécharger et installer la mise à jour
    await CapacitorUpdater.download({
      url: data.url,
      version: data.version
    })
  }
}
JS,
        ],
        'response_success' => [
          'version' => '1.2.0',
          'url' => url('/storage/bundles/com.example.app_1.2.0.zip'),
          'changelog' => [
            'Correction de bugs',
            'Amelioration des performances',
            'Nouvelles fonctionnalites',
          ],
          'created_at' => '2025-10-23T14:30:00.000000Z',
        ],
        'response_error' => [
          'error' => 'Application not found',
        ],
      ],
      'check_update' => [
        'title' => __('documentation.examples.check_update.title'),
        'method' => 'GET',
        'endpoint' => '/api/ota/check-update',
        'description' => __('documentation.examples.check_update.description'),
        'parameters' => [
          'identifier' => __('documentation.examples.check_update.params.identifier'),
          'current_version' => __('documentation.examples.check_update.params.current_version'),
          'api_token' => __('documentation.examples.check_update.params.api_token'),
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/check-update?identifier=com.example.app&current_version=1.0.0&api_token={{token}}') . '"',
          'javascript' => <<<JS
const API_TOKEN = 'VOTRE_TOKEN_ICI';

fetch('{{url}}/api/ota/check-update?identifier=com.example.app&current_version=1.0.0&api_token=' + API_TOKEN)
  .then(response => response.json())
  .then(data => {
    if (data.update_available) {
      console.log('Mise à jour disponible:', data.latest_version);
    }
  });
JS,
        ],
        'response_success' => [
          'update_available' => true,
          'latest_version' => '1.2.0',
          'current_version' => '1.0.0',
          'url' => url('/storage/bundles/com.example.app_1.2.0.zip'),
          'changelog' => [
            'Correction de bugs',
            'Amelioration des performances',
          ],
        ],
      ],
      'download' => [
        'title' => __('documentation.examples.download.title'),
        'method' => 'GET',
        'endpoint' => '/api/ota/download/{identifier}/{version}',
        'description' => __('documentation.examples.download.description'),
        'parameters' => [
          'identifier' => __('documentation.examples.download.params.identifier'),
          'version' => __('documentation.examples.download.params.version'),
          'api_token' => __('documentation.examples.download.params.api_token'),
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/download/com.example.app/1.2.0?api_token={{token}}') . '" -o update.zip',
          'javascript' => <<<JS
const API_TOKEN = 'VOTRE_TOKEN_ICI';

// Télécharger directement
window.location.href = '{{url}}/api/ota/download/com.example.app/1.2.0?api_token=' + API_TOKEN;

// Ou avec fetch pour obtenir le fichier
fetch('{{url}}/api/ota/download/com.example.app/1.2.0?api_token=' + API_TOKEN)
  .then(response => response.blob())
  .then(blob => {
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'update.zip';
    a.click();
  });
JS,
        ],
        'response_success' => 'Fichier ZIP téléchargé',
        'response_error' => [
          'error' => 'Version not found',
        ],
      ],
      'upload' => [
        'title' => __('documentation.examples.upload.title'),
        'method' => 'POST',
        'endpoint' => '/api/admin/ota/upload',
        'description' => __('documentation.examples.upload.description'),
        'parameters' => [
          'identifier' => __('documentation.examples.upload.params.identifier'),
          'version' => __('documentation.examples.upload.params.version'),
          'bundle' => __('documentation.examples.upload.params.bundle'),
          'changelog' => __('documentation.examples.upload.params.changelog'),
        ],
        'request' => [
          'curl' => <<<BASH
curl -X POST "{{url}}/api/admin/ota/upload" \\
  -F "identifier=com.example.app" \\
  -F "version=1.2.0" \\
  -F "bundle=@/path/to/update.zip" \\
  -F 'changelog[]=Correction de bugs' \\
  -F 'changelog[]=Nouvelles fonctionnalités'
BASH,
          'javascript' => <<<JS
const formData = new FormData();
formData.append('identifier', 'com.example.app');
formData.append('version', '1.2.0');
formData.append('bundle', fileInput.files[0]);
formData.append('changelog', JSON.stringify([
  'Correction de bugs',
  'Nouvelles fonctionnalités'
]));

fetch('{{url}}/api/admin/ota/upload', {
  method: 'POST',
  body: formData
})
  .then(response => response.json())
  .then(data => console.log(data));
JS,
        ],
        'response_success' => [
          'success' => true,
          'version' => '1.2.0',
          'url' => url('/storage/bundles/com.example.app_1.2.0.zip'),
        ],
        'response_error' => [
          'error' => 'Version already exists',
        ],
      ],
    ];
  }
}
