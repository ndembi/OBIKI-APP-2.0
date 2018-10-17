# OBIKI-APP-2.0

# Application de pharmacie de garde avec symfony4
------------------------------------------------------------------
# Création du squelette de l'application
composer create-project symfony/skeleton name_api;
cd name_api/
------------------------------------------------------------------
# Ajouter des bundles nécessaires à l'élaboration de l'API
composer create-project symfony/skeleton (API-...)
composer require make
composer require form
composer require orm
composer require twig
composer require validator
composer require security-csrf annotations
composer require web-server-bundle
composer require jms/serializer-bundle
composer require friendsofsymfony/rest-bundle
------------------------------------------------------------------------
# Création du BO
php bin/console make:entity (nom du Bo -> type du Bo -> longueur du Bo)
-----------------------------------------------------------------------
# Migration du BO dans la BDD
<<<<<<< HEAD
php bin/console doctrine:database:create (si la database n'existe pas)
php bin/console doctrine:schema:update --force (si la database existe déjà, ajouter la table)
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
=======
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
>>>>>>> 7486a5ac8fc4219025f6b64837a16b67729224c3
-------------------------------------------------------------------------
# Générer les differentes actions sur notre objet
php bin/console make:crud
--------------------------------------------------------------------------
# voir les routes
<<<<<<< HEAD
php bin/console debug:router
=======
php bin/console debug:router
>>>>>>> 7486a5ac8fc4219025f6b64837a16b67729224c3
