<?php

return [
    'navigation' => [
        'apps' => 'Applications',
        'versions' => 'Versions',
        'documentation' => 'Documentation OTA',
    ],

    'resources' => [
        'app' => [
            'label' => 'Application',
            'plural_label' => 'Applications',
            'navigation_group' => 'Gestion',
        ],
        'version' => [
            'label' => 'Version',
            'plural_label' => 'Versions',
            'navigation_group' => 'Gestion',
        ],
    ],

    'fields' => [
        'name' => 'Nom',
        'code' => 'Code de version',
        'identifier' => 'Identifiant',
        'description' => 'Description',
        'icon' => 'Icône',
        'version_name' => 'Nom de la version',
        'version_number' => 'Numéro de version',
        'build_number' => 'Numéro de build',
        'release_notes' => 'Notes de version',
        'file' => 'Fichier',
        'file_url' => 'URL du fichier',
        'file_size' => 'Taille du fichier',
        'is_mandatory' => 'Mise à jour obligatoire',
        'is_active' => 'Actif',
        'platform' => 'Plateforme',
        'min_os_version' => 'Version OS minimale',
        'created_at' => 'Créé le',
        'updated_at' => 'Modifié le',
        'app_id' => 'Application',
        'path' => 'Bundle ZIP',
        'changelog' => 'Changelog',
        'note' => 'Note',
    ],

    'sections' => [
        'version_info' => [
            'title' => 'Informations de la version',
            'description' => 'Configurez les détails de la version OTA',
        ],
        'ota_bundle' => [
            'title' => 'Bundle OTA',
            'description' => 'Uploadez le fichier ZIP contenant la mise à jour',
        ],
        'changelog' => [
            'title' => 'Changelog',
            'description' => 'Ajoutez les notes de version',
        ],
    ],

    'helpers' => [
        'select_app' => 'Sélectionnez l\'application pour laquelle cette version est destinée',
        'version_format' => 'Format recommandé: X.Y.Z (ex: 1.2.0)',
        'upload_bundle' => 'Uploadez le fichier ZIP contenant les fichiers de l\'application (dossier www/)',
        'changelog_list' => 'Listez les modifications apportées dans cette version',
    ],

    'buttons' => [
        'add_note' => 'Ajouter une note',
    ],

    'placeholders' => [
        'version_code' => '1.0.0',
        'changelog_note' => 'Ex: Correction du bug de connexion',
    ],

    'actions' => [
        'create' => 'Créer',
        'edit' => 'Modifier',
        'delete' => 'Supprimer',
        'view' => 'Voir',
        'download' => 'Télécharger',
    ],
];
