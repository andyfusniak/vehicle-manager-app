<?php
return array(
    // database
    'db' => [
        'hostname' => 'localhost',
        'database' => 'serenityleisure',
        'username' => 'root',
        'password' => 'mysql'
    ],
    // time zone
    'system' => [
        'timezones' => [
            'server' => 'UTC',
            'local'  => 'Europe/London'
        ]
    ],
    'serenitylesiure' => [
        'upload_dir' => __DIR__ . '/uploads'
    ],
    'factories' => [
        // Database
        'Pdo' => 'Serenity\Factory\PdoFactory',

        // Mappers
        'Serenity\Mapper\CollectionMapper' => 'Serenity\Factory\CollectionMapperFactory',
        'Serenity\Mapper\ImageMapper'      => 'Serenity\Factory\ImageMapperFactory',
        'Serenity\Mapper\VehicleMapper'    => 'Serenity\Factory\VehicleMapperFactory',

        // Hydrators
        'Serenity\Hydrator\CollectionDbHydrator'   => 'Serenity\Factory\CollectionDbHydratorFactory',
        'Serenity\Hydrator\CollectionFormHydrator' => 'Serenity\Factory\CollectionFormHydratorFactory',
        'Serenity\Hydrator\ImageDbHydrator'        => 'Serenity\Factory\ImageDbHydratorFactory',
        'Serenity\Hydrator\VehicleDbHydrator'      => 'Serenity\Factory\VehicleDbHydratorFactory',
        'Serenity\Hydrator\VehicleFormHydrator'    => 'Serenity\Factory\VehicleFormHydratorFactory',

        // Forms
        'Serenity\Form\CollectionForm'  => 'Serenity\Factory\CollectionFormFactory',
        'Serenity\Form\ImageUploadForm' => 'Serenity\Factory\ImageUploadFormFactory',
        'Serenity\Form\VehicleForm'     => 'Serenity\Factory\VehicleFormFactory',

        // Validators
        'Serenity\Validator\CollectionTagnameTakenValidator' => 'Serenity\Factory\CollectionTagnameTakenValidatorFactory',
        'Serenity\Validator\VehicleUrlTakenValidator'        => 'Serenity\Factory\VehicleUrlTakenValidatorFactory',

        // Services
        'Serenity\Service\CollectionService' => 'Serenity\Factory\CollectionServiceFactory',
        'Serenity\Service\ImageService'      => 'Serenity\Factory\ImageServiceFactory',
        'Serenity\Service\VehicleService'    => 'Serenity\Factory\VehicleServiceFactory',

        // Controllers
        'AddEditVehicleController' => 'Serenity\Factory\AddEditVehicleControllerFactory',
        'CollectionController'     => 'Serenity\Factory\CollectionControllerFactory',
        'ImageUploadController'    => 'Serenity\Factory\ImageUploadControllerFactory',
        'ListVehiclesController'   => 'Serenity\Factory\ListVehiclesControllerFactory'
    ],
    'routes' => [
        'image_upload' => [
            'path'     => '/image-uploader',
            'defaults' => [
                '_controller' => 'ImageUploadController:uploadAction'
            ]
        ],
        'list_vehicles' => [
            'path' => '/list-vehicles',
            'defaults' => [
                '_controller' => 'ListVehiclesController:listAction'
            ]
        ],
        'add_edit_vehicle-add' => [
            'path' => '/add-edit-vehicle',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:addEditAction',
            ]
        ],
        'add_edit_vehicle-edit' => [
            'path' => '/add-edit-vehicle/{vehicle_id}',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:addEditAction',
                'requirements' => [
                    'vehicle_id' => '\d+'
                ]
            ]
        ],
        'collection-add' => [
            'path' => '/add-edit-collection',
            'defaults' => [
                '_controller' => 'CollectionController:addEditAction'
            ]
        ]
    ]
);
