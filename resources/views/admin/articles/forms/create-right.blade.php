<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('push') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('add')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('imageGallary') }}
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="image" type="multiple" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('commission') }}
        </div>
        <div class="card-body p-2 py-2">
            @foreach ($getCommission as $commission)
                <label class="form-check d-flex gap-2">
                    <input type="radio" name="commission_id" value="{{ $commission->id }}"
                        {{ $commission->id == $selectedCommissionId ? 'checked' : '' }}>
                    <span class="form-check-label">TT - {{ $commission->direct_commission }} GT -
                        {{ $commission->indirect_commission }}</span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Thông tin thời gian') }}
        </div>
        <div class="card-body p-3">

            <div class="mb-3">
                <label for="article-price" class="form-label">{{ __('Giá tiền bài đăng') }}:</label>
                <x-input type="number" name="price" id="article-price" class="form-control" readonly
                    placeholder="Giá tiền đăng bài" />
            </div>

            <!-- active_days -->
            <div class="mb-3">

                <label class="control-label">{{ __('activeDays') }} :</label>
                <x-input type="number" name="active_days" id="DayArticle" :value="old('active_days')"
                    placeholder="{{ __('activeDays') }}" />

            </div>
            <!-- time_start -->
            <div class="mb-3">
                <label class="control-label">{{ __('timeStart') }} :</label>
                <x-input type="date" name="time_start" placeholder="{{ __('timeStart') }}" />
            </div>
            <div class="mb-3">
                <label for="article-status" class="form-label">{{ __('TypeArticle') }}:</label>
                <x-select class="select2-bs5" name="status" id="article-status" :required="true">
                    @foreach ($status as $key => $item)
                        <x-select-option :value="$key" :title="$item" />
                    @endforeach
                </x-select>
            </div>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('articleArea') }}:
        </div>
        <div class="card-body p-2 py-2">
            <x-select class="select2-bs5-ajax" name="area_id" :required="true" :data-url="route('admin.search.select.area')">
            </x-select>
        </div>

        <div class="card-footer">
            <x-link :href="route('admin.areas.create')" class="btn btn-primary"><i class="ti ti-plus"></i>{{ __('addArea') }}</x-link>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('houseType') }}:
        </div>
        <div class="card-body p-2">
            <x-select name="houseType_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.houseType')" multiple></x-select>
        </div>
        <div class="card-footer">
            <x-link :href="route('admin.houses-type.create')" class="btn btn-primary"><i
                    class="ti ti-plus"></i>{{ __('addHouseType') }}</x-link>
        </div>

    </div>
</div>
