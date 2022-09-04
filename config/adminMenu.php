<?php

return [
    [
        'title' => 'Страницы',
        'route' => 'pages.index',
        'iconClass' => 'nav-icon fas fa-book',
        'submenu' =>
        [
            [
                'title' => 'Все',
                'route' => 'pages.index',
                'iconClass' => 'far fa-circle nav-icon',
            ],
            [
                'title' => 'Создать',
                'route' => 'pages.create',
                'iconClass' => 'far fa-circle nav-icon',
            ]
        ]
    ],
    [
        'title' => 'Направления обменов',
        'route' => 'exchanges.index',
        'iconClass' => 'nav-icon fas fa-exchange-alt',
        'submenu' =>
            [
                [
                    'title' => 'Все',
                    'route' => 'exchanges.index',
                    'iconClass' => 'far fa-circle nav-icon',
                ],
                [
                    'title' => 'Создать',
                    'route' => 'exchanges.create',
                    'iconClass' => 'far fa-circle nav-icon',
                ]
            ]
    ],
    [
        'title' => 'Валюты',
        'route' => 'currency.index',
        'iconClass' => 'nav-icon fas fa-coins',
        'submenu' =>
            [
                [
                    'title' => 'Все',
                    'route' => 'currency.index',
                    'iconClass' => 'far fa-circle nav-icon',
                ],
                [
                    'title' => 'Создать',
                    'route' => 'currency.create',
                    'iconClass' => 'far fa-circle nav-icon',
                ],
                [
                    'title' => 'Курсы валют',
                    'route' => 'adminCoursesList',
                    'iconClass' => 'far fa-circle nav-icon',
                ]
            ]
    ],
    [
        'title' => 'Баннеры',
        'route' => 'banners.index',
        'iconClass' => 'nav-icon fas fa-ad',
        'submenu' =>
            [
                [
                    'title' => 'Все',
                    'route' => 'banners.index',
                    'iconClass' => 'far fa-circle nav-icon',
                ],
                [
                    'title' => 'Создать',
                    'route' => 'banners.create',
                    'iconClass' => 'far fa-circle nav-icon',
                ]
            ]
    ],
    [
    'title' => 'Заявки на обмен',
    'route' => 'orders.index',
    'iconClass' => 'nav-icon fas fa-cart-arrow-down',
    'submenu' =>
        [
            [
                'title' => 'Все',
                'route' => 'orders.index',
                'iconClass' => 'far fa-circle nav-icon',
            ],
//            [
//                'title' => 'Создать',
//                'route' => 'orders.create',
//                'iconClass' => 'far fa-circle nav-icon',
//            ]
        ]
    ],
        [
        'title' => 'Пользователи',
        'route' => 'users.index',
        'iconClass' => 'nav-icon fas fa-users',
        'submenu' =>
        [
            [
                'title' => 'Все',
                'route' => 'users.index',
                'iconClass' => 'far fa-circle nav-icon',
            ]
        ]
    ],
//    [
//        'title' => 'Языки',
//        'route' => 'adminLangs',
//        'iconClass' => 'nav-icon fas fa-cart-arrow-down'
//    ]
];
