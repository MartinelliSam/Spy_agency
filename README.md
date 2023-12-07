# Spy_agency
Site internet permettant la gestion des données d'une agence d'espions.
Projet codé en PHP, sur un modèle MVC, avec création d'un CRUD pour gérer entièrement les enregistrement de la base de données.

## Description

### Présentation du site
Une interface front-office, accessible à tous, permet de visualiser les missions de la BDD, et de rechercher une mission selon certains critères. 

![front](https://github.com/MartinelliSam/Spy_agency/assets/122564923/c29e00a2-9f0a-424e-a077-ff30b2e23906)

Une interface back-office a également été créée ppur permettre aux utilisateurs de rôle administrateur de gérer la BDD, et ainsi lister, créer, modifier ou supprimer chaque donnée des différentes tables. 

![agents](https://github.com/MartinelliSam/Spy_agency/assets/122564923/fcdcee28-257a-4ff4-8f89-24b05570e337)

### Règles métier lors de la création d'une mission
* La ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents.
* Les contacts sont obligatoirement de la nationalité du pays de la mission.
* La planque est obligatoirement dans le même pays que la mission.
* Au moins un agent doit disposer de la spécialité requise pour la mission.

Lors de la création ou modification d'une mission, si ces règles ne sont pas respectées, la mission n'est pas ajoutée ou modifiée en base, et un message d'erreur informe d'ou vient le problème.

![echec](https://github.com/MartinelliSam/Spy_agency/assets/122564923/16db1d2f-0ec6-4d20-9428-5b92906befef)

## Installation en local

### Pré-requis
Avoir installé un logiciel permettant d'initialiser un serveur en local, tel que WAMP ou MAMP.

Avoir installé HeidiSQL (MariaDB).

### Cloner le projet 

Créer un répertoire pour télécharger le projet.

Via le terminal de commandes, se positionner dans ce répertoire et taper : 
```
git clone https://github.com/MartinelliSam/Spy_agency
```

### Préparer l'environnement local

Modifier le fichier index.php à la ligne 7, en remplaçant le nom du dossier par celui dans lequel vous avez téléchargé le projet.
Modifier dans models/Model.php si besoin les informations de connection à la base de données.

### Créer la base de données

Ouvrir le fichier spy_agency.sql, et remplacer à la ligne 456 'User' par l'adresse e-mail que vous souhaitez pour vous connecter.
Remplacer également 'passwordhashé' par le mot de passe de votre choix, après l'avoir hashé avec https://www.bcrypt.fr/.
Charger ensuite le fichier .sql dans HeidiSQL (Fichier -> Charger un fichier SQL), puis faire F9 pour éxecuter la requête.
