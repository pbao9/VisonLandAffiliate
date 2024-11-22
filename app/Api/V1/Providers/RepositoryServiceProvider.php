<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Api\V1\Repositories\Customers\CustomersRepositoryInterface' => 'App\Api\V1\Repositories\Customers\CustomersRepository',
        'App\Api\V1\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface' => 'App\Api\V1\Repositories\CustomerRegistrations\CustomerRegistrationsRepository',
        'App\Api\V1\Repositories\Setting\SettingRepositoryInterface' => 'App\Api\V1\Repositories\Setting\SettingRepository',
        'App\Api\V1\Repositories\Notification\NotificationRepositoryInterface' => 'App\Api\V1\Repositories\Notification\NotificationRepository',
        'App\Api\V1\Repositories\Contact_admin\Contact_adminRepositoryInterface' => 'App\Api\V1\Repositories\Contact_admin\Contact_adminRepository',
        'App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface' => 'App\Api\V1\Repositories\Articles\ArticlesRepository',
        'App\Api\V1\Repositories\Commission\CommissionRepositoryInterface' => 'App\Api\V1\Repositories\Commission\CommissionRepository',
        'App\Api\V1\Repositories\CommissionDetail\CommissionDetailRepositoryInterface' => 'App\Api\V1\Repositories\CommissionDetail\CommissionDetailRepository',

        'App\Api\V1\Repositories\User\UserRepositoryInterface' => 'App\Api\V1\Repositories\User\UserRepository',
        'App\Api\V1\Repositories\Product\ProductRepositoryInterface' => 'App\Api\V1\Repositories\Product\ProductRepository',
        'App\Api\V1\Repositories\Product\ProductVariationRepositoryInterface' => 'App\Api\V1\Repositories\Product\ProductVariationRepository',
        'App\Api\V1\Repositories\Category\CategoryRepositoryInterface' => 'App\Api\V1\Repositories\Category\CategoryRepository',
        'App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface' => 'App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepository',
        'App\Api\V1\Repositories\Order\OrderRepositoryInterface' => 'App\Api\V1\Repositories\Order\OrderRepository',
        'App\Api\V1\Repositories\Order\OrderDetailRepositoryInterface' => 'App\Api\V1\Repositories\Order\OrderDetailRepository',
        'App\Api\V1\Repositories\Slider\SliderRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderRepository',
        'App\Api\V1\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderItemRepository',
        'App\Api\V1\Repositories\Post\PostRepositoryInterface' => 'App\Api\V1\Repositories\Post\PostRepository',
        'App\Api\V1\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Api\V1\Repositories\PostCategory\PostCategoryRepository',
        'App\Api\V1\Repositories\Review\ReviewRepositoryInterface' => 'App\Api\V1\Repositories\Review\ReviewRepository',
        'App\Api\V1\Repositories\HouseType\HouseTypeRepositoryInterface' => 'App\Api\V1\Repositories\HouseType\HouseTypeRepository',
        'App\Api\V1\Repositories\Area\AreaRepositoryInterface' => 'App\Api\V1\Repositories\Area\AreaRepository',
        'App\Api\V1\Repositories\Address\Province\ProvinceRepositoryInterface' => 'App\Api\V1\Repositories\Address\Province\ProvinceRepository',
        'App\Api\V1\Repositories\Address\District\DistrictRepositoryInterface' => 'App\Api\V1\Repositories\Address\District\DistrictRepository',
        'App\Api\V1\Repositories\Address\Ward\WardRepositoryInterface' => 'App\Api\V1\Repositories\Address\Ward\WardRepository',
        'App\Api\V1\Repositories\Collaboration\CollaborationRepositoryInterface' => 'App\Api\V1\Repositories\Collaboration\CollaborationRepository',
        'App\Api\V1\Repositories\BankInformation\BankInformationRepositoryInterface' => 'App\Api\V1\Repositories\BankInformation\BankInformationRepository',
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
