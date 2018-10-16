# OBIKI-APP-2.0
Application de pharmacie de garde avec symfony4

//Ajouter des bundles pour l'élaboration de l'API
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

//Création du BO
php bin/console make:entity
créer les champs du BO
php bin/console make:crud
(mettre le nom de mon BO )
voir les routes 
php bin/console debug:router

------------------------------------------------------------
//Migration du BO
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate