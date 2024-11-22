<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => []
    ],
    [
        'title' => 'QL Hợp tác',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [],
        'permissions' => ['createCollaboration', 'viewCollaboration', 'updateCollaboration', 'deleteCollaboration'],
        'sub' => [
            [
                'title' => 'DS Hợp tác',
                'routeName' => 'admin.collaborations.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCollaboration'],
            ]
        ]
    ],
    [
        'title' => 'QL Đăng ký dự án',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [],
        'permissions' => ['createCustomerRegistrations', 'viewCustomerRegistrations', 'updateCustomerRegistrations', 'deleteCustomerRegistrations'],
        'sub' => [
            [
                'title' => 'DS đăng ký',
                'routeName' => 'admin.customerRegistration.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCustomerRegistrations'],
            ]
        ]
    ],
    [
        'title' => 'Quản lý thông báo',
        'routeName' => null,
        'icon' => '<i class="ti ti-bell"></i>',
        'roles' => [],
        'permissions' => ['createNotification', 'viewNotification', 'updateNotification', 'deleteNotification'],
        'sub' => [
            [
                'title' => 'Thêm thông báo',
                'routeName' => 'admin.notification.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createNotification'],
            ],
            [
                'title' => 'DS thông báo',
                'routeName' => 'admin.notification.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewNotification'],
            ]
        ]
    ],
    [
        'title' => 'Dự án',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' => ['createArticles', 'viewArticles', 'updateArticles', 'deleteArticles'],
        'sub' => [
            [
                'title' => 'Thêm Dự án',
                'routeName' => 'admin.articles.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createArticles'],
            ],
            [
                'title' => 'DS Dự án',
                'routeName' => 'admin.articles.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewArticles'],
            ]
        ]
    ],
    [
        'title' => 'Thông tin kèm Dự án',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' => ['createHouseTypes', 'viewHouseTypes', 'updateHouseTypes', 'deleteHouseTypes', 'createArea', 'viewArea', 'updateArea', 'deleteArea'],
        'sub' => [
            [
                'title' => 'Thêm loại hình',
                'routeName' => 'admin.houses-type.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createHouseTypes'],
            ],
            [
                'title' => 'DS loại hình',
                'routeName' => 'admin.houses-type.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewHouseTypes'],
            ],
            [
                'title' => 'Thêm khu vực',
                'routeName' => 'admin.areas.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createArea'],
            ],
            [
                'title' => 'DS khu vực',
                'routeName' => 'admin.areas.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewArea'],
            ]
        ]
    ],
    [
        'title' => 'Hoa hồng',
        'routeName' => null,
        'icon' => '<i class="ti ti-brand-cashapp"></i>',
        'roles' => [],
        'permissions' => ['createCommission', 'viewCommission', 'updateCommission', 'deleteCommission'],
        'sub' => [
            [
                'title' => 'Thêm Hoa hồng',
                'routeName' => 'admin.commission.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createCommission'],
            ],
            [
                'title' => 'DS Hoa hồng',
                'routeName' => 'admin.commission.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCommission'],
            ]
        ]
    ],
    [
        'title' => 'DS TV nhận hoa hồng',
        'routeName' => 'admin.commissionDetail.index',
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' => ['createCommission_detail', 'viewCommission_detail', 'updateCommission_detail', 'deleteCommission_detail'],
        'sub' => []
    ],
    [
        'title' => 'Thành viên',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [],
        'permissions' => ['createUser', 'viewUser', 'updateUser', 'deleteUser'],
        'sub' => [
            [
                'title' => 'Thêm thành viên',
                'routeName' => 'admin.user.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createUser'],
            ],
            [
                'title' => 'DS thành viên',
                'routeName' => 'admin.user.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewUser'],
            ],
        ]
    ],
    // [
    //     'title' => 'Sliders',
    //     'routeName' => null,
    //     'icon' => '<i class="ti ti-slideshow"></i>',
    //     'roles' => [],
    //     'permissions' => ['createSlider', 'viewSlider', 'updateSlider', 'deleteSlider'],
    //     'sub' => [
    //         [
    //             'title' => 'Thêm Sliders',
    //             'routeName' => 'admin.slider.create',
    //             'icon' => '<i class="ti ti-plus"></i>',
    //             'roles' => [],
    //             'permissions' => ['createSlider'],
    //         ],
    //         [
    //             'title' => 'DS Sliders',
    //             'routeName' => 'admin.slider.index',
    //             'icon' => '<i class="ti ti-list"></i>',
    //             'roles' => [],
    //             'permissions' => ['viewSlider'],
    //         ],
    //     ]
    // ],
    [
        'title' => 'Vai trò',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-check"></i>',
        'roles' => [],
        'permissions' => ['createRole', 'viewRole', 'updateRole', 'deleteRole'],
        'sub' => [
            [
                'title' => 'Thêm Vai trò',
                'routeName' => 'admin.role.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createRole'],
            ],
            [
                'title' => 'DS Vai trò',
                'routeName' => 'admin.role.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewRole'],
            ]
        ]
    ],
    [
        'title' => 'Admin',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-shield"></i>',
        'roles' => [],
        'permissions' => ['createAdmin', 'viewAdmin', 'updateAdmin', 'deleteAdmin'],
        'sub' => [
            [
                'title' => 'Thêm admin',
                'routeName' => 'admin.admin.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createAdmin'],
            ],
            [
                'title' => 'DS admin',
                'routeName' => 'admin.admin.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewAdmin'],
            ],
        ]
    ],
    [
        'title' => 'Cài đặt',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [],
        'permissions' => ['settingGeneral'],
        'sub' => [
            [
                'title' => 'Chung',
                'routeName' => 'admin.setting.general',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thông tin tài khoản',
                'routeName' => 'admin.setting.account',
                'icon' => '<i class="ti ti-users"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thông tin hoa hồng',
                'routeName' => 'admin.setting.commission',
                'icon' => '<i class="ti ti-brand-cashapp"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],

            //            [
            //                'title' => 'Thành viên mua hàng',
            //                'routeName' => 'admin.setting.user_shopping',
            //                'icon' => '<i class="ti ti-user-cog"></i>',
            //                'roles' => [],
            //                'permissions' => [],
            //            ],
        ]
    ],
    [
        'title' => 'Dev: Quyền',
        'routeName' => null,
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => [
            [
                'title' => 'Thêm Quyền',
                'routeName' => 'admin.permission.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ],
            [
                'title' => 'DS Quyền',
                'routeName' => 'admin.permission.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ]
        ]
    ],
    [
        'title' => 'Dev: Module',
        'routeName' => null,
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => [
            [
                'title' => 'Thêm Module',
                'routeName' => 'admin.module.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ],
            [
                'title' => 'DS Module',
                'routeName' => 'admin.module.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ]
        ]
    ],
    [
        'title' => 'Dev: Nghiệm thu',
        'routeName' => 'admin.module.summary',
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => []
    ]
];
