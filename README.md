# Projet test pour le recrutement en tant que Développeur Symfony chez Comwatt
Application contenant un catalogue de livres et une gestion de panier basique ainsi qu'une administration des produits sécurisée.

# Intallation

Il y a deux façon pour installer le projet.

Soit par Makefile :
`sudo make init`
ou alors avec les commandes suivantes :
```
docker-compose up -d --build
docker exec -ti php /bin/bash
```
pour build docker et entrer dans le container puis :
```
composer install
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console app:import all
php bin/console doctrine:fixtures:load --append
yarn dev
```
# Accès

Le front est accessible à l'adresse suivante : http://localhost:3001

Le back est accessible à l'adresse suivante : http://localhost:3001/login
```
id : admin
password : comwatt
```
Adminer est accessible à l'adresse suivante : http://localhost:3003
```
Système : PostgreSQL
Serveur : db
Utilisateur : read
Mot de passe : book
Base de données : app
```

# Stack

 - PHP 8 (Symfony 5.3)
 - Nginx 1.19
 - PostgreSQL 13
 - Adminer 4.8
 - Yarn 1.22
 - Npm 6.14
 - React 17
 - TailwindCSS 2.2.4

