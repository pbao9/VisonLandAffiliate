<?php

namespace App\Api\V1\Services\Auth;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     *
     * @var Illuminate\Http\Request $request
     *
     * @return boolean
     */
    public function update(Request $request);
    /**
     * Xóa
     *
     * @param int $id
     *
     * @return boolean
     */
    public function delete($id);

    public function updateTokenPassword(Request $request);
    public function generateRouteGetPassword($view);
    public function getInstance();
    public function UpdateCCCd(Request $request, $id);
    public function CheckOtp(Request $request);
    public function UpdateInformation(Request $request, $id);
    public function addBank(Request $request);
}
