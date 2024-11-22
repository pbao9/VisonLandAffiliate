<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Admin\Repositories\Customers\CustomersRepositoryInterface' => 'App\Admin\Repositories\Customers\CustomersRepository',
        'App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface' => 'App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepository',
        'App\Admin\Repositories\SupperAdminSettings\SupperAdminSettingsRepositoryInterface' => 'App\Admin\Repositories\SupperAdminSettings\SupperAdminSettingsRepository',
        'App\Admin\Repositories\Notification\NotificationRepositoryInterface' => 'App\Admin\Repositories\Notification\NotificationRepository',
        'App\Admin\Repositories\ContactAdmin\ContactAdminRepositoryInterface' => 'App\Admin\Repositories\ContactAdmin\ContactAdminRepository',
        'App\Admin\Repositories\Articles\ArticlesRepositoryInterface' => 'App\Admin\Repositories\Articles\ArticlesRepository',
        'App\Admin\Repositories\Commission\CommissionRepositoryInterface' => 'App\Admin\Repositories\Commission\CommissionRepository',
        'App\Admin\Repositories\CommissionDetail\CommissionDetailRepositoryInterface' => 'App\Admin\Repositories\CommissionDetail\CommissionDetailRepository',
        'App\Admin\Repositories\Permission\PermissionRepositoryInterface' => 'App\Admin\Repositories\Permission\PermissionRepository',
        'App\Admin\Repositories\Module\ModuleRepositoryInterface' => 'App\Admin\Repositories\Module\ModuleRepository',
        'App\Admin\Repositories\Role\RoleRepositoryInterface' => 'App\Admin\Repositories\Role\RoleRepository',
        'App\Admin\Repositories\Admin\AdminRepositoryInterface' => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\User\UserRepositoryInterface' => 'App\Admin\Repositories\User\UserRepository',
        'App\Admin\Repositories\Category\CategoryRepositoryInterface' => 'App\Admin\Repositories\Category\CategoryRepository',
        'App\Admin\Repositories\Product\ProductRepositoryInterface' => 'App\Admin\Repositories\Product\ProductRepository',
        'App\Admin\Repositories\Product\ProductAttributeRepositoryInterface' => 'App\Admin\Repositories\Product\ProductAttributeRepository',
        'App\Admin\Repositories\Product\ProductVariationRepositoryInterface' => 'App\Admin\Repositories\Product\ProductVariationRepository',
        'App\Admin\Repositories\Attribute\AttributeRepositoryInterface' => 'App\Admin\Repositories\Attribute\AttributeRepository',
        'App\Admin\Repositories\AttributeVariation\AttributeVariationRepositoryInterface' => 'App\Admin\Repositories\AttributeVariation\AttributeVariationRepository',
        'App\Admin\Repositories\Order\OrderRepositoryInterface' => 'App\Admin\Repositories\Order\OrderRepository',
        'App\Admin\Repositories\Order\OrderDetailRepositoryInterface' => 'App\Admin\Repositories\Order\OrderDetailRepository',
        'App\Admin\Repositories\Slider\SliderRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderRepository',
        'App\Admin\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderItemRepository',
        'App\Admin\Repositories\Setting\SettingRepositoryInterface' => 'App\Admin\Repositories\Setting\SettingRepository',
        'App\Admin\Repositories\Post\PostRepositoryInterface' => 'App\Admin\Repositories\Post\PostRepository',
        'App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Admin\Repositories\PostCategory\PostCategoryRepository',
        'App\Admin\Repositories\District\DistrictRepositoryInterface' => 'App\Admin\Repositories\District\DistrictRepository',
        'App\Admin\Repositories\Province\ProvinceRepositoryInterface' => 'App\Admin\Repositories\Province\ProvinceRepository',
        'App\Admin\Repositories\Ward\WardRepositoryInterface' => 'App\Admin\Repositories\Ward\WardRepository',
        'App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface' => 'App\Admin\Repositories\HouseType\HouseTypeRepository',
        'App\Admin\Repositories\Areas\AreasRepositoryInterface' => 'App\Admin\Repositories\Areas\AreasRepository',
        'App\Admin\Repositories\Broker\BrokerRepositoryInterface' => 'App\Admin\Repositories\Broker\BrokerRepository',
        'App\Admin\Repositories\BankInformation\BankInformationRepositoryInterface' => 'App\Admin\Repositories\BankInformation\BankInformationRepository',
        'App\Admin\Repositories\Collaboration\CollaborationRepositoryInterface' => 'App\Admin\Repositories\Collaboration\CollaborationRepository'

    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implement) {
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
