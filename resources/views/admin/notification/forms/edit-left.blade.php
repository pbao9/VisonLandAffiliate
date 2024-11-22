<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('informationNotification') }}</h2>

        </div>
        <div class="row card-body">
            <!-- user_id -->
            <input type="hidden" name="admin_id" value="{{ $getAdmin->id }}">
            {{-- <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('userCode') }}:</label>
                    <x-select name="user_id" :required="true">
                        <x-select-option value="" :title="__('')" />
                        @foreach ($fullname as $name => $value)
                            <x-select-option :value="$name" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>


            </div> --}}
            {{-- <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('houseType') }}:</label>
                    <x-select id="selecUserId" name="user_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.user')"
                        :multiple="true">
                        @foreach ($field as $item)
                            <x-select-option :option="$item->id" :value="$item->id" :title="$item->name" />
                        @endforeach
                    </x-select>
                </div>
            </div> --}}



            <!-- title -->


            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('title') }} :</label>
                    <x-input name="title" :value="$notification->title" placeholder="{{ __('status') }}" />
                </div>
            </div><!-- content -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('description') }}:</label>
                    <textarea name="content" class="ckeditor visually-hidden">{{ $notification->content }}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>
