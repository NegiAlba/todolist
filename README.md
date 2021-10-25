# PHP procedural/fonctionnel : Une to-do list améliorée avec un système de login


## Fonctionnalités de l'application

- Un système d'authentification (user)
    Inscription & connexion des users
    Mot de passe oublié
    Page de profil users pour consulter ses infos et les modifier

- Un système de gestion de taches (task) 
    CRUD des tasks dans la BDD
    La gestion de tasks est soumise à une authentification

## Modèle conceptuel+logique de l'application

### DB NAME : todolist

Tables

```
**user**
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
username VARCHAR (25) NOT NULL
password VARCHAR (255) NOT NULL
email VARCHAR (255) NOT NULL
secret_phrase VARCHAR (255) NOT NULL
role BOOLEAN NOT NULL DEFAULT 1
```

```
**task**
task_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
author_id INT NOT NULL
title VARCHAR (255) NOT NULL
description TEXT
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
deadline DATETIME
status INT NOT NULL
FOREIGN KEY author_id REFERENCES user(id)
FOREIGN KEY status REFERENCES status(status_id)
```

```
**status**
status_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
label VARCHAR (100) NOT NULL
```

### SQL DATABASE/TABLES CREATION (see db.sql, also on gist)
[Link to DB.sql](https://gist.github.com/NegiAlba/ce3c1a46b72314e6947a4792bfee81c0)

# ENVIRONMENT VARIABLES

Ne pas oublier de créer vos variables d'environnement. Elles sont contenus dans un fichier `dev.env.php` au format :

```
    const DB_HOST = 'mysql:host=HOST;dbname=NOM_BDD;charset=CHARSET';
    const DB_USER = 'USER';
    const DB_PASS = 'PASSWORD';
```
