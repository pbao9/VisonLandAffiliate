<?php

namespace App\Admin\Http\Controllers\Articles;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Articles\ArticlesRequest;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Admin\Services\Articles\ArticlesServiceInterface;
use App\Admin\DataTables\Articles\ArticlesDataTable;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Repositories\Ward\WardRepositoryInterface;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;
use App\Admin\Repositories\Commission\CommissionRepositoryInterface;
use App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface;
use App\Models\{District, Wards, HouseType, Province};
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Article\{ArticleActiveStatus, ArticlePriceConsent, ArticleStatus, ArticleType, ArticleArticleStatus};
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    protected $repositorySetting;
    protected $repositoryUser;
    protected $repositoryDistrict;
    protected $repositoryWard;
    protected $repositoryProvince;
    protected $repositoryAdmin;
    protected $repositoryCommission;
    protected $repositoryArea;
    protected $repositoryHouseType;

    public function __construct(
        ArticlesRepositoryInterface $repository,
        ArticlesServiceInterface $service,
        AdminRepositoryInterface $repositoryAdmin,
        UserRepositoryInterface $repositoryUser,
        DistrictRepositoryInterface $repositoryDistrict,
        WardRepositoryInterface $repositoryWard,
        CommissionRepositoryInterface $repositoryCommission,
        ProvinceRepositoryInterface $repositoryProvince,
        AreasRepositoryInterface $repositoryArea,
        HouseTypeRepositoryInterface $repositoryHouseType,
        SettingRepositoryInterface $settingRepository
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryAdmin = $repositoryAdmin;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryDistrict = $repositoryDistrict;
        $this->repositoryWard = $repositoryWard;
        $this->repositoryProvince = $repositoryProvince;
        $this->repositoryCommission = $repositoryCommission;
        $this->repositoryArea = $repositoryArea;
        $this->repositoryHouseType = $repositoryHouseType;
        $this->service = $service;
        $this->repositorySetting = $settingRepository;
    }


    public function getView()
    {
        return [
            'index' => 'admin.articles.index',
            'create' => 'admin.articles.create',
            'edit' => 'admin.articles.edit',
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.articles.index',
            'create' => 'admin.articles.create',
            'edit' => 'admin.articles.edit',
            'delete' => 'admin.articles.delete',
        ];
    }
    public function index(ArticlesDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('articles'), route($this->route['index'])),
        ]);
    }



    public function create()
    {
        $getCommission = $this->repositoryCommission->getCommission();
        $getHouseType = $this->repositoryHouseType->getHouseType();
        $selectedCommissionId = 1;
        $repository = $this->repositorySetting;
        $setting = $repository->getAll();
        $Normal = (int) $setting->getValueByKey("default");
        $vip = (int) $setting->getValueByKey("vip");
        $getAuthor = auth()->guard('admin')->check() ? $this->repositoryAdmin->getCurrentAdminID() : auth()->user()->id;
        $getArea = $this->repositoryArea->getArea();
        $province = $this->repository->getProvince();
        ;
        return view(
            $this->view['create'],
            [
                'getHouseType' => $getHouseType,
                'getArea' => $getArea,
                'getAuthor' => $getAuthor,
                'activeStatus' => ArticleActiveStatus::asSelectArray(),
                'articleStatus' => ArticleArticleStatus::asSelectArray(),
                'province' => $province,
                'getCommission' => $getCommission,
                'selectedCommissionId' => $selectedCommissionId,
                'status' => ArticleStatus::asSelectArray(),
                'type' => ArticleType::asSelectArray(),
                'price_consent' => ArticlePriceConsent::asSelectArray(),
                'Vip' => $vip,
                'Normal' => $Normal,
                'breadcrumbs' => $this->crums->add(__('articles'), route($this->route['index']))->add(__('addArticles')),
            ]
        );
    }


    public function store(ArticlesRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $getCommission = $this->repositoryCommission->getCommission();
        $response = $this->repository->findOrFail($id);
        $getArea = $this->repositoryArea->getArea();
        $authorName = $response->admin_id != null ? $response->articleAdmin->username : ($response->articleUser->fullname . ' - ' . $response->articleUser->phone);
        $userRole = '';
        $province = Province::with('district')->get();


        if ($response->user_id !== null && $response->articleUser) {
            $userRole = $response->articleUser->roles;
        }
        $getAuthor = auth()->guard('admin')->check() ? $this->repositoryAdmin->getCurrentAdminID() : auth()->user()->id;
        return view(
            $this->view['edit'],
            [
                'getArea' => $getArea,
                'status' => ArticleStatus::asSelectArray(),
                'type' => ArticleType::asSelectArray(),
                'articleStatus' => ArticleArticleStatus::asSelectArray(),
                'price_consent' => ArticlePriceConsent::asSelectArray(),
                'articles' => $response,
                'getAuthor' => $getAuthor,
                'authorName' => $authorName,
                'getCommission' => $getCommission,
                'userRole' => $userRole,
                'province' => $province,
                'breadcrumbs' => $this->crums->add(__('articles'), route($this->route['index']))->add(__('editArticles')),
            ]
        );
    }

    public function update(ArticlesRequest $request)
    {
        $this->service->update($request);
        return back()->with('success', __('notifySuccess'));
    }

    public function delete($id)
    {
        $this->service->delete($id);
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }

    public function deletePayment($id)
    {

        $admin = Auth::guard('admin')->check();
        if ($admin) {
            $adminUser = Auth::guard('admin')->user();
            $this->service->deletePayment($id, $adminUser->id);
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'));
    }
}
