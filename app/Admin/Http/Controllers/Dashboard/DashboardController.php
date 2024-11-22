<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\CustomerRegistrations;
use App\Models\SupperAdminSettings;
use App\Models\Notification;
use App\Models\ContactAdmin;
use App\Models\Articles;
use App\Models\Commission;
use App\Models\CommissionDetail;


class DashboardController extends Controller
{
    //

    public function getView()
    {
        return [
            'index' => 'admin.dashboard.index'
        ];
    }
    public function index()
    {
        // Đếm số lượng hàng trong bảng dữ liệu 1
        $rowCountCustomers = Customers::count();
        $rowCountCustomerRegistrations = CustomerRegistrations::count();
        // $rowCountSupperAdmin_settings = SupperAdminSettings::count();
        $rowCountNotification = Notification::count();
        $rowCountContact_admin = ContactAdmin::count();
        $rowCountArticles = Articles::count();
        $rowCountCommission = Commission::count();
        $rowCountCommission_detail = CommissionDetail::count();


        return view($this->view['index'], [
            'rowCountCustomers' => $rowCountCustomers,
            'rowCountCustomerRegistrations' => $rowCountCustomerRegistrations,
            // 'rowCountSupperAdmin_settings' => $rowCountSupperAdmin_settings,
            'rowCountNotification' => $rowCountNotification,
            'rowCountContact_admin' => $rowCountContact_admin,
            'rowCountArticles' => $rowCountArticles,
            'rowCountCommission' => $rowCountCommission,
            'rowCountCommission_detail' => $rowCountCommission_detail,

        ]);
    }
}
