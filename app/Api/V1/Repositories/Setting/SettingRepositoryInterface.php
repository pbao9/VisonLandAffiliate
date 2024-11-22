<?php

namespace App\Api\V1\Repositories\Setting;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface SettingRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function delete($id);
    public function getValueByKey($key);
    public function getAllBySettingGroup($settingGroup);
}
