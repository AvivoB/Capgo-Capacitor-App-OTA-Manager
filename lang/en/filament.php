<?php

return [
    'navigation' => [
        'apps' => 'Applications',
        'versions' => 'Versions',
        'documentation' => 'OTA Documentation',
    ],

    'resources' => [
        'app' => [
            'label' => 'Application',
            'plural_label' => 'Applications',
            'navigation_group' => 'Management',
        ],
        'version' => [
            'label' => 'Version',
            'plural_label' => 'Versions',
            'navigation_group' => 'Management',
        ],
    ],

    'fields' => [
        'name' => 'Name',
        'code' => 'Version code',
        'identifier' => 'Identifier',
        'description' => 'Description',
        'icon' => 'Icon',
        'version_name' => 'Version name',
        'version_number' => 'Version number',
        'build_number' => 'Build number',
        'release_notes' => 'Release notes',
        'file' => 'File',
        'file_url' => 'File URL',
        'file_size' => 'File size',
        'is_mandatory' => 'Mandatory update',
        'is_active' => 'Active',
        'platform' => 'Platform',
        'min_os_version' => 'Minimum OS version',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'app_id' => 'Application',
        'path' => 'ZIP Bundle',
        'changelog' => 'Changelog',
        'note' => 'Note',
    ],

    'sections' => [
        'version_info' => [
            'title' => 'Version Information',
            'description' => 'Configure the OTA version details',
        ],
        'ota_bundle' => [
            'title' => 'OTA Bundle',
            'description' => 'Upload the ZIP file containing the update',
        ],
        'changelog' => [
            'title' => 'Changelog',
            'description' => 'Add release notes',
        ],
    ],

    'helpers' => [
        'select_app' => 'Select the application this version is for',
        'version_format' => 'Recommended format: X.Y.Z (e.g., 1.2.0)',
        'upload_bundle' => 'Upload the ZIP file containing the application files (www/ folder)',
        'changelog_list' => 'List the changes made in this version',
    ],

    'buttons' => [
        'add_note' => 'Add a note',
    ],

    'placeholders' => [
        'version_code' => '1.0.0',
        'changelog_note' => 'E.g., Fixed login bug',
    ],

    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'view' => 'View',
        'download' => 'Download',
    ],
];
