# FileHandlerBundle

### Добавляем в composer 

    composer require efa/FileHandlerBundle


### Добавляем бандл в config/bundles.php

    EFA\FileHandlerBundle\FileHandlerBundle::class => ['all' => true]

### Добавляем роут в config/routes.php
    
    fileHandler:
        type: annotation
        resource: '@FileHandlerBundle/Controller/FileController.php'
    
### Кастомизация параметров
Добавляем в папку config/packages файл fileHandler.yaml


    parameters:
        fileHandler_validateParams:
            maxSize: %customSize%
            mime-type: %customType%,%customType%,%customType%

