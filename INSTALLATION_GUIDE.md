# Guide d'installation - Système d'authentification API

Ce guide vous accompagne dans la mise en place du système d'authentification par token API pour votre gestionnaire OTA.

## Nouveaux fichiers créés

### 1. Migration de la base de données
- **Fichier :** `database/migrations/2025_10_25_000000_create_api_tokens_table.php`
- **Description :** Crée la table pour stocker les tokens API

### 2. Modèle
- **Fichier :** `app/Models/ApiToken.php`
- **Description :** Modèle Eloquent pour gérer les tokens API
- **Méthodes principales :**
  - `generateToken()` - Génère un nouveau token sécurisé
  - `createToken($name)` - Crée un nouveau token en base
  - `isValid($token)` - Vérifie la validité d'un token
  - `getActiveToken()` - Récupère le token actif

### 3. Seeder
- **Fichier :** `database/seeders/ApiTokenSeeder.php`
- **Description :** Génère automatiquement le token initial lors de l'installation

### 4. Middleware
- **Fichier :** `app/Http/Middleware/ValidateApiToken.php`
- **Description :** Middleware pour valider les tokens API sur les routes protégées
- **Supporte 3 méthodes d'authentification :**
  - Header `Authorization: Bearer TOKEN`
  - Header `X-API-Token: TOKEN`
  - Paramètre de requête `?api_token=TOKEN`

### 5. Commande Artisan
- **Fichier :** `app/Console/Commands/ManageApiToken.php`
- **Description :** Commande CLI pour gérer les tokens
- **Actions disponibles :**
  - `show` - Affiche le token actif
  - `generate` - Génère un nouveau token
  - `list` - Liste tous les tokens
  - `revoke` - Révoque le token actif
  - `activate` - Active un token révoqué

### 6. Documentation
- **Fichiers :**
  - `API_DOCUMENTATION.md` - Documentation complète de l'API
  - `README.md` - Guide de démarrage rapide (mis à jour)
  - `INSTALLATION_GUIDE.md` - Ce fichier

## Étapes d'installation

### Étape 1 : Exécuter les migrations

```bash
php artisan migrate
```

Cette commande va créer la table `api_tokens` dans votre base de données.

### Étape 2 : Générer le token initial

**Option A : Via le seeder (recommandé pour la première installation)**

```bash
php artisan db:seed --class=ApiTokenSeeder
```

**Option B : Via la commande de gestion**

```bash
php artisan api-token:manage generate --name="Production Token"
```

**Important :** Copiez et sauvegardez le token affiché dans un endroit sûr. Il ne sera plus affiché par la suite.

### Étape 3 : Vérifier l'installation

```bash
php artisan api-token:manage show
```

Cette commande devrait afficher les informations du token actif.

### Étape 4 : Tester l'API

Avec Docker (si vous utilisez Docker) :

```bash
docker exec -it votre_container_app bash
php artisan migrate
php artisan api-token:manage generate
```

Test avec curl :

```bash
# Récupérez d'abord votre token
TOKEN=$(php artisan api-token:manage show | grep "Token:" | awk '{print $2}')

# Test de l'endpoint
curl -H "Authorization: Bearer $TOKEN" \
     "http://localhost:8000/api/ota/lastversion?identifier=com.example.app"
```

## Utilisation quotidienne

### Afficher le token actif

```bash
php artisan api-token:manage show
```

### Générer un nouveau token

```bash
php artisan api-token:manage generate --name="Mon nouveau token"
```

Cela va automatiquement :
1. Désactiver tous les anciens tokens
2. Créer et activer un nouveau token
3. Afficher le nouveau token (sauvegardez-le !)

### Lister tous les tokens

```bash
php artisan api-token:manage list
```

### Révoquer le token actif

```bash
php artisan api-token:manage revoke
```

Utile si vous pensez qu'un token a été compromis.

### Activer un ancien token

```bash
php artisan api-token:manage activate
```

Vous pourrez choisir parmi les tokens révoqués.

## Intégration dans votre application mobile

### Configuration TypeScript/JavaScript

