<?php

namespace App\Admin\DataTables\CommissionDetail;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;
use App\Admin\Traits\GetConfig;
use App\Enums\CommissionDetail\CommissionDetailStatus;

class CommissionDetailDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'commission_detailTable';

    /**
     * Available button actions. When calling an action, the value will be used
     * as the function name (so it should be available)
     * If you want to add or disable an action, overload and modify this property.
     *
     * @var array
     */
    // protected array $actions = ['pageLength', 'excel', 'reset', 'reload'];
    protected array $actions = ['reset', 'reload'];

    public function __construct(
        CommissionDetailRepositoryInterface $repository
    ) {
        parent::__construct();
        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.commissionDetail.datatable.id',
            'action' => 'admin.commissionDetail.datatable.action',
          
        ];
    }

  


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     * Hàm thực thi gọi lệnh truy xuất từ Database ( Repository )
     */
    public function query()
    {
        $query = $this->repository->getAll()->map(function ($commissionDetail) {
            $commissionDetail->status = CommissionDetailStatus::getDescription($commissionDetail->status);
            $commissionDetail->user_id = $commissionDetail->getUser->username;

            return $commissionDetail;
        });
        return $query;
    }
    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('commission_detail'); // Truyền vào tên bảng trong datatable_columns Config
    }

    protected function editColumnStatus(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', function($customerrr){
            return $customerrr->status->description;
        });
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'total_amount' => '{{ number_format($total_amount) }}',
            'amount_paid' => '{{ number_format($amount_paid) }}',
            'amount_percent' => '{{ $amount_percent }}%',
        ];
    }

    // Thiết lập Thêm một cột
    protected function setCustomAddColumns()
    {
        // Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    // protected function editColumnStatus(){
    //     $this->instanceDataTable = $this->instanceDataTable->editColumn('status', function($commissionStatus){
    //         return $commissionStatus->status->description;
    //     });
    // }


    // Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
    // Truyền vào là 1 mảng tên các cột
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['id', 'action'];
    }
   
}