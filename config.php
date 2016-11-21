<?php
return array(
    // database
    'db' => [
        'hostname' => 'localhost',
        'database' => 'serenity_nuc',
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
        'upload_dir'       => __DIR__ . '/uploads',
        'web_dir'          => __DIR__ . '/public/images/vehicles',
        'web_image_sizes'  => [150, 360, 720]
    ],
    'invokables' => [
        'image'              => 'Vm\View\Helper\Image',
        'vehicletype'        => 'Vm\View\Helper\VehicleType',
        'vehiclefeature'     => 'Vm\View\Helper\VehicleFeature',
        'headmeta'           => 'Vm\View\Helper\HeadMeta',
        'pagelayoutposition' => 'Vm\View\Helper\PageLayoutPosition'
    ],
    'factories' => [
        // Database
        'Pdo' => 'Vm\Factory\PdoFactory',

        // View Helpers (factory)
        'vehicleCategoryNav' => 'Vm\Factory\VehicleCategoryNavFactory',
        'pageNav'            => 'Vm\Factory\PageNavFactory',
        'footerNav'          => 'Vm\Factory\FooterNavFactory',

        // Mappers
        'Vm\Mapper\AdminMapper'      => 'Vm\Factory\AdminMapperFactory',
        'Vm\Mapper\CollectionMapper' => 'Vm\Factory\CollectionMapperFactory',
        'Vm\Mapper\ImageMapper'      => 'Vm\Factory\ImageMapperFactory',
        'Vm\Mapper\PageMapper'       => 'Vm\Factory\PageMapperFactory',
        'Vm\Mapper\VehicleMapper'    => 'Vm\Factory\VehicleMapperFactory',

        // Hydrators
        'Vm\Hydrator\AdminDbHydrator'        => 'Vm\Factory\AdminDbHydratorFactory',
        'Vm\Hydrator\CollectionDbHydrator'   => 'Vm\Factory\CollectionDbHydratorFactory',
        'Vm\Hydrator\CollectionFormHydrator' => 'Vm\Factory\CollectionFormHydratorFactory',
        'Vm\Hydrator\ImageDbHydrator'        => 'Vm\Factory\ImageDbHydratorFactory',
        'Vm\Hydrator\PageDbHydrator'         => 'Vm\Factory\PageDbHydratorFactory',
        'Vm\Hydrator\PageFormHydrator'       => 'Vm\Factory\PageFormHydratorFactory',
        'Vm\Hydrator\VehicleDbHydrator'      => 'Vm\Factory\VehicleDbHydratorFactory',
        'Vm\Hydrator\VehicleFormHydrator'    => 'Vm\Factory\VehicleFormHydratorFactory',

        // Forms
        'Vm\Form\AdminSignInForm'      => 'Vm\Factory\AdminSignInFormFactory',
        'Vm\Form\CollectionForm'       => 'Vm\Factory\CollectionFormFactory',
        'Vm\Form\ImageSelectorForm'    => 'Vm\Factory\ImageSelectorFormFactory',
        'Vm\Form\ImageUploadForm'      => 'Vm\Factory\ImageUploadFormFactory',
        'Vm\Form\MarkdownEditorForm'   => 'Vm\Factory\MarkdownEditorFormFactory',
        'Vm\Form\PageForm'             => 'Vm\Factory\PageFormFactory',
        'Vm\Form\VehicleForm'          => 'Vm\Factory\VehicleFormFactory',
        'Vm\Form\FeaturedVehiclesForm' => 'Vm\Factory\FeaturedVehiclesFormFactory',

        // Validators
        'Vm\Validator\CollectionTagnameTakenValidator' => 'Vm\Factory\CollectionTagnameTakenValidatorFactory',
        'Vm\Validator\NameReferenceValidator'          => 'Vm\Factory\NameReferenceValidatorFactory',
        'Vm\Validator\PageUrlTakenValidator'           => 'Vm\Factory\PageUrlTakenValidatorFactory',
        'Vm\Validator\SlugValidator'                   => 'Vm\Factory\SlugValidatorFactory',
        'Vm\Validator\UsernameValidator'               => 'Vm\Factory\UsernameValidatorFactory',
        'Vm\Validator\VehicleUrlTakenValidator'        => 'Vm\Factory\VehicleUrlTakenValidatorFactory',

        // Services
        'Vm\Service\AuthService'       => 'Vm\Factory\AuthServiceFactory',
        'Vm\Service\CollectionService' => 'Vm\Factory\CollectionServiceFactory',
        'Vm\Service\ImageService'      => 'Vm\Factory\ImageServiceFactory',
        'Vm\Service\PageService'       => 'Vm\Factory\PageServiceFactory',
        'Vm\Service\VehicleService'    => 'Vm\Factory\VehicleServiceFactory',
        'Vm\Service\VmParsedown' => 'Vm\Factory\VmParsedownFactory',

        // Controllers (admin)
        'AddEditVehicleController'   => 'Vm\Factory\AddEditVehicleControllerFactory',
        'AdminSignInController'      => 'Vm\Factory\AdminSignInControllerFactory',
        'CollectionController'       => 'Vm\Factory\CollectionControllerFactory',
        'DashboardController'        => 'Vm\Factory\DashboardControllerFactory',
        'DeleteVehicleController'    => 'Vm\Factory\DeleteVehicleControllerFactory',
        'FeaturedVehiclesController' => 'Vm\Factory\FeaturedVehiclesControllerFactory',
        'ImageUploadController'      => 'Vm\Factory\ImageUploadControllerFactory',
        'ListVehiclesController'     => 'Vm\Factory\ListVehiclesControllerFactory',
        'MarkdownEditorController'   => 'Vm\Factory\MarkdownEditorControllerFactory',
        'PageController'             => 'Vm\Factory\PageControllerFactory',
        'SettingsController'         => 'Vm\Factory\SettingsControllerFactory',
        // Controllers (frontend)
        'FrontEndController'       => 'Vm\Factory\FrontEndControllerFactory',
        'FrontEndHomeController'   => 'Vm\Factory\FrontEndHomeControllerFactory'
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
        'admin_featured_vehicle' => [
            'path' => '/admin/featured-vehicles',
            'defaults' => [
                '_controller' => 'FeaturedVehiclesController:featuredAction'
            ]
        ],
        'admin_markdown_editor' => [
            'path' => '/admin/markdown-editor/edit/{section}/{id}',
            'defaults' => [
                '_controller' => 'MarkdownEditorController:editAction'
            ],
            'requirements' => [
                'section' => '^(vehicle|page)$',
                'id'      => '\d+'
            ]
        ],
        'admin_markdown_editor_post' => [
            'path' => '/admin/markdown-editor/edit/{section}',
            'defaults' => [
                '_controller' => 'MarkdownEditorController:editAction'
            ]
        ],
        'admin_delete_vehicle' => [
            'path' => '/admin/delete-vehicle/{vehicle_id}',
            'defaults' => [
                '_controller' => 'DeleteVehicleController:confirmAction'
            ],
            'requirements' => [
                'vehicle_id' => '\d+'
            ]
        ],
        'admin_delete_vehicle_post' => [
            'path' => '/admin/delete-vehicle',
            'defaults' => [
                '_controller' => 'DeleteVehicleController:deleteAction'
            ]
        ],
        'admin_delete_vehicle_cancel_post' => [
            'path' => '/admin/delete-vehicle-cancel',
            'defaults' => [
                '_controller' => 'DeleteVehicleController:cancelAction'
            ]
        ],
        'admin_markdown_editor_vehicle_selector_ajax' => [
            'path' => '/admin/markdown-editor/collection-image-selector-ajax/{collection_id}',
            'defaults' => [
                '_controller' => 'MarkdownEditorController:collectionImageSelectorAjaxAction'
            ],
            'requirements' => [
                'collection_id' => '\d+'
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
        'admin_collecton_delete' => [
            'path' => '/admin/delete-collection/{collection_id}',
            'defaults' => [
                '_controller' => 'CollectionController:deleteAction'
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
            'path' => '/admin/page-ordering/{layout_position}',
            'defaults' => [
                '_controller' => 'PageController:orderingAction'
            ],
            'requirements' => [
                'layout_position' => '[a-z]+'
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
