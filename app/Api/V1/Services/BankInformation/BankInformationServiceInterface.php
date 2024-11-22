<?php

namespace App\Api\V1\Services\BankInformation;

use Illuminate\Http\Request;

interface BankInformationServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function add(Request $request);
    public function update(Request $request);
    public function delete($id);
}
