<?php

namespace App\Admin\DataTables\Notification;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Traits\GetConfig;
use App\Enums\Notification\NotificationEnum;

class NotificationDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'notificationTable';

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
        NotificationRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.notification.datatable.id',
            'action' => 'admin.notification.datatable.action',
            'article' => 'admin.notification.datatable.article',
            'user' => 'admin.notification.datatable.user'
        ];
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     * Hàm thực thi gọi lệnh truy xuất từ Database ( Repository )
     */

    public function dataTable($query)
    {
        $this->instanceDataTable = datatables()->collection($query);
        $this->editColumnStatus();
        $this->editColumnUsername();
        $this->editColumnArticle();
        $this->editColumnAdmin();
        $this->addColumnAction();
        $this->addColumnUser();
        $this->editColumnCreatedAt();
        $this->rawColumns();
        return $this->instanceDataTable;
    }

    public function query()
    {
        $query = $this->repository->getBy([], ['article']);
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
        return $this->customColumns = $this->traitGetConfigDatatableColumns('notification'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'user' => $this->view['user'],
            'created_at' => '{{ format_date($created_at) }}',
        ];
    }

    // Thiết lập Thêm một cột
    protected function setCustomAddColumns()
    {
        // Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'user' => $this->view['user']
        ];
    }


    // Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
    // Truyền vào là 1 mảng tên các cột
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['id', 'action', 'content', 'user'];
    }
    protected function rawColumns()
    {
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['id', 'user_id', 'action', 'admin_id', 'content', 'article_id', 'user']);
    }
    protected function editColumnUsername()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('user_id', function ($notification) {
            $username = optional($notification->user)->username; // Lấy username từ user
            $userId = optional($notification->user)->id; // Lấy user_id từ user
            return '<a href="' . route('admin.user.edit', $userId ?? 'Khách vãng lai') . '">' . $username . '</a>';
        });
    }
    protected function editColumnAdmin()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('admin_id', function ($notification) {
            $username = optional($notification->admin)->username; // Lấy user_id từ user
            return $username;
        });
    }
    protected function editColumnStatus()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', function ($admin) {
            return $admin->status->description;
        });
    }
    protected function editColumnArticle()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('article_id', function ($admin) {
            return '<a href="' . route('admin.articles.edit', $admin->article_id ?? '') . '">' . ($admin->article->title ?? '') . '</a>';
        });
    }

    protected function addColumnUser()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('user', function ($notification) {
            return view($this->getView()['user'], ['noti' => $notification]);
        });
    }

    protected function addColumnAction()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function filterColumnCreatedAt()
    {
        $this->instanceDataTable = $this->instanceDataTable->filterColumn('created_at', function ($query, $keyword) {
            $query->whereDate('created_at', date('Y-m-d', strtotime($keyword)));
        });
    }
    protected function editColumnCreatedAt()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
}
