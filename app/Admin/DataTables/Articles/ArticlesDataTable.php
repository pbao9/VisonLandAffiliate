<?php

namespace App\Admin\DataTables\Articles;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Admin\Traits\GetConfig;
use App\Enums\Article\{ArticleActiveStatus, ArticleStatus, ArticleType, ArticlePriceConsent};
use Carbon\Carbon;

class ArticlesDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'articlesTable';

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
        ArticlesRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.articles.datatable.id',
            'action' => 'admin.articles.datatable.action',
            'status' => 'admin.articles.datatable.status',
            'user_admin' => 'admin.articles.datatable.user_admin'
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
        $query = $this->repository->getAll()->map(function ($article) {

            $article->type = ArticleType::getDescription($article->type);
            $article->status = ArticleStatus::getDescription($article->status);
            $article->price = number_format($article->price) . ' VNĐ';
            $article->area = $article->area . ' m²';
            // $article->price_consent = ArticlePriceConsent::getDescription($article->price_consent);
            if ($article->admin_id && $article->articleAdmin) {
                $article->admin_id = '<x-link :href="' . route('admin.admin.edit', $article->admin_id) . '">' . htmlspecialchars($article->articleAdmin->username) . '</x-link>';
            } else {
                $article->admin_id = '<span class="badge bg-danger-lt">Chưa duyệt</span>';
            }

            if ($article->deployment_time) {
                $article->deployment_time = Carbon::parse($article->deployment_time)->format('d-m-Y H:i:s');
            }

            if ($article->time_start) {
                $article->time_start = Carbon::parse($article->time_start)->format('d-m-Y H:i:s');
            }
            return $article;
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
        return $this->customColumns = $this->traitGetConfigDatatableColumns('articles');
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'active_status' => $this->view['status'],
            'user_admin' => $this->view['user_admin'],
        ];
    }

    // Thiết lập Thêm một cột
    protected function setCustomAddColumns()
    {
        // Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'user_admin' => $this->view['user_admin']
        ];
    }



    // Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
    // Truyền vào là 1 mảng tên các cột
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['id', 'action', 'admin_id', 'active_status', 'user_admin'];
    }
}
