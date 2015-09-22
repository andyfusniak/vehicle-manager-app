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
        'Pdo'                                   => 'Serenity\Factory\PdoFactory',
        'Serenity\Mapper\ImageMapper'           => 'Serenity\Factory\ImageMapperFactory',
        'Serenity\Mapper\VehicleMapper'         => 'Serenity\Factory\VehicleMapperFactory',
        'Serenity\Hydrator\ImageDbHydrator'     => 'Serenity\Factory\ImageDbHydratorFactory',
        'Serenity\Hydrator\VehicleDbHydrator'   => 'Serenity\Factory\VehicleDbHydratorFactory',
        'Serenity\Hydrator\VehicleFormHydrator' => 'Serenity\Factory\VehicleFormHydratorFactory',
        'Serenity\Form\ImageUploadForm'         => 'Serenity\Factory\ImageUploadFormFactory',
        'Serenity\Form\VehicleForm'             => 'Serenity\Factory\VehicleFormFactory',
        'Serenity\Service\ImageService'         => 'Serenity\Factory\ImageServiceFactory',
        'Serenity\Service\VehicleService'       => 'Serenity\Factory\VehicleServiceFactory',

        // Controllers
        'ImageUploadController'    => 'Serenity\Factory\ImageUploadControllerFactory',
        'AddEditVehicleController' => 'Serenity\Factory\AddEditVehicleControllerFactory'
    ],
    'routes' => [
        'image_upload' => [
            'path'     => '/image-uploader',
            'defaults' => [
                '_controller' => 'ImageUploadController:uploadAction'
            ]
        ],
        'add_edit_vehicle1' => [
            'path' => '/add-edit-vehicle',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:addEditAction',
            ]
        ],
        'add_edit_vehicle2' => [
            'path' => '/add-edit-vehicle/{vehicle_id}',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:addEditAction',
                'requirements' => [
                    'vehicle_id' => '\d+'
                ]
            ]
        ]
    ]
);
