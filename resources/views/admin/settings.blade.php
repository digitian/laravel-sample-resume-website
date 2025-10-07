@extends('admin.layouts.master')

@section('title', 'Ayarlar')

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __('admin.account_settings') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body">
                                <h4 class="subheader">{{ __('admin.general') }}</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="./settings.html"
                                        class="list-group-item list-group-item-action d-flex align-items-center active">{{ __('admin.my_acc') }}</a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center disabled">{{ __('admin.contact_info') }}</a>
                                </div>
                                <h4 class="subheader mt-4">{{ __('admin.development') }}</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="#" class="list-group-item list-group-item-action disabled">{{ __('admin.give_feedback') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 d-flex flex-column">
                            <div class="card-body">
                                <h2 class="mb-4">{{ __('admin.my_acc') }}</h2>
                                <h3 class="card-title">{{ __('admin.profile_details') }}</h3>
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="avatar avatar-xl"
                                            style="background-image: url({{ Storage::url(auth()->user()->image) }})"></span>
                                    </div>
                                    <div class="col-auto">
                                      <form action="{{ route('admin.settings.avatar.upload') }}" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <label for="avatar" class="btn">
                                            {{ __('admin.change_avatar') }}
                                        </label>
                                        <input type="file" name="avatar" id="avatar" class="d-none" onchange="form.submit()">
                                      </form>
                                    </div>
                                    <div class="col-auto">
                                      <a href="javascript:;" class="btn btn-ghost-danger" onclick="event.preventDefault();
                                  if(confirm('{{ __('admin.are_you_sure') }}')) document.querySelector('#delete-avatar').requestSubmit();">
                                        {{ __('admin.delete_avatar') }}
                                      </a>
                                      <form id="delete-avatar" action="{{ route('admin.settings.avatar.destroy') }}" method="post">
                                        @method('put')
                                        @csrf
                                      </form>
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">{{ __('admin.name') }}</h3>
                                <p class="card-subtitle">{{ __('admin.name_desc') }}</p>
                                <div>
                                  <form action="{{ route('admin.settings.name.change') }}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="row g-2">
                                      <div class="col-auto">
                                        <input type="text" name="name" class="form-control w-auto"
                                              value="{{ auth()->user()->name }}">
                                      </div>
                                      <div class="col-auto">
                                        <button type="submit" class="btn">{{ __('admin.change') }}</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <h3 class="card-title mt-4">{{ __('admin.password') }}</h3>
                                <p class="card-subtitle">{{ __('admin.password_desc') }}</p>
                                <div>
                                    <button class="btn" data-bs-toggle="collapse" data-bs-target="#passwordForm" aria-expanded="false" aria-controls="passwordForm">
                                        {{ __('admin.set_new_pw') }}
                                    </button>
                                    <div class="collapse" id="passwordForm">
                                      <div class="card mt-3">
                                        <div class="card-body">
                                          <form action="{{ route('admin.settings.password.update') }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                              <label class="form-label">{{ __('admin.current_password') }}</label>
                                              <input type="password" class="form-control" name="current_password" placeholder="{{ __('admin.current_password') }}" required>
                                            </div>
                                            <div class="mb-3">
                                              <label class="form-label m-0">{{ __('admin.new_password') }}</label>
                                              <span class="form-check-description mb-2">{{ __('admin.password_info') }}</span>
                                              <input type="password" class="form-control" name="new_password" placeholder="{{ __('admin.new_password') }}" required>
                                            </div>
                                            <div>
                                              <label class="form-label">{{ __('admin.confirm_new_password') }}</label>
                                              <input type="password" class="form-control" name="new_password_confirmation" placeholder="{{ __('admin.confirm_new_password') }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-3">{{ __('admin.update_password') }}</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">{{ __('admin.language') }}</h3>
                                <p class="card-subtitle">{{ __('admin.language_desc') }}</p>
                                <div>
                                  <form action="{{ route('admin.settings.language.update') }}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="row g-2">
                                      <div class="col-auto">
                                        <select class="form-select" name="language">
                                          <option value="tr" @selected(auth()->user()->language === 'tr')>{{ __('admin.turkish') }}</option>
                                          <option value="en" @selected(auth()->user()->language === 'en')>{{ __('admin.english') }}</option>
                                          <option value="de" @selected(auth()->user()->language === 'de')>{{ __('admin.german') }}</option>
                                        </select>
                                      </div>
                                      <div class="col-auto">
                                        <button type="submit" class="btn">{{ __('admin.change') }}</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
