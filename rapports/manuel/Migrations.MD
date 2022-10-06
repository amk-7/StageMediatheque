## Preambule
    A partire de maintemant nous allons travailler sur un projet de gestion d'établisement
    scolaire. Créer une nouvelle application Laravel appellé la GSchool. Çi dessous vous vous
    avez le modèle sur le quelle nous allons travailler.

## Les Migrations
Maintenant que l'application GSchool a été créer nous allons maintement créer une base de données
appellez la **gschool** . Une fois que c'est fait nous allons connecter notre application laravel
à  la base de donnée. Pour le faire rendez vous au niveau du fichier **.env**. Vous vous souvenez
c'est le fichier dans le quelle on configure l'environement **Laravel** (on peut y spécifier la base
de données utilisé, le serveur de méssagerie de notre choix ...). Une fois que le fichier ouver, 
modifier les valeurs des cinq directive comme ceci.

    DB_CONNECTION=pgsql 
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=gschool
    DB_USERNAME=votre_nom_utilisateur_postgres (Ex : Tamba)
    DB_PASSWORD=votre_mot_de_passe_postgres     (EX : 123456789)

Une fois que c'est fait relancer la commande **php artisant serv**.

    NB : A chaque fois que vous modifier le fichier .env, redémarer toujours le serveur Laravel.

Maintemant que notre application est connecter à une base de donnée, nous pouvons y créer des migration.
Une migration est un patterne nous permettant de créer des tables dans une base de données tout en 
étant dans Laravel.

Nous allons maintemant créer nos migration en commencant par la migration **SaleDeCours**. Pour le faire
lancer la commande **artisan** suivante :

`php artisan make:migration create_sale_de_cours_table`

En analysant cette commante vous pouvez remarquer que le nom de la migration est écrit en **snake case**
et est entouré des mots **create_** et **_table** et qu'elle termine par un **s**. 

    NB : Tous vos nom de migration laravel doivent se terminer par un 's'. C'est une convension
    Laravel à absolument respecter.
Voici le résultat de la commande artisan make:migration :

![migration_sale_de_cours]()

Une fois votre migration créer nous pouvez constater que c'est une class **PHP** qui hérite de la class
**Migration** et qu'elle contient deux méthodes : **up et down**.

* **up** est la méthode dans la quelle nous allons indiquer ce qui se passe lorsqu'on lance la migation.
Dans notre cas nous disons que nous voulons que la table sale_de_cours soit créer avec les attributs
que nous avons indiquer dans la méhode **create**.

    Vous l'aurez donc compris la méthode statique de la classe **create** permet de créer la table.
    Dans la fonction anonyme prennant en paramètre un **Blueprint de nom $table** on définis les attributs de notre
    table avec **$table->type** pour plus d'information connernant le type des attributs rendez vous à la documentation
    officiel de Laravel 8 (clicker ici).

* **down**  est la méthode dans la quelle nous indiquons le directive à exécuter lorque la migration
est anuller. Ici nous disons **de supprimer la table sale_de_cours**.

Pour lancer la migration lancé la commande artisan suivante : `php artisan migrate`
Une fois que ce fut fais vous pouvez constater avec moi que la table **sale_de_cours** été créé au niveau de
la base de données.

![migration_sale_de_cours]()