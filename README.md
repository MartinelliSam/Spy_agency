# Spy_agency
Site internet permettant la gestion des données d'une agence d'espions.
Projet codé en PHP, sur un modèle MVC, avec création d'un CRUD pour gérer entièrement les enregistrement de la base de données.

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
