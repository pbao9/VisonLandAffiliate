<?php

namespace App\Admin\DataTables\CustomerRegistrations;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class CustomerRegistrationsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'customerRegistrationsTable';

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
        CustomerRegistrationsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.customerRegistrations.datatable.id',
            'action' => 'admin.customerRegistrations.datatable.action',
            'user' => 'admin.customerRegistrations.datatable.user',
        ];
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->instanceDataTable = datatables()->eloquent($query)->addIndexColumn();
        //        $this->setCustomRawColumns();
        $this->addColumnAction();
        $this->addColumnId();
        $this->editColumnStatus();
        $this->addColumnArticleTitle();
        $this->addColumnCustomerName();
        $this->editColumnRegistrationDay();
        $this->editColumnApprovalDay();
        // $this->editColumnUser();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
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
        return $this->repository->getQueryBuilderOrderBy();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->instanceHtml = $this->builder()
            ->setTableId('customerRegistrationsTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle();

        $this->htmlParameters();

        return $this->instanceHtml;
    }

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        return $this->customColumns = $this->traitGetConfigDatatableColumns('customerRegistrations'); // Truyền vào tên bảng trong datatable_columns Config
    }

    protected function editColumnStatus()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', function ($customer) {
            return $customer->status->description;
        });
    }

    protected function editColumnRegistrationDay()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('registration_day', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }

    protected function editColumnApprovalDay()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('approval_day', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }

    protected function addColumnAction()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }

    protected function addColumnId()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('id', $this->view['id']);
    }

    protected function addColumnCustomerName()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('customer_name', function ($registration) {
            return $registration ? $registration->fullname : 'N/A';
        });
    }

    protected function addColumnArticleTitle()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('article_id', function ($article) {
            return $article->articles ? '<a href="' . route('admin.articles.edit', $article->articles->id) . '">' . $article->articles->title . '</a>' : 'N/A';
        });
    }

    // protected function editColumnUser()
    // {
    //     $this->instanceDataTable = $this->instanceDataTable->editColumn('customer', $this->view['user']);
    // }


    protected function rawColumnsNew()
    {
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['id', 'action', 'customer_name', 'article_id']);
    }

    protected function htmlParameters()
    {

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#customerRegistrationsTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
            ->parameters($this->parameters);
    }
}
