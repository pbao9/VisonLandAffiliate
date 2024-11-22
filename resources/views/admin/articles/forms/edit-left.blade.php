<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between align-items-center">
            <h2 class="mb-0">{{ __('informationArticles') }}</h2>
            @if (!$articles->user_id)
                <x-link :href="route('admin.articles.customer-article.article', $articles->id)" :title="__('Danh sách khách hàng đăng ký')" />
            @endif
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-dashboard" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                role="tab">{{ __('Thông tin') }}</a>
                        </li>
                        @if ($articles->payment)
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-payment" class="nav-link position-relative" data-bs-toggle="tab"
                                    aria-selected="false" role="tab" tabindex="-1">
                                    {{ __('Thanh toán') }}
                                    <span class="badge bg-red badge-notification badge-blink mx-2"></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tabs-dashboard" role="tabpanel">
                            <div class="row card-body">
                                <!-- user_id -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('articleAuthor') }}:</label>
                                        <label>{{ $authorName }}</label>
                                        <x-hidden-input name="id" value="{{ $articles->id }}" />
                                    </div>
                                </div>
                                <!-- title -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('title') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input name="title" :value="$articles->title" :required="true"
                                            placeholder="{{ __('title') }}" />
                                    </div>
                                </div>


                                <!-- type -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('type') }}:</label>
                                        <x-select class="select2-bs5" name="type" :required="true">
                                            @foreach ($type as $key => $item)
                                                <x-select-option :value="$key" :title="$item"
                                                    :selected="$key == $articles->type" />
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <!-- area -->

                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('area') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input name="area" value="{{ $articles->area }}" :required="true"
                                            placeholder="{{ __('area') }}" class="form-control" />
                                    </div>
                                </div>

                                <!-- price -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('price') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input type="text" name="price_level" :value="$articles->price_level" :required="true"
                                            placeholder="{{ __('price') }}" />
                                    </div>
                                </div><!-- price_consent -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">

                                        <label class="control-label">{{ __('priceConsent') }}:</label>
                                        <x-select class="select2-bs5" name="price_consent" :required="true">
                                            @foreach ($price_consent as $key => $item)
                                                <x-select-option :value="$key" :title="$item"
                                                    :selected="$key == $articles->price_consent" />
                                            @endforeach
                                        </x-select>

                                    </div>
                                </div>
                                <!-- quantity -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('quantity') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input type="number" name="quantity" :value="$articles->quantity" :required="true"
                                            placeholder="{{ __('quantity') }}" />
                                    </div>
                                </div><!-- height_floor -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('heightFloor') }} :</label>
                                        <x-input type="number" name="height_floor" :value="$articles->height_floor"
                                            placeholder="{{ __('heightFloor') }}" />
                                    </div>
                                </div><!-- project_size -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('projectSize') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input type="number" name="project_size" :value="$articles->project_size"
                                            :required="true" placeholder="{{ __('projectSize') }}" />
                                    </div>
                                </div>

                                <!-- building_density -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('buildingDensity') }} :</label>
                                        <x-input name="building_density" :value="$articles->building_density"
                                            placeholder="{{ __('buildingDensity') }}" />
                                    </div>
                                </div>
                                <!-- investor -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('investor') }} :</label>
                                        <x-input name="investor" :value="$articles->investor"
                                            placeholder="{{ __('investor') }}" />
                                    </div>
                                </div><!-- constructor -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('contructor') }} :</label>
                                        <x-input name="constructor" :value="$articles->constructor"
                                            placeholder="{{ __('contructor') }}" />
                                    </div>
                                </div><!-- hand_over -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('handOver') }} :</label>
                                        <x-input name="hand_over" :value="$articles->hand_over"
                                            placeholder="{{ __('handOver') }}" />
                                    </div>
                                </div>

                                <!-- operative_management -->
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('operativeManagent') }} :</label>
                                        <x-input name="operative_management" :value="$articles->operative_management"
                                            placeholder="{{ __('operativeManagent') }}" />
                                    </div>
                                </div>
                                <!-- deployment_time -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('deploymentTime') }} :</label>
                                        <x-input type="datetime-local" name="deployment_time" :value="$articles->deployment_time"
                                            placeholder="{{ __('deploymentTime') }}" />
                                    </div>
                                </div>
                                <!-- time_start -->
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('timeStart') }} :</label>
                                        <x-input type="datetime-local" name="time_start" :value="$articles->time_start"
                                            placeholder="{{ __('timeStart') }}" />
                                    </div>
                                </div>
                                <!-- name_contact -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('nameContact') }} :</label>
                                        <x-input name="name_contact" :value="$articles->name_contact"
                                            placeholder="{{ __('nameContact') }}" />
                                    </div>
                                </div><!-- phone_contact -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('phoneContact') }} <span
                                                style="color:red;">*</span>:</label>
                                        <x-input type="number" name="phone_contact" :value="$articles->phone_contact"
                                            :required="true" placeholder="{{ __('phoneContact') }}" />
                                    </div>
                                </div><!-- status -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('status') }}:</label>
                                        <x-select class="select2-bs5" name="status" :required="true">
                                            @foreach ($status as $key => $item)
                                                <x-select-option :value="$key" :title="$item"
                                                    :selected="$key == $articles->status" />
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <!-- active_days -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('activeDays') }} :</label>
                                        <x-input type="number" name="active_days" :value="$articles->active_days"
                                            placeholder="{{ __('activeDays') }}" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="mb-3">
                                                <label for="">{{ __('Tỉnh/Thành phố') }}</label>
                                                <x-select name="province_id" id="province_id"
                                                    class="select2-bs5-ajax"
                                                    data-url="{{ route('admin.search.select.province') }}"
                                                    :required="true">
                                                    <x-select-option :option="$articles->province_id" :value="$articles->province_id"
                                                        :title="$articles->articleProvince->name" />
                                                </x-select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="mb-3">
                                                <label for="">{{ __('Quận/Huyện') }}</label>
                                                <x-select name="district_id" id="district_id"
                                                    class="select2-bs5-ajax" data-url="" :required="true">
                                                    <x-select-option :option="$articles->district_id" :value="$articles->district_id"
                                                        :title="$articles->articleDistrict->name" />
                                                </x-select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="mb-3">
                                                <label for="">{{ __('Phường/Xã') }}</label>
                                                <x-select name="ward_id" id="ward_id" class="select2-bs5-ajax"
                                                    data-url="" :required="true">
                                                    <x-select-option :option="$articles->ward_id" :value="$articles->ward_id"
                                                        :title="$articles->articleWard->name" />
                                                </x-select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- description -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('description') }} :</label>
                                        <x-textarea name="description"
                                            class="ckeditor visually-hidden">{{ $articles->description }}</x-textarea>
                                    </div>
                                </div>
                                <!-- utilities -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label">{{ __('utilities') }} :</label>
                                        <x-textarea name="utilities"
                                            class="ckeditor visually-hidden">{{ $articles->utilities }}</x-textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="tabs-payment" role="tabpanel">
                            @include('admin.articles.forms.include.payment')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
