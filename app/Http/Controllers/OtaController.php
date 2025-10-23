<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OtaController extends Controller
{
    /**
     * Récupère la dernière version disponible pour une application
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastversion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'current_version' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid parameters',
                'details' => $validator->errors()
            ], 400);
        }

        $app = App::where('identifier', $request->identifier)->first();

        if (!$app) {
            return response()->json([
                'error' => 'Application not found',
            ], 404);
        }

        $latestVersion = $app->latestVersion();

        if (!$latestVersion) {
            return response()->json([
                'error' => 'No version available',
            ], 404);
        }

        return response()->json([
            'version' => $latestVersion->code,
            'url' => $latestVersion->bundle_url,
            'changelog' => $latestVersion->changelog,
            'created_at' => $latestVersion->created_at,
        ]);
    }

    /**
     * Vérifie si une mise à jour est disponible
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'current_version' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid parameters',
                'details' => $validator->errors()
            ], 400);
        }

        $app = App::where('identifier', $request->identifier)->first();

        if (!$app) {
            return response()->json([
                'error' => 'Application not found',
            ], 404);
        }

        $latestVersion = $app->latestVersion();

        if (!$latestVersion) {
            return response()->json([
                'update_available' => false,
            ]);
        }

        // Comparaison simple des versions (peut être améliorée avec version_compare)
        $updateAvailable = $latestVersion->code !== $request->current_version;

        return response()->json([
            'update_available' => $updateAvailable,
            'latest_version' => $latestVersion->code,
            'current_version' => $request->current_version,
            'url' => $updateAvailable ? $latestVersion->bundle_url : null,
            'changelog' => $updateAvailable ? $latestVersion->changelog : null,
        ]);
    }

    /**
     * Télécharge le bundle d'une version spécifique
     *
     * @param string $identifier
     * @param string $version
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\JsonResponse
     */
    public function download($identifier, $version)
    {
        $app = App::where('identifier', $identifier)->first();

        if (!$app) {
            return response()->json([
                'error' => 'Application not found',
            ], 404);
        }

        $versionModel = $app->versions()->where('code', $version)->first();

        if (!$versionModel) {
            return response()->json([
                'error' => 'Version not found',
            ], 404);
        }

        $filePath = storage_path('app/public/' . $versionModel->path);

        if (!file_exists($filePath)) {
            return response()->json([
                'error' => 'Bundle file not found',
            ], 404);
        }

        return response()->download($filePath, basename($filePath), [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ]);
    }

    /**
     * Upload une nouvelle version (pour l'administration)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'version' => 'required|string',
            'bundle' => 'required|file|mimes:zip',
            'changelog' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid parameters',
                'details' => $validator->errors()
            ], 400);
        }

        $app = App::where('identifier', $request->identifier)->first();

        if (!$app) {
            return response()->json([
                'error' => 'Application not found',
            ], 404);
        }

        // Vérifier si la version existe déjà
        $existingVersion = $app->versions()->where('code', $request->version)->first();
        if ($existingVersion) {
            return response()->json([
                'error' => 'Version already exists',
            ], 409);
        }

        // Stocker le fichier
        $file = $request->file('bundle');
        $filename = $request->identifier . '_' . $request->version . '.zip';
        $path = $file->storeAs('bundles', $filename, 'public');

        // Créer l'enregistrement de version
        $version = Version::create([
            'app_id' => $app->id,
            'code' => $request->version,
            'changelog' => $request->changelog ?? [],
            'path' => $path,
        ]);

        return response()->json([
            'success' => true,
            'version' => $version->code,
            'url' => $version->bundle_url,
        ], 201);
    }
}
