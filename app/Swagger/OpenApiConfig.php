<?php
// app/Swagger/OpenApiConfig.php
namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API Documentation VisonLand Affiliate",
 *     version="2",
 *     description="API này cho phép người dùng đọc thêm về các API được build trong dự án!",
 *     @OA\Contact(
 *         email="pbao.business@gmail.com"
 *     )
 * )
 */
class OpenApiConfig
{
    // Bạn có thể để trống lớp này, chỉ cần khai báo thông tin Swagger.
}
