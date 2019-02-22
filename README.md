# FileHandlerBundle

1. Добавляем в composer 

composer require efa/FileHandlerBundle

2. Добавляем бандл в config/bundles.php

EFA\FileHandlerBundle\FileHandlerBundle::class => ['all' => true]

3. Добавляем роут в config/routes.php

fileHandler:

    type: annotation
    resource: '@FileHandlerBundle/Controller/FileController.php'
