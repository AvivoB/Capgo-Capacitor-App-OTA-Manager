<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class OtaDocumentation extends Page
{
  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

  protected static ?string $navigationLabel = 'Documentation API OTA';

  protected static ?string $title = 'Documentation API OTA';

  protected static UnitEnum|string|null $navigationGroup = 'OTA Management';

  protected static ?int $navigationSort = 3;

  protected string $view = 'filament.pages.ota-documentation';


  public function getViewData(): array
  {
    return [
      'baseUrl' => url('/api/ota'),
      'examples' => $this->getExamples(),
    ];
  }

  protected function getExamples(): array
  {
    return [
      'lastversion' => [
        'title' => 'Récupérer la dernière version',
        'method' => 'GET',
        'endpoint' => '/api/ota/lastversion',
        'description' => 'Récupère les informations de la dernière version disponible pour une application.',
        'parameters' => [
          'identifier' => 'L\'identifiant unique de l\'application (requis)',
          'current_version' => 'La version actuelle de l\'application (optionnel)',
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/lastversion?identifier=com.example.app&current_version=1.0.0') . '"',
          'javascript' => <<<JS
fetch('{{url}}/api/ota/lastversion?identifier=com.example.app&current_version=1.0.0')
  .then(response => response.json())
  .then(data => console.log(data));
JS,
          'Javascript' => <<<JS
import { CapacitorUpdater } from '@capgo/capacitor-updater'

// Configuration de l'URL de votre serveur
const serverUrl = '{{url}}/api/ota'

async function checkForUpdate() {
  const response = await fetch(`\${serverUrl}/lastversion?identifier=com.example.app&current_version=1.0.0`)
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
        'title' => 'Vérifier si une mise à jour est disponible',
        'method' => 'GET',
        'endpoint' => '/api/ota/check-update',
        'description' => 'Compare la version actuelle avec la dernière version disponible.',
        'parameters' => [
          'identifier' => 'L\'identifiant unique de l\'application (requis)',
          'current_version' => 'La version actuelle de l\'application (requis)',
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/check-update?identifier=com.example.app&current_version=1.0.0') . '"',
          'javascript' => <<<JS
fetch('{{url}}/api/ota/check-update?identifier=com.example.app&current_version=1.0.0')
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
        'title' => 'Télécharger une version spécifique',
        'method' => 'GET',
        'endpoint' => '/api/ota/download/{identifier}/{version}',
        'description' => 'Télécharge le bundle d\'une version spécifique.',
        'parameters' => [
          'identifier' => 'L\'identifiant unique de l\'application',
          'version' => 'Le code de version à télécharger',
        ],
        'request' => [
          'curl' => 'curl -X GET "' . url('/api/ota/download/com.example.app/1.2.0') . '" -o update.zip',
          'javascript' => <<<JS
// Télécharger directement
window.location.href = '{{url}}/api/ota/download/com.example.app/1.2.0';

// Ou avec fetch pour obtenir le fichier
fetch('{{url}}/api/ota/download/com.example.app/1.2.0')
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
        'title' => 'Upload une nouvelle version (Admin)',
        'method' => 'POST',
        'endpoint' => '/api/admin/ota/upload',
        'description' => 'Upload un nouveau bundle de mise à jour (nécessite une authentification).',
        'parameters' => [
          'identifier' => 'L\'identifiant de l\'application (requis)',
          'version' => 'Le code de version (requis, ex: 1.2.0)',
          'bundle' => 'Le fichier ZIP contenant la mise à jour (requis)',
          'changelog' => 'Le changelog au format JSON array (optionnel)',
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
