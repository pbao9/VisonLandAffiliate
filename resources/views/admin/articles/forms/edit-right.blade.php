<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('push') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('update')" />
            <x-button.modal-delete data-route="{{ route('admin.articles.delete', $articles->id) }}" :title="__('delete')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <label class="control-label">{{ __('activeStatus') }}:</label>
        </div>
        <div class="card-body p-2">
            <x-select name="active_status" :required="true">
                @foreach ($articleStatus as $key => $value)
                    <x-select-option :value="$key" :title="$value" :selected="$articles->active_status == $key" />
                @endforeach
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('imageGallary') }}
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="image" type="multiple" :value="$articles->image" />
        </div>
    </div>

    @if (!$articles->user_id)
        @if ($articles->admin_id != null || $userRole->value == 2)
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('commission') }}
                </div>
                <div class="card-body p-2 py-2">
                    @foreach ($getCommission as $commission)
                        <label class="form-check d-flex gap-2">
                            <input type="radio" name="commission_id" value="{{ $commission->id }}"
                                {{ $commission->id == $articles->commission_id ? 'checked' : '' }}>
                            <span
                                class="form-check-label">TT-{{ $commission->direct_commission }}GT-{{ $commission->indirect_commission }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @else
            <input type="hidden" name="commission_id" value="0">
        @endif
    @endif

    <div class="card mb-3">
        <div class="card-header">
            {{ __('articleArea') }}:
        </div>
        <div class="card-body p-2 py-2">
            <x-select class="select2-bs5-ajax" name="area_id" :required="true" :data-url="route('admin.search.select.area')">
                <x-select-option :option="$articles->area_id" :value="$articles->area_id" :title="$articles->articleArea->name ?? ''" />
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
            <x-select id="selectArticle" name="houseType_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.houseType')"
                :multiple="true">
                @foreach ($articles->categories as $item)
                    <x-select-option :option="$item->id" :value="$item->id" :title="$item->name ?? ''" />
                @endforeach
            </x-select>
        </div>
        <div class="card-footer">
            <x-link :href="route('admin.houses-type.create')" class="btn btn-primary"><i
                    class="ti ti-plus"></i>{{ __('addHouseType') }}</x-link>
        </div>
    </div>


</div>
