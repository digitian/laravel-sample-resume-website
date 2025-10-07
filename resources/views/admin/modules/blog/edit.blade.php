@extends('admin.layouts.master')

@section('title', __('admin.edit_post'))

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  {{ __('admin.edit_post') }}
                </div>
                <h2 class="page-title">
                  {{ __('admin.blog') }}
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.blog.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    {{ __('admin.blog') }}
                  </a>
                  <a href="{{ route('admin.blog.index') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{ __('admin.add_post') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <form action="{{ route('admin.blog.update', $post_tr->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="container-xl">
              <div class="row row-deck row-cards">

                <!-- Card: left -->
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      
                      <!-- Input: image upload -->
                      <div class="mb-3">
                          <div class="form-label" for="image">{{ __('admin.upload_cover_img') }}</div>
                          <input type="file" name="image" id="image" class="form-control">
                          <div class="border rounded p-2 mt-3">
                            <img src="{{ Storage::url($post_tr->image) }}" alt="{{ $post_tr->title }}" class="object-fit-cover" style="height: 120px; width: 100%;">
                          </div>
                      </div>

                      <!-- Toggle: status -->
                      <div class="mb-3">
                        <label class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" name="status" value="1" @checked($post_tr->status === 1)>
                          <span class="form-check-label">{{ __('admin.status') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Card: right -->
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

                          <!-- Input: title -->
                          <div class="mb-3">
                            <label class="form-label" for="title_tr">{{ __('admin.title') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="title_tr" name="title_tr" placeholder="{{ __('admin.title') }} ({{ __('main.turkish') }})..." value="{{ $post_tr->title }}" required>
                          </div>

                          <!-- Input: description -->
                          <div class="mb-3">
                            <label class="form-label" for="description_tr">{{ __('admin.description') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="description_tr" name="description_tr" placeholder="{{ __('admin.description') }} ({{ __('main.turkish') }})..." value="{{ $post_tr->description }}" required>
                          </div>

                          <!-- Input: content -->
                          <div class="mb-3">
                            <label class="form-label" for="content_tr">{{ __('admin.content') }} ({{ __('main.turkish') }})</label>
                            <textarea id="content_tr" name="content_tr">{!! $post_tr->content !!}</textarea>
                          </div>

                          <!-- Input: keywords -->
                          <div class="mb-3">
                            <label class="form-label" for="keywords_tr">{{ __('admin.keywords') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="keywords_tr" name="keywords_tr" placeholder="{{ __('admin.keywords') }} ({{ __('main.turkish') }})..." value="{{ $post_tr->keywords }}">
                          </div>

                          <!-- Input: category -->
                          <div class="mb-3">
                            <label class="form-label" for="category_tr">{{ __('admin.category') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="category_tr" name="category_tr" placeholder="{{ __('admin.category') }} ({{ __('main.turkish') }})..." value="{{ $post_tr->category }}">
                          </div>
                        </div>

                        <!-- English -->
                        <div class="tab-pane" id="form-english-tab" role="tabpanel">

                          <!-- Input: title -->
                          <div class="mb-3">
                            <label class="form-label" for="title_en">{{ __('admin.title') }} ({{ __('main.english') }})</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="{{ __('admin.title') }} ({{ __('main.english') }})..." value="{{ $post_en->title }}" required>
                          </div>
                          
                          <!-- Input: description -->
                          <div class="mb-3">
                            <label class="form-label" for="description_en">{{ __('admin.description') }} ({{ __('main.english') }})</label>
                            <input type="text" class="form-control" id="description_en" name="description_en" placeholder="{{ __('admin.description') }} ({{ __('main.english') }})..." value="{{ $post_en->description }}" required>
                          </div>

                          <!-- Input: content -->
                          <div class="mb-3">
                            <label class="form-label" for="content_en">{{ __('admin.content') }} ({{ __('main.english') }})</label>
                            <textarea id="content_en" name="content_en">{!! $post_en->content !!}</textarea>
                          </div>

                          <!-- Input: keywords -->
                          <div class="mb-3">
                            <label class="form-label" for="keywords_en">{{ __('admin.keywords') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="keywords_en" name="keywords_en" placeholder="{{ __('admin.keywords') }} ({{ __('main.turkish') }})..." value="{{ $post_en->keywords }}">
                          </div>

                          <!-- Input: category -->
                          <div class="mb-3">
                            <label class="form-label" for="category_en">{{ __('admin.category') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="category_en" name="category_en" placeholder="{{ __('admin.category') }} ({{ __('main.turkish') }})..." value="{{ $post_en->category }}">
                          </div>

                        </div>

                        <!-- German -->
                        <div class="tab-pane" id="form-german-tab" role="tabpanel">

                          <!-- Input: title -->
                          <div class="mb-3">
                            <label class="form-label" for="title_de">{{ __('admin.title') }} ({{ __('main.german') }})</label>
                            <input type="text" class="form-control" id="title_de" name="title_de" placeholder="{{ __('admin.title') }} ({{ __('main.german') }})..." value="{{ $post_de->title }}" required>
                          </div>

                          <!-- Input: description -->
                          <div class="mb-3">
                            <label class="form-label" for="description_de">{{ __('admin.description') }} ({{ __('main.german') }})</label>
                            <input type="text" class="form-control" id="description_de" name="description_de" placeholder="{{ __('admin.description') }} ({{ __('main.german') }})..." value="{{ $post_de->description }}" required>
                          </div>

                          <!-- Input: content -->
                          <div class="mb-3">
                            <label class="form-label" for="content_de">{{ __('admin.content') }} ({{ __('main.german') }})</label>
                            <textarea id="content_de" name="content_de">{!! $post_de->content !!}</textarea>
                          </div>

                          <!-- Input: keywords -->
                          <div class="mb-3">
                            <label class="form-label" for="keywords_de">{{ __('admin.keywords') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="keywords_de" name="keywords_de" placeholder="{{ __('admin.keywords') }} ({{ __('main.turkish') }})..." value="{{ $post_de->keywords }}">
                          </div>

                          <!-- Input: category -->
                          <div class="mb-3">
                            <label class="form-label" for="category_de">{{ __('admin.category') }} ({{ __('main.turkish') }})</label>
                            <input type="text" class="form-control" id="category_de" name="category_de" placeholder="{{ __('admin.category') }} ({{ __('main.turkish') }})..." value="{{ $post_de->category }}">
                          </div>

                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>{{ __('admin.save_post') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
@endsection

@pushOnce('scripts')
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}" defer></script>

    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        let options_tr = {
          selector: '#content_tr',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion markdown math',
          toolbar: 'undo redo | accordion accordionremove | math | blocks fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | pagebreak anchor codesample',
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options_tr.skin = 'oxide-dark';
          options_tr.content_css = 'dark';
        }
        tinyMCE.init(options_tr);
      })

      document.addEventListener("DOMContentLoaded", function () {
        let options_en = {
          selector: '#content_en',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion markdown math',
          toolbar: 'undo redo | accordion accordionremove | math | blocks fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | pagebreak anchor codesample',
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options_en.skin = 'oxide-dark';
          options_en.content_css = 'dark';
        }
        tinyMCE.init(options_en);
      })

      document.addEventListener("DOMContentLoaded", function () {
        let options_de = {
          selector: '#content_de',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion markdown math',
          toolbar: 'undo redo | accordion accordionremove | math | blocks fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | pagebreak anchor codesample',
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options_de.skin = 'oxide-dark';
          options_de.content_css = 'dark';
        }
        tinyMCE.init(options_de);
      })


      // @formatter:on
    </script>
@endPushOnce