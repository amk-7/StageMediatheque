# Rapport technique du stage  de fin L2 2021-2022 Abdoul malik KONDI && n

## Sommaire
Laravel est un frame ....

## Partie 1/n : Installation et organisation d'un projet laravel. 
Dans cette première partie nous allons créer une application Laravel et voir comment le code y est organisé.
En cas générale pour utiliser le framework laravel vous aurez besoins d'au mininume d'une version **7.3** de php
installer sur vos machines, de plusieurs extensions php installer et d'un SGBD (System de Gestion de Base de Données ici nous utiliserons **postgresql**).

### Le serveur.
Pour fonctionner correctement, laravel à besoin de **PHP**:

- Version > **7.3.0**,
- Extension **pdo** 
- Extension **pgsql** ou *mysql* ou autre selon votre SGBD.
- Extension **mbstring**
- Extension **opcache**
- Extension **xml**
- Extension **curl**
- Extension **gd**
- Extension openSSL
- Extension json
- Extension **fileinfo**
- Extension **ctype**
- Extension **BCMath**
- Extension soap
- Extension **zip**
- Extension **intl**
- Extension **common**
- Extension imagick
- Extension **cli**
- Extension **imap**

> NB : Si vous ne savez pas installer php et activer ces extensions cliquer ici.

## Installation d'un projet laravel via composer.
Il y a plusieurs façons de créer une application Laravel. La plus classique consiste à utiliser la commande 
**create-project** de Composer. voici la syntaxe gnérale à utiliser.
`composer create-project laravel/laravel chemain/du/repertoire --prefer-dist "version" `

> Exemple : `composer create-project laravel/laravel application --prefer-dist "8.*" ` . 
> Crée une application Laravel dans le dossier application.

Une fois l'installation démarré, on a plus qu'a attendre quelques minutes pour que Composer fasse son travail
jusqu'au bout. On verra s'afficher une liste de téléchargements. Au final on se retrouve avec cette architechture :

![archithecture](images/archithecture.png)

Laravel est équiper d'un server pour le developpement qui se lance avec cette commande :

`php artisan serve`

On peut vérifier que tout fonctionne bien en allant sur l'URL http://127.0.0.1:8000. Normalement on
doit obtenir cette page.

![laravel localhost](images/laravel_localhost.png)

Pour des mises à jour ultérieures il suffit encore d'utiliser Composer avec la commande update :

`composer update`

> **Note :** Si vous installez Laravel en téléchargeant directement les fichiers sur Github et en utilisant
> la commande `composer install`, il vous faut effectuer une action suplémentaires.
> En effet, dans ce cas la clé de sécurité ne sera pas automatiquement créé et vous allez tomber sur une
> erreur au lancement. Il faut donc la créer avec la commande.

`php artisan key:generate`

## Organisation d'un projet laravel.

### Répertoire App.
Le repertoire App est répertoire le plus important de votre projet. C'est lui qui contiendra votre application,
c'est à dire tout votre code php (classes, fonctions ...).

![repertoire_app]()

- Console : toutes les commandes en mode console,
- Exceptions : pour gérer les erreurs d'exécution,
- Http : tout ce qui concerne la communication : contrôleurs, middlewares (il y a 8 middlewares
de base qui servent à filtrer les requêtes HTTP) et le kernel,
- Providers : tous les fournisseurs de services (providers), il y en a déjà 5 au départ. Les providers
servent à initialiser les composants.
- Models : le dossier des modèles avec déjà un présent qui concerne les utilisateurs.

### Autres repertoires.

Voici une description du contenu des autres dossiers :
- bootstrap : scripts d'initialisation de Laravel pour le chargement automatique des classes, la
fixation de l'environnement et des chemins, et pour le démarrage de l'application,
- public : tout ce qui doit apparaître dans le dossier public du site : images, CSS, scripts...
- config : toutes les configurations : application, authentification, cache, base de données, espaces
de noms, emails, systèmes de fichier, session...
- database : migrations et populations,
Le dossier database permet la gestion de la base données. Il contient trois sous-dossier.
Les migrations sont des fichiers permettant de décrire votre base de données afin de permettre
à Laravel de créer, modifier ou supprimer les tables et les colonnes automatiquement pour vous.
- resources : vues, fichiers de langage et assets (par exemple les fichiers Sass),
- routes : la gestion des urls d'entrée de l'application,
- storage : données temporaires de l'application : vues compilées, caches, clés de session. . .
- tests : fichiers de tests unitaires,
- vendor : tous les composants de Laravel et de ses dépendances (créé par composer).

### Fichiers de racine.
Il y a un certain nombre de fichiers dans la racine dont voici les principaux :

![repertoire_app]()

- artisan : outil en ligne (ligne de commande) de Laravel pour des tâches de gestion,
- composer.json : fichier de référence de composer,
- package.json : fichier de référence de npm pour les assets,
- phpunit.xml : fichier de configuration de phpunit (pour les tests unitaires),
- .env : fichier pour spécifier l'environnement d'exécution.
Les fichiers .env contient les mots de passe de vos services ainsi que toutes les données sensibles
de votre application (mot de passe de base de données, adresse de la base de données...).
Ce fichier ne doit jamais être partagé. Afin de connaître les informations à renseigner, il existe
un fichier .env.example qui contient uniquement des valeurs d'exemple.
Nous verrons tout cela progressivement dans le cours,

### Accessibilité
Pour des raisons de securité sur le serveur seul le dossier public est accessible.

![public]()

Cette configuration n'est pas toujours possible sur un serveur mutualisé (partagé). Il faut alors modifier 
un tout petit peu Laravel pour que ça fonctionne; nous en palerons peut être dans la partie déployement.

