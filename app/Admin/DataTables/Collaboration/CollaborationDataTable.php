<?php

namespace App\Admin\DataTables\Collaboration;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class CollaborationDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'collaborationsTable';

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
        CollaborationRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.collaborations.datatable.id',
            'action' => 'admin.collaborations.datatable.action',
            'user' => 'admin.collaborations.datatable.user',
            'status' => 'admin.collaborations.datatable.status',
            'article' => 'admin.collaborations.datatable.article',
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
        $this->instanceDataTable = datatables()->collection($query)->addIndexColumn();
        //        $this->setCustomRawColumns();
        $this->addColumnAction();
        $this->addColumnId();
        $this->addColumnUser();
        $this->addColumnArticle();
        $this->editColumnStatus();
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
        return $this->repository->getBy([], ['users', 'articles']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->instanceHtml = $this->builder()
            ->setTableId('collaborationsTable')
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
        return $this->customColumns = $this->traitGetConfigDatatableColumns('collaborations'); // Truyền vào tên bảng trong datatable_columns Config
    }

    protected function addColumnAction()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }

    protected function addColumnId()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('id', $this->view['id']);
    }


    protected function addColumnUser()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('user', $this->view['user']);
    }

    protected function editColumnStatus()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', $this->view['status']);
    }


    protected function addColumnArticle()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('article', $this->view['article']);
    }


    protected function rawColumnsNew()
    {
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['id', 'action', 'user', 'article', 'status']);
    }

    protected function htmlParameters()
    {

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#collaborationsTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
            ->parameters($this->parameters);
    }
}
