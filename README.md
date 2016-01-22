# ZendComment | Projet Web

### Objectifs
ZendComment est un système de création de livres d'or et de publication de messages dans le cadre du module « Projet Web » de seconde année en DUT Informatique. Ce projet est conjointement réalisé par Aurélien PEPIN et Johan CROCHEMORE.

### Fonctionnalités
ZendComment permet à un utilisateur authentifié :
- d'accéder automatiquement à son livre d'or à la connexion ;
- d'accéder aux livres d'or des autres via un jeu de redirections au bas de la page ;
- de poster des messages dans son livre d'or ou celui des autres ;
- d'éditer ses messages ;
- de supprimer ses messages ;

### Installation
#### Cloner ce projet
Cloner ce projet à partir de : https://github.com/Aurelieen/ZendComment.git

#### Récupérer les tables et les données
L'ensemble des éléments utiles au bon fonctionnement de l'application se trouve dans le fichier SQL *init.sql* à la racine du projet. Ce fichier contient les scripts de création des tables et quelques tuples. Téléchargez le fichier et importez-le dans votre base de données. Trois tables doivent apparaître : utilisateur, message, livre_d_or.

#### Synchroniser le projet et la base de données
Dans le projet cloné, cliquez depuis la racine sur *config*, puis sur *autoload* et mettez à jour les informations de *global.php* et *local.php* pour pouvoir établir une connexion à la base de données avec vos identifiants.

### Jeu de tests
|Pseudonyme|Mot de passe|
|---|---|
|aure|123|
|johan|456|
|david|123|

### Commentaires
Le modèle conceptuel de données fournit en cours reste le même, à ceci près qu'un utilisateur ne peut plus créer autant de livres d'or qu'il le souhaite mais qu'il en possède un par défaut, à l'intérieur duquel lui et les autres peuvent écrire.
