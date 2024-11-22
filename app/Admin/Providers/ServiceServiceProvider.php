<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Admin\Services\Customers\CustomersServiceInterface' => 'App\Admin\Services\Customers\CustomersService',
        'App\Admin\Services\CustomerRegistrations\CustomerRegistrationsServiceInterface' => 'App\Admin\Services\CustomerRegistrations\CustomerRegistrationsService',
        'App\Admin\Services\SupperAdminSettings\SupperAdminSettingsServiceInterface' => 'App\Admin\Services\SupperAdminSettings\SupperAdminSettingsService',
        'App\Admin\Services\Notification\NotificationServiceInterface' => 'App\Admin\Services\Notification\NotificationService',
        'App\Admin\Services\ContactAdmin\ContactAdminServiceInterface' => 'App\Admin\Services\ContactAdmin\ContactAdminService',
        'App\Admin\Services\Articles\ArticlesServiceInterface' => 'App\Admin\Services\Articles\ArticlesService',
        'App\Admin\Services\Commission\CommissionServiceInterface' => 'App\Admin\Services\Commission\CommissionService',
        'App\Admin\Services\CommissionDetail\CommissionDetailServiceInterface' => 'App\Admin\Services\CommissionDetail\CommissionDetailService',
        'App\Admin\Services\Permission\PermissionServiceInterface' => 'App\Admin\Services\Permission\PermissionService',
        'App\Admin\Services\Module\ModuleServiceInterface' => 'App\Admin\Services\Module\ModuleService',
        'App\Admin\Services\Role\RoleServiceInterface' => 'App\Admin\Services\Role\RoleService',
        'App\Admin\Services\Admin\AdminServiceInterface' => 'App\Admin\Services\Admin\AdminService',
        'App\Admin\Services\User\UserServiceInterface' => 'App\Admin\Services\User\UserService',
        'App\Admin\Services\Category\CategoryServiceInterface' => 'App\Admin\Services\Category\CategoryService',
        'App\Admin\Services\Product\ProductServiceInterface' => 'App\Admin\Services\Product\ProductService',
        'App\Admin\Services\Attribute\AttributeServiceInterface' => 'App\Admin\Services\Attribute\AttributeService',
        'App\Admin\Services\AttributeVariation\AttributeVariationServiceInterface' => 'App\Admin\Services\AttributeVariation\AttributeVariationService',
        'App\Admin\Services\Order\OrderServiceInterface' => 'App\Admin\Services\Order\OrderService',
        'App\Admin\Services\Slider\SliderServiceInterface' => 'App\Admin\Services\Slider\SliderService',
        'App\Admin\Services\Slider\SliderItemServiceInterface' => 'App\Admin\Services\Slider\SliderItemService',
        'App\Admin\Services\Post\PostServiceInterface' => 'App\Admin\Services\Post\PostService',
        'App\Admin\Services\PostCategory\PostCategoryServiceInterface' => 'App\Admin\Services\PostCategory\PostCategoryService',
        'App\Admin\Services\HouseType\HouseTypeServiceInterface' => 'App\Admin\Services\HouseType\HouseTypeService',
        'App\Admin\Services\Area\AreaServiceInterface' => 'App\Admin\Services\Area\AreaService',
        'App\Admin\Services\Collaboration\CollaborationServiceInterface' => 'App\Admin\Services\Collaboration\CollaborationService',

    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->services as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
