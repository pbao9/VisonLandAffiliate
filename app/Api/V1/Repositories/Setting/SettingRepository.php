<?php

namespace App\Api\V1\Repositories\Setting;
// use App\Admin\Repositories\SupperAdmin_settings\SupperAdmin_settingsRepository as AdminSupperAdmin_settingsRepository;

use App\Admin\Repositories\Setting\SettingRepository as SettingSettingRepository;
use App\Api\V1\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository extends SettingSettingRepository implements SettingRepositoryInterface
{
    public function getModel()
    {
        return Setting::class;
    }

    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();
        return $this->instance;
    }
    public function delete($id)
    {
        try {
            Setting::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
