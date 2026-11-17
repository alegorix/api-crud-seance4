# API REST PHP & Client Web - Séance 4 (Complète)

Ce dossier constitue le projet final des 4 séances :
1. **API REST PHP MVC** avec PDO (MySQL).
2. **Gestion complète de CORS** (en-têtes et requêtes préliminaires `OPTIONS`).
3. **Application front-end monopage (SPA légère)** en HTML5, CSS3 moderne et JavaScript (Fetch API).

## 1. Démarrage rapide
1. Importer `schema.sql` dans MySQL / phpMyAdmin.
2. Vérifier les identifiants dans `config/Database.php`.
3. Placer le dossier dans votre serveur local (ex. `htdocs/api-crud-seance4/`).
4. Ouvrir votre navigateur sur : `http://localhost/api-crud-seance4/`

## 2. Observer les requêtes dans les DevTools
- Ouvrez l'inspecteur réseau (F12 -> Réseau/Network).
- Testez un ajout ou une mise à jour : observez la requête `OPTIONS` (Preflight) puis la requête `POST` ou `PUT` avec payload JSON.
