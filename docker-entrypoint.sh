#!/bin/bash
set -e

echo "🚀 Démarrage de l'application..."

# Attendre que MySQL soit prêt
echo "⏳ Attente de la disponibilité de MySQL..."
until php artisan db:show 2>/dev/null; do
    echo "   MySQL n'est pas encore prêt - attente..."
    sleep 2
done

echo "✅ MySQL est prêt!"

# Exécuter les migrations
echo "🔄 Exécution des migrations..."
php artisan migrate --force

# Créer le lien de stockage si nécessaire
echo "🔗 Création du lien de stockage..."
php artisan storage:link || true

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Définir les permissions appropriées
echo "🔐 Configuration des permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✨ Application prête!"

# Démarrer Apache
exec "$@"