```typescript
// config/api.ts
export const API_CONFIG = {
  BASE_URL: 'https://votre-domaine.com/api/ota',
  TOKEN: 'VOTRE_TOKEN_ICI', // À mettre dans vos variables d'environnement
  APP_IDENTIFIER: 'com.example.app'
}
```

### Exemple de requête

```typescript
// services/update.service.ts
import { API_CONFIG } from '../config/api'

async function checkForUpdates(currentVersion: string) {
  const response = await fetch(
    `${API_CONFIG.BASE_URL}/check-update?identifier=${API_CONFIG.APP_IDENTIFIER}&current_version=${currentVersion}`,
    {
      headers: {
        'Authorization': `Bearer ${API_CONFIG.TOKEN}`,
        'Content-Type': 'application/json'
      }
    }
  )

  if (!response.ok) {
    if (response.status === 401) {
      throw new Error('Token API invalide ou expiré')
    }
    throw new Error('Erreur lors de la vérification des mises à jour')
  }

  return await response.json()
}
```

## Gestion des erreurs

### Erreur 401 : Unauthorized

**Causes possibles :**
1. Token manquant dans la requête
2. Token invalide ou révoqué
3. Format du header incorrect

**Solutions :**
```bash
# Vérifier le token actif
php artisan api-token:manage show

# Si aucun token actif, en générer un
php artisan api-token:manage generate

# Vérifier le format du header
# Correct : Authorization: Bearer abc123...
# Incorrect : Authorization: abc123... (manque "Bearer")
```

### Erreur 404 : Application not found

**Causes possibles :**
1. L'identifiant de l'application est incorrect
2. L'application n'existe pas en base de données

**Solutions :**
1. Vérifier l'identifiant dans l'interface Filament (/admin)
2. Créer l'application via l'interface d'administration

## Sécurité

### Bonnes pratiques

1. **Ne jamais exposer le token dans le code client**
   - Utilisez des variables d'environnement
   - Ne le committez jamais dans Git
   - Ajoutez `.env` dans `.gitignore`

2. **Rotation régulière des tokens**
   ```bash
   # Générer un nouveau token tous les 3-6 mois
   php artisan api-token:manage generate --name="Production Token Q1 2025"
   ```

3. **Surveillance de l'utilisation**
   ```bash
   # Vérifier la dernière utilisation
   php artisan api-token:manage show
   ```

4. **Révoquer immédiatement en cas de compromission**
   ```bash
   php artisan api-token:manage revoke
   php artisan api-token:manage generate
   ```

5. **Toujours utiliser HTTPS en production**
   - Le token transite en clair dans les headers
   - HTTPS est OBLIGATOIRE pour la sécurité

### Variables d'environnement

Ajoutez dans votre `.env` :

```env
# Pour référence uniquement (ne pas stocker le token ici)
# API_TOKEN_NAME=Production Token
```

## Dépannage

### La commande artisan ne fonctionne pas

```bash
# Si vous utilisez Docker
docker exec -it nom_container_app php artisan api-token:manage show

# Vérifier que le middleware est bien enregistré
cat bootstrap/app.php | grep ValidateApiToken
```

### Les routes ne sont pas protégées

Vérifier que le middleware est bien appliqué dans `routes/api.php` :

```php
Route::prefix('ota')->middleware('api.token')->group(function () {
    // ...
});
```

### Token non reconnu

```bash
# Vérifier que la migration a bien été exécutée
php artisan migrate:status

# Vérifier qu'un token existe
php artisan api-token:manage list
```

## Prochaines étapes

1. Testez l'API avec Postman ou curl
2. Intégrez le token dans votre application mobile
3. Configurez HTTPS pour la production
4. Mettez en place une rotation régulière des tokens

## Support

Pour toute question ou problème :
- Consultez la [documentation complète de l'API](API_DOCUMENTATION.md)
- Vérifiez les logs Laravel : `storage/logs/laravel.log`
- Utilisez `php artisan api-token:manage list` pour diagnostiquer

---

**Dernière mise à jour :** 25 octobre 2025
