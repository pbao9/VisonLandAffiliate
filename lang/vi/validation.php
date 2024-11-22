<?php

return [

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute không phải là URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày bằng hoặc sau :date.',
    'alpha' => ':attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'ascii' => ':attribute chỉ được chứa các ký tự ASCII một byte.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày bằng hoặc trước :date.',
    'between' => [
        'array' => ':attribute phải có từ :min đến :max phần tử.',
        'file' => ':attribute phải có kích thước từ :min đến :max kilobytes.',
        'numeric' => ':attribute phải nằm trong khoảng :min và :max.',
        'string' => ':attribute phải có độ dài từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'confirmed' => ':attribute xác nhận không khớp.',
    'current_password' => 'Mật khẩu hiện tại không đúng.',
    'date' => ':attribute không phải là một ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng với :date.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'decimal' => ':attribute phải có :decimal chữ số thập phân.',
    'declined' => ':attribute phải bị từ chối.',
    'declined_if' => ':attribute phải bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'doesnt_end_with' => ':attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => ':attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => ':attribute được chọn không hợp lệ.',
    'exists' => ':attribute được chọn không hợp lệ.',
    'file' => ':attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn :value.',
        'string' => ':attribute phải dài hơn :value ký tự.',
    ],
    'gte' => [
        'array' => ':attribute phải có từ :value phần tử trở lên.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'string' => ':attribute phải dài hơn hoặc bằng :value ký tự.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là một số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lowercase' => ':attribute phải là chữ thường.',
    'lt' => [
        'array' => ':attribute phải có ít hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'string' => ':attribute phải ít hơn :value ký tự.',
    ],
    'lte' => [
        'array' => ':attribute không được có nhiều hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => ':attribute phải ít hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => ':attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được dài hơn :max ký tự.',
    ],
    'max_digits' => ':attribute không được có nhiều hơn :max chữ số.',
    'mimes' => ':attribute phải là tệp loại: :values.',
    'mimetypes' => ':attribute phải là tệp loại: :values.',
    'min' => [
        'array' => ':attribute phải có ít nhất :min phần tử.',
        'file' => ':attribute phải có kích thước ít nhất :min kilobytes.',
        'numeric' => ':attribute phải ít nhất là :min.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'min_digits' => ':attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường :attribute phải bị thiếu.',
    'missing_if' => 'Trường :attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => 'Trường :attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with' => 'Trường :attribute phải bị thiếu khi :values hiện diện.',
    'missing_with_all' => 'Trường :attribute phải bị thiếu khi :values hiện diện.',
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => [
        'letters' => ':attribute phải chứa ít nhất một chữ cái.',
        'mixed' => ':attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => ':attribute phải chứa ít nhất một số.',
        'symbols' => ':attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => ':attribute đã xuất hiện trong rò rỉ dữ liệu. Vui lòng chọn :attribute khác.',
    ],
    'present' => 'Trường :attribute phải hiện diện.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other là một trong :values.',
    'prohibits' => 'Trường :attribute không cho phép :other hiện diện.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường :attribute là bắt buộc khi :other được chấp nhận.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other là một trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi tất cả :values hiện diện.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không hiện diện.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có giá trị nào trong :values hiện diện.',
    'same' => ':attribute và :other phải khớp.',
    'size' => [
        'array' => ':attribute phải chứa :size phần tử.',
        'file' => ':attribute phải có kích thước :size kilobytes.',
        'numeric' => ':attribute phải là :size.',
        'string' => ':attribute phải dài :size ký tự.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => ':attribute phải là một chuỗi ký tự.',
    'timezone' => ':attribute phải là một múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => 'Không thể tải lên :attribute.',
    'uppercase' => ':attribute phải là chữ in hoa.',
    'url' => ':attribute phải là một URL hợp lệ.',
    'ulid' => ':attribute phải là một ULID hợp lệ.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'thông báo tùy chỉnh',
        ],
    ],

    'attributes' => [],

];