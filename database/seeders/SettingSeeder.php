<?php

namespace Database\Seeders;

use App\Enums\Setting\SettingGroup;
use App\Enums\Setting\SettingTypeInput;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('vietnam-map:install');
        //
        DB::table('settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_name' => 'Tên site',
                'plain_value' => 'Site name',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
                //                'desc' => 'Tên của website, shop, app'
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/assets/images/logo.png',
                'type_input' => SettingTypeInput::Image,
                'group' => SettingGroup::General,
                //                'desc' => 'Logo thương hiệu'
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'mevivu@gmail.com',
                'type_input' => SettingTypeInput::Email,
                'group' => SettingGroup::General,
                //                'desc' => 'Email liên hệ'
            ],
            [
                'setting_key' => 'hotline',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0999999999',
                'type_input' => SettingTypeInput::Phone,
                'group' => SettingGroup::General,
                //                'desc' => 'Số điện thoại liên lạc.'
            ],
            [
                'setting_key' => 'address',
                'setting_name' => 'Địa chỉ',
                'plain_value' => '998/42/15 Quang Trung, GV',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
                //                'desc' => 'Địa chỉ liên lạc.'
            ],
            [
                'setting_key' => 'site_accountbank',
                'setting_name' => 'Tài khoản ngân hàng',
                'plain_value' => 'Nguyễn Văn A',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Account,
            ],
            [
                'setting_key' => 'site_transfersyntax',
                'setting_name' => 'Cú pháp chuyển khoản',
                'plain_value' => 'ck-abc',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Account,
            ],
            [
                'setting_key' => 'site_zalo',
                'setting_name' => 'Zalo',
                'plain_value' => '0909099999',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Account,
            ],
            [
                'setting_key' => 'site_hotline',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0909099999',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Account,
            ],
            [
                'setting_key' => 'link_1',
                'setting_name' => 'Link giới thiệu',
                'plain_value' => 'Bạn bè có thể sử dụng link này để chia sẻ, giới thiệu bán tin này cho người thân, bạn bè,...',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Commission,
            ],
            [
                'setting_key' => 'link_2',
                'setting_name' => 'Link của bạn',
                'plain_value' => 'https://abc.link',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Commission,
            ],
            [
                'setting_key' => 'commission_policy_1',
                'setting_name' => 'Chính sách hoa hồng',
                'plain_value' => '-Từ ngày 01/07/2023 mức hoa hồng áp dụng cho mỗi đơn hàng được bay thành công là 5% (chưa bao gồm VAT)
                                   -Trạng thải đơn hàng sẽ được cập nhật hãng tuần',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Commission,
            ],
            [
                'setting_key' => 'commission_policy_2',
                'setting_name' => 'Điều kiện ghi nhận',
                'plain_value' => '- Các bước thực hiện: (1) Khách nhấp vào link aff của MG → (2)
Khách hàng tiền hành trao đổi với admin → (3) Khách tiến hành mua dự án thành công.',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Commission,
            ],
            [
                'setting_key' => 'commission_policy_3',
                'setting_name' => 'Lưu ý khác',
                'plain_value' => '-Nghiêm cấm hành vi spam link trên các niền tâng
-Nghiêm cấm sử dụng link cho các mục đích khác ảnh hưởng đến chế độ, pháp luật, nhà nước,...
-Nếu phát hiện',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::Commission,
            ],
            [
                'setting_key' => 'vip',
                'setting_name' => 'Giá bài đăng Vip',
                'plain_value' => '10000',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
            ],
            [
                'setting_key' => 'default',
                'setting_name' => 'Giá bài đăng Thường',
                'plain_value' => '1000',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
            ]
        ]);
    }
}
