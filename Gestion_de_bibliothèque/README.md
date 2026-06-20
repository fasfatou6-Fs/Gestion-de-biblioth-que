# SGBLE : Système Intégré de Gestion de Bibliothèque et Restitutions

SGBLE est un prototype d'application web moderne et sécurisé conçu pour automatiser la gestion d'une bibliothèque universitaire (flux d'acquisitions, catalogue, transactions d'emprunts, et régularisation des litiges). Ce projet a été développé en équipe dans le cadre de notre initiation pratique aux méthodologies Agiles (Scrum) et aux processus DevOps sous le framework **Laravel**.

---

## 🎨 Identité Visuelle et Design
L'interface graphique de l'application est habillée d'une charte graphique personnalisée de style **Rose Marine et Violet** :
* **Bleu Marine Profond :** Appliqué aux structures de navigation (sidebar, navbar) pour ancrer le professionnalisme de la plateforme.
* **Violet et Rose Poudré :** Utilisés pour accentuer les éléments dynamiques (boutons d'action, états de survol, badges de statut des stocks et fenêtres modales).

---

## 🛠️ Fonctionnalités Principales & Comportements Implémentés

Le prototype opérationnel en local s'articule autour de trois flux utilisateurs majeurs :
1.  **Consultation du Catalogue :** Recherche multicritère et affichage dynamique des ouvrages (`Livres`) accessible à tous les utilisateurs connectés.
2.  **Gestion Intelligente des Emprunts :** Automatisation du flux d'emprunt avec pré-sélection de l'ouvrage depuis sa fiche descriptive et décrémentation automatique des stocks physiques.
3.  **Régularisation des Litiges (Pénalités) :** Système d'interception par fenêtre modale Bootstrap permettant la simulation de paiement en direct avec capture dynamique du montant de la pénalité.
4.  **Tableaux de Bord Rôle-Dépendant :** Indicateurs globaux pour l'administration et statistiques personnelles restreintes pour le lecteur.

---

## 🔐 Sécurisation & Architecture RBAC

L'accès à l'application est strictement cloisonné par rôles (Administrateur / Bibliothécaire vs Étudiant Lecteur) via des mécanismes de sécurité transversaux :
* **Middlewares de Routes (`web.php`) :** Isolation hermétique des fonctions critiques (création, modification, suppression, accès aux logs) via le middleware `role:admin|bibliothecaire`.
* **Contrôle au Niveau des Contrôleurs :** `EmpruntController` filtre dynamiquement les indexes selon le rôle et force l'injection de `auth()->id()` pour interdire l'usurpation d'identité. `PenaliteController` restreint l'action de paiement au seul propriétaire ou à l'administrateur.
* **Masquage Adaptatif (Vues Blade) :** Les fonctions d'édition et de suppression sont conditionnellement masquées pour les non-administrateurs.
* **Traçabilité DevOps (Logs d'Audit) :** Chaque action sensible déclenche automatiquement une écriture dans la table `logs_activites` (ID utilisateur, type d'action, horodatage complet, adresse IP).

---

## 🚀 Installation et Déploiement en Local

### Prérequis
* Laragon / XAMPP / WampServer (PHP >= 8.x, MySQL)
* Composer
* Node.js & NPM

### Procédure de configuration rapide
```bash
# 1. Cloner le dépôt et se positionner dans le répertoire du projet
cd .\Gestion_de_bibliothèque\

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript et générer les assets (Vite)
npm install
npm run dev

# 4. Configurer le fichier d'environnement
cp .env.example .env
php artisan key:generate

# 5. Exécuter les migrations et injecter les jeux de données de test (Seeders)
php artisan migrate:fresh --seed

# 6. Lancer le serveur de développement Laravel
php artisan serve
