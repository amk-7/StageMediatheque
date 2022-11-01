## Creation du projet Laravel mediatheque
`composer create-project laravel/laravel mediatheque --prefer-dist "8.*" `

## Installation de debugbar
    Pour installer le debugbar ou même un projet laravel il faut s'assurer que tous 
    indispensable suivant soit activé ou installer pour le faire on utilise décommente
    ces lignes dans le php.ini ou on les installe avec la commandes :

### Commande
    sudo apt-get install php7.4-extension   

#
    Mais ici mon problème c'est que mon php est en version 7.4 or laravel lui il est à 8
    et souhaite que j'ai un php dont la version > 8:
### Résoulution du problème.
    1.Version de php: php -v
    2.Liste des package de php dpkg -l | grep php | tee packages.txt
    3.Suppression de php : sudo apt-get purge php7.*
        - Nétoyage des dépendences php:
            * sudo apt-get autoclean
            * sudo apt-get autoremove
    4.Préparation du système pour une nouvelle réinstallation:

`sudo add-apt-repository ppa:ondrej/php`
    
    5.Installation de php 
        * sudo apt-get update
        * sudo apt-get install php8.1
        * sudo systemctl restart apache2
    6.Installation des instensions php:

`sudo apt install php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-intl -y`

    7.Vérification de la nouvelle version : php -v

    Pour installer le debuge bar il faut lancer la commande:

`composer require barryvdh/laravel-debugbar:* --dev --ignore-platform-req=ext-mysql_xdevapi`


## Installation du package helper

`composer require mercuryseries/laravel-helpers --ignore-platform-req=ext-mysql_xdevapi`

    Ajout d'un provider
    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
    
### Usage
    `php artisan ide-helper:generate`    

## Installation de Tailwindcss
    NB: Pour plus d'information allez sur la doc
    de tailwindcss => https://tailwindcss.com/docs/guides/laravel
   
    sudo apt update
    sudo apt install nodejs npm

    npm install -D tailwindcss postcss autoprefixer
    npx tailwindcss init -p

## Pagination with tailwindcss
    npm i tailwindcss-plugins -D

## Installation du module pour l'importation en excel.

    composer require maatwebsite/excel --ignore-platform-req=ext-mysql_xdevapi
    php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
    php artisan make:import UsersImport --model=User

## Installation du module de qr-code

    composer require simplesoftwareio/simple-qrcode "~4" --ignore-platform-req=ext-mysql_xdevapi
    
## Authentification.
composer require laravel/breeze --dev

--ignore-platform-req=ext-mysql_xdevapi

## Regler le problème de imagick
    composer require bacon/bacon-qr-code
Etape 1 : 
 sudo apt install php-imagick
 php -m | grep imagick
 sudo /etc/init.d/apache2 restart

Etape 2 : installation de livewire
 composer require livewire/livewire
 php artisan livewire:publish --config
 php artisan livewire:publish --assets

Etape 3 :
 composer dump-autoload

    
