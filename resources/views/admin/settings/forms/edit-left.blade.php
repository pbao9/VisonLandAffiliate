<div class="card h-100">
    <div class="card-header justify-content-center">
        <h2 class="mb-0">{{ $title ?? __('informationSetting') }}</h2>
    </div>
    <div class="row card-body wrap-loop-input">
        @foreach ($settings as $index => $setting)
            <div class="col-12">
                <div class="mb-3 px-3">
                    <label for="setting_{{ $setting->setting_key }}">{{ $setting->setting_name }}</label>
                    @if (strpos($setting->setting_key, 'commission_policy_') !== false)
                        @if ($index >= 1 && $index <= 10)
                            <x-textarea class="ckeditor visually-hidden" :name="$setting->setting_key" class="ckeditor">
                                {!! $setting->plain_value ?? '' !!}
                            </x-textarea>
                        @endif
                    @else
                        <x-dynamic-component :component="$setting->getNameComponentTypeInput()" :name="$setting->setting_key" :value="$setting->plain_value"
                                             showImage="{{ $setting->setting_key }}" :required="false" :placeholder="$setting->setting_name" />
                    @endif
                </div>
            </div>
        @endforeach



    </div>
</div>


