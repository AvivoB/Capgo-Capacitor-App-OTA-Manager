<?php

return [
    'title' => 'API OTA pour Capacitor avec Capgo',
    'subtitle' => 'Cette API permet de gérer les mises à jour Over-The-Air (OTA) pour vos applications Capacitor. Elle est compatible avec le système Capgo et permet de distribuer des mises à jour sans passer par les stores.',

    'base_url' => 'URL de base de l\'API',
    'active_token' => 'Token API actif',
    'no_token' => 'Aucun token actif. Générez-en un avec :',

    'capacitor_config' => [
        'title' => 'Configuration de Capacitor',
        'step1' => [
            'title' => 'Installation de Capgo',
        ],
        'step2' => [
            'title' => 'Configuration dans votre application',
        ],
        'step3' => [
            'title' => 'Configuration de capacitor.config.ts',
        ],
    ],

    'endpoint' => 'Endpoint',
    'parameters' => 'Paramètres',
    'parameter' => 'Paramètre',
    'description' => 'Description',
    'request_examples' => 'Exemples de requêtes',
    'success_response' => 'Réponse succès',
    'error_response' => 'Réponse erreur',
    'copy' => 'Copier',
    'copied' => 'Copié !',

    'authentication' => [
        'title' => 'Authentification API',
        'description' => 'Toutes les routes API sont protégées par un système de token d\'authentification. Le token doit être fourni dans l\'URL de chaque requête via le paramètre api_token.',
        'security_title' => 'Important - Sécurité du token',
        'security_tips' => [
            'Ne partagez jamais votre token API publiquement',
            'Stockez le token de manière sécurisée dans vos variables d\'environnement',
            'Utilisez HTTPS en production pour protéger le token en transit',
            'Régénérez régulièrement votre token pour plus de sécurité',
        ],
        'management_title' => 'Gestion du token',
        'commands_description' => 'Commandes Artisan disponibles :',
        'commands' => [
            'show' => '# Afficher le token actif',
            'generate' => '# Générer un nouveau token',
            'list' => '# Lister tous les tokens',
            'revoke' => '# Révoquer le token actif',
        ],
    ],

    'best_practices' => [
        'title' => 'Bonnes pratiques',
        'tips' => [
            'Vérifiez les mises à jour au démarrage de l\'application et périodiquement',
            'Utilisez le versioning sémantique (ex: 1.2.0) pour faciliter la comparaison',
            'Testez vos bundles avant de les déployer en production',
            'Gardez un changelog détaillé pour chaque version',
            'Gérez les erreurs de téléchargement et proposez un fallback',
            'Protégez l\'endpoint d\'upload avec une authentification appropriée',
        ],
    ],

    'build_deploy' => [
        'title' => 'Créer un bundle pour OTA',
        'step1_title' => '1. Build de votre application React',
        'step1_command' => '# Chemin des fichiers de build de capacitor',
        'step2_title' => '2. Upload via l\'interface Filament',
        'step2_description' => 'Utilisez la section "Versions" dans l\'administration pour uploader votre bundle. Vous pouvez également utiliser l\'endpoint API',
    ],

    'troubleshooting' => [
        'title' => 'Dépannage',
        'update_not_downloading' => [
            'title' => 'La mise à jour ne se télécharge pas',
            'solution' => 'Vérifiez que le lien symbolique storage existe :',
        ],
        'error_404' => [
            'title' => 'Erreur 404 sur les endpoints',
            'solution' => 'Vérifiez que les routes API sont bien chargées et que le fichier existe.',
        ],
        'app_not_updating' => [
            'title' => 'L\'application ne se met pas à jour',
            'solution' => 'Assurez-vous d\'avoir appelé après le chargement de votre application.',
        ],
    ],

    'examples' => [
        'lastversion' => [
            'title' => 'Récupérer la dernière version',
            'description' => 'Récupère les informations de la dernière version disponible pour une application.',
            'params' => [
                'identifier' => 'L\'identifiant unique de l\'application (requis)',
                'current_version' => 'La version actuelle de l\'application (optionnel)',
                'api_token' => 'Votre token d\'authentification API (requis)',
            ],
        ],
        'check_update' => [
            'title' => 'Vérifier si une mise à jour est disponible',
            'description' => 'Compare la version actuelle avec la dernière version disponible.',
            'params' => [
                'identifier' => 'L\'identifiant unique de l\'application (requis)',
                'current_version' => 'La version actuelle de l\'application (requis)',
                'api_token' => 'Votre token d\'authentification API (requis)',
            ],
        ],
        'download' => [
            'title' => 'Télécharger une version spécifique',
            'description' => 'Télécharge le bundle d\'une version spécifique.',
            'params' => [
                'identifier' => 'L\'identifiant unique de l\'application',
                'version' => 'Le code de version à télécharger',
                'api_token' => 'Votre token d\'authentification API (requis)',
            ],
        ],
        'upload' => [
            'title' => 'Upload une nouvelle version (Admin)',
            'description' => 'Upload un nouveau bundle de mise à jour (nécessite une authentification).',
            'params' => [
                'identifier' => 'L\'identifiant de l\'application (requis)',
                'version' => 'Le code de version (requis, ex: 1.2.0)',
                'bundle' => 'Le fichier ZIP contenant la mise à jour (requis)',
                'changelog' => 'Le changelog au format JSON array (optionnel)',
            ],
        ],
    ],
];
