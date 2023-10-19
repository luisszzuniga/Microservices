# Docker

En premier lieu, j'ai essayé d'avoir une bonne architecture de dossiers pour ce projet utilisant Docker.

À la racine, il y a donc quelques dossiers:

    - bin/ : contient les Dockerfile pour les images Apache et MySQL
    - config/ : contient les fichiers de configuration pour Apache et PHP
    - data/ : contient les données de la base de données
    - logs/ : contient les logs d'Apache et de MySQL
    - www/ : contient le code source du projet

## Docker-compose

Dans ce fichier je lance 3 services :

    - Apache
    - MySQL
    - Adminer

Mysql a deux volumes, un pour les données et un pour les logs.
Apache a quatre volumes, un pour le storage de l'app, un pour le php.ini, un pour les logs apache et un pour la configuration apache.

## Dockerfile

J'ai créé deux images, une pour Apache (php82) et une pour MySQL.

### Apache

Je pars d'une image apache en PHP 8.2.
Je commence par installer tout ce qui est nécessaire pour le bon fonctionnement d'une app PHP (git, curl, unzip, etc...).
Je copie la source de l'app.
J'installe également composer et nodejs.
Je build les assets de l'app.

### MySQL

L'image MySQL est une image officielle qui se configure toute seule grâce aux variables d'environnement définies dans le .env à la racine du dépôt.

# Docker
En premier lieu, j'ai essayé d'avoir une bonne architecture de dossiers pour ce projet utilisant Docker.

À la racine, il y a donc quelques dossiers:

    - bin/ : contient les Dockerfile pour les images Apache et MySQL
    - config/ : contient les fichiers de configuration pour Apache et PHP
    - data/ : contient les données de la base de données
    - logs/ : contient les logs d'Apache et de MySQL
    - www/ : contient le code source du projet

## Docker-compose
Dans ce fichier je lance 3 services :

    - Apache
    - MySQL
    - Adminer

Mysql a deux volumes, un pour les données et un pour les logs.
Apache a quatre volumes, un pour le storage de l'app, un pour le php.ini, un pour les logs apache et un pour la configuration apache.

## Prérequis
Avant de commencer à utiliser ce projet, assurez-vous d'avoir installé Docker et Docker Compose sur votre machine.

### Comment démarrer
Pour démarrer votre environnement Docker, utilisez :

    // docker-compose up -d

### Pour stopper les services :

    // docker-compose down

### Variables d'environnement
Ce fichier utilise des variables d'environnement telles que MYSQL_ROOT_PASSWORD, MYSQL_DATABASE, PHPVERSION, etc.
Assurez-vous que ces variables sont correctement définies dans votre fichier .env.

## Dockerfile

### Apache

Je pars d'une image apache en PHP 8.2.
Je commence par installer tout ce qui est nécessaire pour le bon fonctionnement d'une app PHP (git, curl, unzip, etc...).
Je copie la source de l'app.
J'installe également composer et nodejs.
Je build les assets de l'app.

### MySQL
L'image MySQL est une image officielle qui se configure toute seule grâce aux variables d'environnement définies dans le .env à la racine du dépôt.

#### Configuration supplémentaire
Pour une configuration MySQL spécifique, ajoutez un fichier my.cnf dans le dossier config/ et incluez-le dans votre image.

### Adminer
Adminer est utilisé pour gérer facilement la base de données MySQL. Il est accessible via le port 8080.

### MySQL
Utilisez un mot de passe robuste pour l'utilisateur root de MySQL et définissez-le dans le fichier .env.

## Conclusion
Ce guide devrait vous permettre de comprendre comment fonctionne notre environnement Dockerisé pour le développement d'applications PHP. Il est conçu pour être facilement extensible et personnalisable selon les besoins du projet.