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
    'serenityleisure' => [
        'upload_dir' => __DIR__ . '/uploads',
        'web_dir'    => __DIR__ . '/public/images/vehicles'
    ],
    'invokables' => [
        'image'       => 'Serenity\View\Helper\Image',
        'vehicletype' => 'Serenity\View\Helper\VehicleType',
        'headmeta'    => 'Serenity\View\Helper\HeadMeta'
    ],
    'factories' => [
        // Database
        'Pdo' => 'Serenity\Factory\PdoFactory',

        // View Helpers (factory)
        'vehicleCategoryNav' => 'Serenity\Factory\VehicleCategoryNavFactory',
        'pageNav'            => 'Serenity\Factory\PageNavFactory',

        // Mappers
        'Serenity\Mapper\AdminMapper'      => 'Serenity\Factory\AdminMapperFactory',
        'Serenity\Mapper\CollectionMapper' => 'Serenity\Factory\CollectionMapperFactory',
        'Serenity\Mapper\ImageMapper'      => 'Serenity\Factory\ImageMapperFactory',
        'Serenity\Mapper\PageMapper'       => 'Serenity\Factory\PageMapperFactory',
        'Serenity\Mapper\VehicleMapper'    => 'Serenity\Factory\VehicleMapperFactory',

        // Hydrators
        'Serenity\Hydrator\AdminDbHydrator'        => 'Serenity\Factory\AdminDbHydratorFactory',
        'Serenity\Hydrator\CollectionDbHydrator'   => 'Serenity\Factory\CollectionDbHydratorFactory',
        'Serenity\Hydrator\CollectionFormHydrator' => 'Serenity\Factory\CollectionFormHydratorFactory',
        'Serenity\Hydrator\ImageDbHydrator'        => 'Serenity\Factory\ImageDbHydratorFactory',
        'Serenity\Hydrator\PageDbHydrator'         => 'Serenity\Factory\PageDbHydratorFactory',
        'Serenity\Hydrator\PageFormHydrator'       => 'Serenity\Factory\PageFormHydratorFactory',
        'Serenity\Hydrator\VehicleDbHydrator'      => 'Serenity\Factory\VehicleDbHydratorFactory',
        'Serenity\Hydrator\VehicleFormHydrator'    => 'Serenity\Factory\VehicleFormHydratorFactory',

        // Forms
        'Serenity\Form\AdminSignInForm' => 'Serenity\Factory\AdminSignInFormFactory',
        'Serenity\Form\CollectionForm'  => 'Serenity\Factory\CollectionFormFactory',
        'Serenity\Form\ImageUploadForm' => 'Serenity\Factory\ImageUploadFormFactory',
        'Serenity\Form\PageForm'        => 'Serenity\Factory\PageFormFactory',
        'Serenity\Form\VehicleForm'     => 'Serenity\Factory\VehicleFormFactory',

        // Validators
        'Serenity\Validator\CollectionTagnameTakenValidator' => 'Serenity\Factory\CollectionTagnameTakenValidatorFactory',
        'Serenity\Validator\NameReferenceValidator'          => 'Serenity\Factory\NameReferenceValidatorFactory',
        'Serenity\Validator\PageUrlTakenValidator'           => 'Serenity\Factory\PageUrlTakenValidatorFactory',
        'Serenity\Validator\SlugValidator'                   => 'Serenity\Factory\SlugValidatorFactory',
        'Serenity\Validator\UsernameValidator'               => 'Serenity\Factory\UsernameValidatorFactory',
        'Serenity\Validator\VehicleUrlTakenValidator'        => 'Serenity\Factory\VehicleUrlTakenValidatorFactory',

        // Services
        'Serenity\Service\AuthService'       => 'Serenity\Factory\AuthServiceFactory',
        'Serenity\Service\CollectionService' => 'Serenity\Factory\CollectionServiceFactory',
        'Serenity\Service\ImageService'      => 'Serenity\Factory\ImageServiceFactory',
        'Serenity\Service\PageService'       => 'Serenity\Factory\PageServiceFactory',
        'Serenity\Service\VehicleService'    => 'Serenity\Factory\VehicleServiceFactory',

        // Controllers (admin)
        'AddEditVehicleController' => 'Serenity\Factory\AddEditVehicleControllerFactory',
        'AdminSignInController'    => 'Serenity\Factory\AdminSignInControllerFactory',
        'CollectionController'     => 'Serenity\Factory\CollectionControllerFactory',
        'DashboardController'      => 'Serenity\Factory\DashboardControllerFactory',
        'ImageUploadController'    => 'Serenity\Factory\ImageUploadControllerFactory',
        'ListVehiclesController'   => 'Serenity\Factory\ListVehiclesControllerFactory',
        'PageController'           => 'Serenity\Factory\PageControllerFactory',
        'SettingsController'       => 'Serenity\Factory\SettingsControllerFactory',
        // Controllers (frontend)
        'FrontEndController'       => 'Serenity\Factory\FrontEndControllerFactory',
        'FrontEndHomeController'   => 'Serenity\Factory\FrontEndHomeControllerFactory'
    ],
    'routes' => [
        'admin_dashboard' => [
            'path' => '/admin',
            'defaults' => [
                '_controller' => 'DashboardController:indexAction'
            ]
        ],
        'admin_image_uploader' => [
            'path'     => '/admin/image-uploader',
            'defaults' => [
                '_controller' => 'ImageUploadController:uploadAction'
            ]
        ],
        'admin_upload_to_collection' => [
            'path' => '/admin/image-uploader/{collection_id}',
            'defaults' => [
                '_controller' => 'ImageUploadController:uploadAction'
            ],
            'requirements' => [
                'collection_id' => '\d+'
            ]
        ],
        'admin_list_vehicles' => [
            'path' => '/admin/list-vehicles',
            'defaults' => [
                '_controller' => 'ListVehiclesController:listAction'
            ]
        ],
        'admin_add_edit_vehicle_add' => [
            'path' => '/admin/add-edit-vehicle',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:addAction',
            ]
        ],
        'admin_add_edit_vehicle_edit' => [
            'path' => '/admin/add-edit-vehicle/{vehicle_id}',
            'defaults' => [
                '_controller' => 'AddEditVehicleController:editAction'
            ],
            'requirements' => [
                'vehicle_id' => '\d+'
            ]
        ],
        'admin_collection_add' => [
            'path' => '/admin/add-edit-collection',
            'defaults' => [
                '_controller' => 'CollectionController:addEditAction'
            ]
        ],
        'admin_collection_list' => [
            'path' => '/admin/list-collections',
            'defaults' => [
                '_controller' => 'CollectionController:listAction'
            ]
        ],
        'admin_collection_view' => [
            'path' => '/admin/view-collection/{collection_id}',
            'defaults' => [
                '_controller' => 'CollectionController:viewAction'
            ],
            'requirements' => [
                'collection_id' => '\d+'
            ]
        ],
        'admin_page_view' => [
            'path' => '/admin/list-pages',
            'defaults' => [
                '_controller' => 'PageController:listAction'
            ]
        ],
        'admin_page_add' => [
            'path' => '/admin/add-page',
            'defaults' => [
                '_controller' => 'PageController:addAction'
            ]
        ],
        'admin_page_edit' => [
            'path' => '/admin/edit-page/{page_id}',
            'defaults' => [
                '_controller' => 'PageController:editAction'
            ],
            'requirements' => [
                'page_id' => '\d+'
            ]
        ],
        'admin_page_delete' => [
            'path' => '/admin/delete-page/{page_id}',
            'defaults' => [
                '_controller' => 'PageController:deleteAction'
            ],
            'requirements' => [
                'page_id' => '\d+'
            ]
        ],
        'admin_page_ordering' => [
            'path' => '/admin/page-ordering',
            'defaults' => [
                '_controller' => 'PageController:orderingAction'
            ]
        ],
        'admin_settings_overview' => [
            'path'     => '/admin/settings',
            'defaults' => [
                '_controller' => 'SettingsController:overviewAction'
            ]
        ],
        'admin_sign_in' => [
            'path'     => '/admin/sign-in',
            'defaults' => [
                '_controller' => 'AdminSignInController:authAction'
            ]
        ],
        'admin_sign_in_failed' => [
            'path' => '/admin/sign-in-failed',
            'defaults' => [
                '_controller' => 'AdminSignInController:failedAction'
            ]
        ],
        'admin_sign_out' => [
            'path' => '/admin/sign-out',
            'defaults' => [
                '_controller' => 'AdminSignInController:signOutAction'
            ]
        ],
        'admin_create_admin_temp' => [
            'path' => '/admin/create-user',
            'defaults' => [
                '_controller' => 'AdminSignInController:createAdminAction'
            ]
        ],
        'frontend_home' => [
            'path' => '/',
            'defaults' => [
                '_controller' => 'FrontEndHomeController:indexAction'
            ]
        ],
        'frontend_display' => [
            'path'     => '/{url}',
            'defaults' => [
                '_controller' => 'FrontEndController:displayAction'
            ]
        ]
    ]
);
