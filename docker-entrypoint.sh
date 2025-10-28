#!/bin/bash
set -e

echo "🚀 Démarrage de l'application..."

# Attendre MySQL
until mysqladmin ping -h"$DB_HOST" -P"${DB_PORT:-3306}" --silent; do
  echo "⏳ En attente de MySQL (${DB_HOST}:${DB_PORT:-3306})..."
  sleep 2
done
echo "✅ MySQL est prêt !"

# Exécuter les migrations
echo "🔄 Exécution des migrations..."
php artisan migrate --force || true

# Créer le lien de stockage
echo "🔗 Création du lien de stockage..."
php artisan storage:link || true

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Générer la clé API uniquement si elle n'existe pas
echo "🔑 Vérification de la clé API..."
if ! php artisan api-token:manage list 2>/dev/null | grep -q 'ACTIVE'; then
  echo "🆕 Génération d'une nouvelle clé API..."
  php artisan api-token:manage generate
else
  echo "✅ Clé API déjà existante."
fi

# Droits
echo "🔐 Configuration des permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✨ Application prête !"
exec "$@"
