# BookMe

> Petite application Symfony (en développement) pour gérer une bibliothèque.

**Statut actuel**: projet partiellement implémenté — fonctionnalités de base présentes, beaucoup d'améliorations prévues.

**But**: fournir une app permettant de gérer les ouvrages, exemplaires, réservations et utilisateurs.

**Prérequis**
- PHP 8.1+ (ou version requise par `composer.json`)
- Composer
- Une base de données compatible Doctrine (MySQL/MariaDB/PostgreSQL ou SQLite)
- (Optionnel) Symfony CLI pour un serveur local pratique
- (Optionnel) Node.js + npm/yarn si vous devez construire les assets front (si `package.json` présent)

**Installation (développement, PowerShell)**

1. Cloner le dépôt et aller dans le répertoire du projet :

   ```powershell
   cd C:\chemin\vers\bookme
   ```

2. Installer les dépendances PHP avec Composer :

   ```powershell
   composer install
   ```

3. Copier le fichier d'environnement et adapter la configuration :

   ```powershell
   Copy-Item .env .env.local
   # Puis éditez .env.local et configurez DATABASE_URL
   ```

   Exemples de `DATABASE_URL` :

   - SQLite (simple pour le dev) :
     `DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"`
   - MySQL :
     `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`

4. Créer la base de données et exécuter les migrations :

   ```powershell
   # Crée la base si la connexion le permet
   php bin/console doctrine:database:create
   # Applique les migrations présentes
   php bin/console doctrine:migrations:migrate
   ```

5. Charger les fixtures (optionnel, utile pour données de dev) :

   ```powershell
   php bin/console doctrine:fixtures:load --no-interaction
   ```

6. (Si le projet utilise des assets buildés avec npm/yarn)

   ```powershell
   # depuis la racine si package.json présent
   npm install
   npm run dev   # ou npm run build
   ```

**Lancer l'application**

Option A — avec Symfony CLI (recommandé pour dev) :

```powershell
symfony server:start
# puis ouvrir https://127.0.0.1:8000 ou l'URL indiquée
```

Option B — sans Symfony CLI (PHP builtin server) :

```powershell
php -S 127.0.0.1:8000 -t public public/index.php
# puis ouvrir http://127.0.0.1:8000
```

**Navigation dans l'application**
 Dans cette version il n'est possible de naviguer entre les pages qu'en modifiant l'URL, voici donc les différentes pages :
 - /accueil
 - /ouvrage
 - /connexion
 - /inscription

**Exécuter les tests**

Le projet contient une configuration PHPUnit. Pour lancer les tests :

```powershell
php bin/phpunit
# ou, si vous préférez
vendor\bin\phpunit
```

**Fichiers importants**
- `bin/console` : utilitaire Symfony CLI local
- `public/` : point d'entrée web (`index.php`)
- `src/` : code source (contrôleurs, entités, formulaires, repository)
- `migrations/` : fichiers de migrations Doctrine
- `templates/` : vues Twig
- `assets/` : sources front-end

**Fonctionnalités actuelles (aperçu)**
- Entités `Ouvrage`, `Exemplaire`, `Reservation`, `User`
- Migrations et fixtures incluses pour peupler la base
- Templates Twig basiques pour quelques pages (`accueil`, `connexion`, `ouvrage`)

**Limitations & À venir**
- Interface incomplète et styles minimaux
- Gestion complète des utilisateurs (inscription / rôles / sécurité) à valider
- Workflow complet des prêts et retours à implémenter
- Tests unitaires et fonctionnels à enrichir
- Packaging/déploiement pour production à préparer

**Dépannage rapide**
- Si `composer install` échoue pour mémoire : augmentez la mémoire PHP temporairement
- Vérifiez que `var/` est accessible en écriture par PHP
- Si connexion DB échoue, vérifiez la valeur de `DATABASE_URL` dans `.env.local`
