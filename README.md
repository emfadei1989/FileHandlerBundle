### Задание
1. Нужно создать библиотеку, которая сможет искать в файле вхождение строки, и выдавать номер строки в файле и позицию в строке. Файл может быть произвольного размера. 
2. Дополнительно:​ ​
​ предусмотреть ограничения (максимальный размер файла, его mime-type, и т.п.). Желательно их вынести в отдельный yaml конфиг. 
3. Дополнительно: покрыть код тестами. 
4. Дополнительно: сделать возможность добавлять механизмы сравнения строки из данных с подстрокой (например, если в некоторых приложениях нужно искать не вхождение, а сравнивать хэш-суммы, и т.п.). 
5. Дополнительно: сделать возможность читать данные не только с локальной файловой системы, но и удаленной.

## Установка

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

