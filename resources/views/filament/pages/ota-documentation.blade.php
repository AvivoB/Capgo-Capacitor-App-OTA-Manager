<x-filament-panels::page>
    {{-- Highlight.js CSS --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/typescript.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
        </script>

    @endpush


    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .code-block {
            position: relative;
        }

        .copy-button {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .code-block:hover .copy-button {
            opacity: 1;
        }

        pre code.hljs {
            padding: 1.5rem !important;
            border-radius: 0.5rem;
        }
    </style>

    <div class="space-y-8">
        {{-- Introduction --}}
        <div
            class="relative overflow-hidden bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-2xl shadow-2xl p-8 text-white animate-fade-in-up">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <h2 class="tw-text-3xl tw-font-extrabold">
                        API OTA pour Capacitor avec Capgo
                    </h2>
                </div>
                <p class="text-blue-50 mb-6 text-lg leading-relaxed">
                    Cette API permet de gérer les mises à jour Over-The-Air (OTA) pour vos applications Capacitor.
                    Elle est compatible avec le système Capgo et permet de distribuer des mises à jour sans passer par
                    les stores.
                </p>
                <div
                    class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:bg-white/20 transition-all duration-300">
                    <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        URL de base de l'API
                    </p>
                    <code
                        class="bg-black/30 px-4 py-2 rounded-lg text-sm font-mono block break-all">{{ $baseUrl }}</code>
                </div>
            </div>
        </div>

        {{-- Configuration Capacitor --}}
        <div
            class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700 animate-fade-in-up hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-gradient-to-br from-green-400 to-blue-500 p-3 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Configuration de Capacitor
                </h3>
            </div>

            <div class="space-y-6">
                <div class="group">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 text-white font-bold text-sm">1</span>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Installation de Capgo</h4>
                    </div>
                    <div class="code-block relative">
                        <button
                            class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                            onclick="copyCode(this)">
                            Copier
                        </button>
                        <pre><code class="language-bash">npm install @capgo/capacitor-updater
npx cap sync</code></pre>
                    </div>
                </div>

                <div class="group">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 text-white font-bold text-sm">2</span>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Configuration dans votre
                            application</h4>
                    </div>
                    <div class="code-block relative">
                        <button
                            class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                            onclick="copyCode(this)">
                            Copier
                        </button>
                        <pre><code class="language-javascript">// main.tsx ou App.tsx
import { CapacitorUpdater } from '@capgo/capacitor-updater'

// Configuration
CapacitorUpdater.notifyAppReady()

async function checkAndUpdate() {
  try {
    const response = await fetch('{{ $baseUrl }}/lastversion?identifier=com.example.app')
    const data = await response.json()

    if (data.version && data.url) {
      console.log('Nouvelle version disponible:', data.version)

      // Télécharger la mise à jour
      const version = await CapacitorUpdater.download({
        url: data.url,
        version: data.version
      })

      // Installer la mise à jour
      await CapacitorUpdater.set(version)

      // Recharger l'application
      await CapacitorUpdater.reload()
    }
  } catch (error) {
    console.error('Erreur lors de la mise à jour:', error)
  }
}

// Vérifier les mises à jour au démarrage
checkAndUpdate()</code></pre>
                    </div>
                </div>

                <div class="group">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-pink-500 to-orange-600 text-white font-bold text-sm">3</span>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Configuration de
                            capacitor.config.ts</h4>
                    </div>
                    <div class="code-block relative">
                        <button
                            class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                            onclick="copyCode(this)">
                            Copier
                        </button>
                        <pre><code class="language-typescript">import { CapacitorConfig } from '@capacitor/cli'

const config: CapacitorConfig = {
  appId: 'com.example.app',
  appName: 'My App',
  webDir: 'dist',
  plugins: {
    CapacitorUpdater: {
      autoUpdate: false,
    }
  }
}

export default config</code></pre>
                    </div>
                </div>
            </div>
        </div>

        {{-- Endpoints Documentation --}}
        @foreach ($examples as $key => $example)
            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700 animate-fade-in-up hover:shadow-2xl transition-all duration-300"
                id="{{ $key }}">
                <div class="flex flex-col md:flex-row md:items-start justify-between mb-6 gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            {{ $example['title'] }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $example['description'] }}
                        </p>
                    </div>
                    <span
                        class="px-4 py-2 rounded-xl text-sm font-bold shadow-lg inline-block
                        {{ $example['method'] === 'GET' ? 'bg-gradient-to-r from-green-400 to-emerald-600 text-white' : 'bg-gradient-to-r from-blue-400 to-cyan-600 text-white' }}">
                        {{ $example['method'] }}
                    </span>
                </div>

                {{-- Endpoint --}}
                <div class="mb-6">
                    <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                                clip-rule="evenodd" />
                        </svg>
                        Endpoint
                    </h4>
                    <div
                        class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 rounded-xl p-4 border-l-4 border-blue-500">
                        <code
                            class="text-sm font-mono text-gray-800 dark:text-gray-200 break-all">{{ $example['endpoint'] }}</code>
                    </div>
                </div>

                {{-- Parameters --}}
                @if (isset($example['parameters']))
                    <div class="mb-6">
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Paramètres
                        </h4>
                        <div
                            class="bg-white dark:bg-gray-900 rounded-xl p-4 border border-gray-200 dark:border-gray-700 overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b-2 border-gray-300 dark:border-gray-600">
                                        <th class="text-left py-3 px-2 text-gray-700 dark:text-gray-300 font-bold">
                                            Paramètre</th>
                                        <th class="text-left py-3 px-2 text-gray-700 dark:text-gray-300 font-bold">
                                            Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($example['parameters'] as $param => $description)
                                        <tr
                                            class="border-b border-gray-200 dark:border-gray-700 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                            <td class="py-3 px-2">
                                                <code
                                                    class="bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900 dark:to-pink-900 px-3 py-1 rounded-lg text-xs text-purple-800 dark:text-purple-200 font-semibold">
                                                    {{ $param }}
                                                </code>
                                            </td>
                                            <td class="py-3 px-2 text-gray-600 dark:text-gray-400">{{ $description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- Request Examples --}}
                <div class="mb-6">
                    <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                        Exemples de requêtes
                    </h4>

                    @foreach ($example['request'] as $type => $request)
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="px-3 py-1 bg-gradient-to-r from-gray-700 to-gray-800 text-white text-xs font-bold rounded-lg uppercase">
                                    {{ $type === 'curl' ? 'cURL' : ($type === 'javascript' ? 'JavaScript' : ucfirst($type)) }}
                                </span>
                            </div>
                            <div class="code-block relative">
                                <button
                                    class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                                    onclick="copyCode(this)">
                                    Copier
                                </button>
                                <pre><code class="language-{{ $type === 'curl' ? 'bash' : $type }}">{!! str_replace('{{ url }}', url(''), e($request)) !!}</code></pre>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Response Examples --}}
                <div class="grid md:grid-cols-2 gap-6">
                    @if (isset($example['response_success']))
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Réponse succès
                            </h4>
                            <div class="code-block relative">
                                <button
                                    class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                                    onclick="copyCode(this)">
                                    Copier
                                </button>
                                <pre><code class="language-json">{{ is_array($example['response_success']) ? json_encode($example['response_success'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $example['response_success'] }}</code></pre>
                            </div>
                        </div>
                    @endif

                    @if (isset($example['response_error']))
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Réponse erreur
                            </h4>
                            <div class="code-block relative">
                                <button
                                    class="copy-button bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-all"
                                    onclick="copyCode(this)">
                                    Copier
                                </button>
                                <pre><code class="language-json">{{ is_array($example['response_error']) ? json_encode($example['response_error'], JSON_PRETTY_PRINT) : $example['response_error'] }}</code></pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Best Practices --}}
        <div
            class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl shadow-xl p-8 border-2 border-green-200 dark:border-green-700 animate-fade-in-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-gradient-to-br from-green-400 to-emerald-600 p-3 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Bonnes pratiques
                </h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Vérifiez les mises à jour au démarrage de
                        l'application et périodiquement</span>
                </div>
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Utilisez le versioning sémantique (ex: 1.2.0) pour
                        faciliter la comparaison</span>
                </div>
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Testez vos bundles avant de les déployer en
                        production</span>
                </div>
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Gardez un changelog détaillé pour chaque
                        version</span>
                </div>
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Gérez les erreurs de téléchargement et proposez un
                        fallback</span>
                </div>
                <div
                    class="flex items-start bg-white dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition-all duration-300 border border-green-200 dark:border-green-700">
                    <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-gray-700 dark:text-gray-300">Protégez l'endpoint d'upload avec une
                        authentification appropriée</span>
                </div>
            </div>
        </div>

        {{-- Build & Deploy --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Créer un bundle pour OTA
            </h3>
            <div class="space-y-4">
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">1. Build de votre application React
                    </h4>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-green-400 text-sm"><code>npm run build
npx cap sync
zip -r ./dist #Chemin des fichiers de build de capacitor
</code></pre>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">2. Upload via l'interface Filament
                    </h4>
                    <p class="text-gray-600 dark:text-gray-400">
                        Utilisez la section "Versions" dans l'administration pour uploader votre bundle.
                        Vous pouvez également utiliser l'endpoint API <code
                            class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded text-xs">/api/admin/ota/upload</code>
                    </p>
                </div>
            </div>
        </div>

        {{-- Troubleshooting --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Dépannage
            </h3>
            <div class="space-y-4">
                <div class="border-l-4 border-yellow-500 pl-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
                        La mise à jour ne se télécharge pas
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Vérifiez que le lien symbolique storage existe : <code
                            class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded text-xs">php artisan
                            storage:link</code>
                    </p>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
                        Erreur 404 sur les endpoints
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Vérifiez que les routes API sont bien chargées et que le fichier <code
                            class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded text-xs">routes/api.php</code>
                        existe.
                    </p>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
                        L'application ne se met pas à jour
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Assurez-vous d'avoir appelé <code
                            class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded text-xs">CapacitorUpdater.notifyAppReady()</code>
                        après le chargement de votre application.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
