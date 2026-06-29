# ✅ Tasklist Reloaded — Gestionnaire de tâches Symfony

Application web de gestion de tâches avancée développée avec **Symfony**, offrant une organisation complète par priorités, dossiers, statuts et filtres, avec une interface soignée en Tailwind CSS.

> Projet réalisé dans le cadre de la formation **DWWM (RNCP 37674)** — La Plateforme Toulouse

---

## ✨ Fonctionnalités

- **CRUD complet des tâches** — création, modification, suppression
- **Priorités** — Haute / Moyenne / Basse, avec indicateur visuel coloré
- **Dossiers** — organisation des tâches en catégories personnalisées
- **Cycle de statut** — passage fluide entre `À faire` → `En cours` → `Terminé` en un clic
- **Pin / Unpin** — épingler les tâches importantes en tête de liste
- **Filtres** — filtrage par statut, priorité ou dossier
- **Authentification** — gestion des sessions utilisateurs (Symfony Security)
- **Interface responsive** — design Tailwind CSS, rendu Twig

---

## 🛠 Stack technique

| Couche          | Technologie                        |
|-----------------|------------------------------------|
| Framework       | Symfony                            |
| Langage         | PHP 8+                             |
| ORM             | Doctrine ORM + Migrations          |
| Base de données | MySQL                              |
| Templates       | Twig + Tailwind CSS                |
| Auth            | Symfony Security                   |
| Outils          | Git, Docker                        |

---

## 📁 Structure du projet

```
phase3-symfony-tasklist-reloaded/
├── src/
│   ├── Controller/      # Contrôleurs (Task, Folder, Security…)
│   ├── Entity/          # Entités Doctrine (Task, Folder, User)
│   ├── Form/            # FormTypes Symfony
│   └── Repository/      # Repositories Doctrine
├── templates/           # Vues Twig
├── migrations/          # Migrations Doctrine
├── config/              # Configuration Symfony
└── composer.json
```

---

## ⚙️ Prérequis

- PHP 8.0+
- Composer
- MySQL
- Symfony CLI (recommandé)

---

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/YnYnm8/phase3-symfony-tasklist-reloaded.git
cd phase3-symfony-tasklist-reloaded
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env .env.local
```

Modifier `.env.local` :

```dotenv
DATABASE_URL="mysql://user:password@127.0.0.1:3306/tasklist?serverVersion=8.0.32&charset=utf8mb4"
```

### 4. Créer la base de données et appliquer les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Démarrer le serveur

```bash
symfony serve
```

Ouvrir [http://localhost:8000](http://localhost:8000)

---

## 🎯 Fonctionnement

1. **Créer un compte** ou se connecter
2. **Créer des dossiers** pour organiser vos tâches (ex : Travail, Personnel)
3. **Ajouter des tâches** avec titre, description, priorité et dossier
4. **Changer le statut** d'une tâche en un clic (`À faire` → `En cours` → `Terminé`)
5. **Épingler** les tâches urgentes pour les garder en haut de liste
6. **Filtrer** par statut, priorité ou dossier selon vos besoins

---

## 👤 Auteur

**Meiko** — [github.com/YnYnm8](https://github.com/YnYnm8)
