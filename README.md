# Symfony Teach'r API

Test technique demandé par Teach'r.

L'objectif du projet est de créer une API qui offre 3 routes pour manager
une ressource ***"Teachr"***.

Sommaire: 
  * [I- Pré-requis](#i--pr--requis)
  * [II- Comment lancer le projet ?](#ii--comment-lancer-le-projet--)
    + [Tests](#tests)
  * [III- Routes](#iii--routes)
    + [`GET  /teachr`](#-get---teachr-)
    + [`POST /teachr`](#-post--teachr-)
    + [`PUT  /teachr/{id}`](#-put---teachr--id--)
        - [Note](#nb--)


## I- Pré-requis

Pour lancer le projet il faut :
- avoir `composer` installé
- avoir `php >= 7.2` installé
- avoir `MySQL >= 5.0` installé

## II- Comment lancer le projet ?

Pour lancer l'application il faut : 

1- installer les dépendances :

```bash
composer install 
```

2- Mettre en place la base de données :

Modifier le fichier `.env` pour correspondre à votre base de données 

```dotenv
DATABASE_URL="mysql://{utitisateur}:{mot_de_passe}@127.0.0.1:3306/{base_de_données}"
```

Installer la Base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

3- Lancer le serveur :

```bash
php -S localhost:8000 -t public
```

4- Pour générer des données par défaut vous pouvez effectuer la commande : 

```bash
php bin\console hautelook:fixtures:load
```


5- Ouvrir le navigateur à l'adresse http://localhost:8000

### Tests

Ce projet a été conçu en suivant le modèle du Test Driven Développement.
Vous pouvez lancer les test avec la commande :

```bash
php bin/phpunit
```

## III- Routes


### `GET  /teachr` 

Cette route affiche la liste des objets teachr.
La réponse est un objet sous la forme :

```js
{
  status: 200,
  message: "Succès",
  data: [
    {  
      id: 1,   
      prenom: "Marc Zémour",
      formation: "Université Rennes1",   
      description:  "Calme et patient...",
      dateDeCreation: 1000546546 //(timestamp)
    },
    {  
      id: 2,   
      prenom: "Jean François",
      formation: "Université Rennes2",   
      description:  "Calme et patient...",
      dateDeCreation: 1000546547 //(timestamp)
    }, 
    // ...
  ]
}
 ```
### `POST /teachr` 

Cette route permet de créer un objet teachr.
Vous devez envoyer un objet de la forme
```js
{  
   prenom
   formation   
   description
 }
 ```

La réponse est le nouvel objet créé : 
```js
{
    status: 200,
    message: "Opération effectuée avec succès",
    data: {  
        id: 2,   
        prenom: "Jean François",
        formation: "Université Rennes2",   
        description:  "Calme et patient...",
        dateDeCreation: 1000546547 //(timestamp)
    } 
}
```

### `PUT  /teachr/{id}` 

Cette route permet de modifier un objet teachr.
Vous devez envoyer un objet de la forme :

```js
{  
   prenom
   formation   
   description
 }
 ```

La réponse est l'objet modifié : 
```js
{
    status: 200,
    message: "Opération effectuée avec succès",
    data: {  
         id: 2,   
         prenom: "Jean François",
         formation: "Université Rennes2",   
         description:  "Calme et patient...",
         dateDeCreation: 1000546547 //(timestamp)
    } 
}
```

#### Note :
Si l'id passé en paramètre ne correspond à aucun objet, la réponse renvoyée est une réponse 404 de la forme :
```js
{
    status: 404,
    message: "Objet Non trouvé",
    data: null
}
```