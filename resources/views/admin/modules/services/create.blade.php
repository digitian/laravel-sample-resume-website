@extends('admin.layouts.master')

@section('title', __('admin.add_service'))

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  {{ __('admin.add_service') }}
                </div>
                <h2 class="page-title">
                  {{ __('admin.services') }}
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.services.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    {{ __('admin.services') }}
                  </a>
                  <a href="{{ route('admin.services.index') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{ __('admin.add_service') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <form action="{{ route('admin.services.store') }}" method="post">
            @csrf
            <div class="container-xl">
              <div class="row row-deck row-cards">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                          <span class="form-check-label">{{ __('admin.status') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">
                      <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a href="#form-turkish-tab" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">{{ __('main.turkish') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a href="#form-english-tab" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">{{ __('main.english') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a href="#form-german-tab" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">{{ __('main.german') }}</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <!-- Turkish -->
                        <div class="tab-pane active show" id="form-turkish-tab" role="tabpanel">
                          <div class="mb-3">
                            <label class="form-label" for="title_tr">{{ __('admin.title') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="title_tr" name="title_tr" placeholder="{{ __('admin.title') }} ({{ __('main.turkish') }})..." value="{{ old('title_tr') }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="content_tr">{{ __('admin.content') }} ({{ __('main.turkish') }})</label>
                            <textarea class="form-control" id="content_tr" name="content_tr" rows="6" placeholder="{{ __('admin.content') }} ({{ __('main.turkish') }})..." required>{{ old('content_tr') }}</textarea>
                          </div>
                        </div>

                        <!-- English -->
                        <div class="tab-pane" id="form-english-tab" role="tabpanel">
                          <div class="mb-3">
                            <label class="form-label" for="title_en">{{ __('admin.title') }} ({{ __('main.english') }})</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="{{ __('admin.title') }} ({{ __('main.english') }})..." value="{{ old('title_en') }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="content_en">{{ __('admin.content') }} ({{ __('main.english') }})</label>
                            <textarea class="form-control" id="content_en" name="content_en" rows="6" placeholder="{{ __('admin.content') }} ({{ __('main.english') }})..." required>{{ old('content_en') }}</textarea>
                          </div>
                        </div>

                        <!-- German -->
                        <div class="tab-pane" id="form-german-tab" role="tabpanel">
                          <div class="mb-3">
                            <label class="form-label" for="title_de">{{ __('admin.title') }} ({{ __('main.german') }})</label>
                            <input type="text" class="form-control" id="title_de" name="title_de" placeholder="{{ __('admin.title') }} ({{ __('main.german') }})..." value="{{ old('title_de') }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="content_de">{{ __('admin.content') }} ({{ __('main.german') }})</label>
                            <textarea class="form-control" id="content_de" name="content_de" rows="6" placeholder="{{ __('admin.content') }} ({{ __('main.german') }})..." required>{{ old('content_de') }}</textarea>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>{{ __('admin.create_service') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
@endsection