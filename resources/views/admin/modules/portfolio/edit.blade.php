@extends('admin.layouts.master')

@section('title', __('admin.edit_portfolio'))

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            {{ __('admin.edit_portfolio') }}
                        </div>
                        <h2 class="page-title">
                            {{ __('admin.portfolio') }}
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="d-print-none col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l14 0" />
                                    <path d="M5 12l6 6" />
                                    <path d="M5 12l6 -6" />
                                </svg>
                                {{ __('admin.portfolio') }}
                            </a>
                            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="{{ __('admin.add_portfolio') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l14 0" />
                                    <path d="M5 12l6 6" />
                                    <path d="M5 12l6 -6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <form action="{{ route('admin.portfolio.update', $portfolio_tr->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <!-- Input: image upload -->
                                    <div class="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <small class="text-muted mb-3">Resim ekleme&çıkarma&düzenleme şimdilik yok. Sonradan yapılacak.</small>
                                                <div id="dropzone" class="text-primary fw-semibold mb-3 rounded">
                                                    {{ __('admin.drag_drop') }}<input id="file" type="file"
                                                        name="images[]" accept="image/*" multiple hidden></div>
                                                <div id="preview" class="d-flex flex-wrap gap-2">
                                                    @foreach($portfolio_tr->images as $key=>$image)
                                                        <div class="thumb" data-old-id="{{ $key }}" draggable="true">
                                                            <div class="thumb-body">
                                                                <img src="{{ Storage::url($image) }}" alt="">
                                                                <div class="small text-muted text-truncate flex-grow-1">
                                                                {{ $image }}
                                                                </div>
                                                                <div class="thumb-actions">
                                                                <button class="btn btn-sm btn-icon btn-light thumb-handle" title="Drag to sort" draggable="true" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg></button>
                                                                <button class="btn btn-sm btn-icon btn-outline-danger thumb-remove" title="Remove" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Select: category -->
                                    <div class="mb-3">
                                        <label class="form-label" for="category">{{ __('admin.category') }}</label>
                                        <select class="form-select" name="category" id="category">
                                            <option value="project" @selected($portfolio_tr->category==='project')>{{ __('admin.project') }}</option>
                                            <option value="web-template" @selected($portfolio_tr->category==='web-template')>{{ __('admin.web_template') }}</option>
                                            <option value="ui" @selected($portfolio_tr->category==='ui')>{{ __('admin.ui_element') }}</option>
                                        </select>
                                    </div>

                                    <!-- Select: stage -->
                                    <div class="mb-3">
                                    <div class="form-label" for="stage">{{ __('admin.stage') }}</div>
                                        <select class="form-select" name="stage" id="stage">
                                            <option value="inprogress" @selected($portfolio_tr->stage==="inprogress")>{{ __('admin.in_progress') }}</option>
                                            <option value="completed" @selected($portfolio_tr->stage==="completed")>{{ __('admin.completed') }}</option>
                                            <option value="canceled" @selected($portfolio_tr->stage==="canceled")>{{ __('admin.canceled') }}</option>
                                        </select>
                                    </div>

                                    <!-- Input: Github link -->
                                    <div class="mb-3">
                                        <label class="form-label" for="github_link">{{ __('admin.github_link') }}</label>
                                        <input type="text" class="form-control" id="github_link"
                                            name="github_link"
                                            placeholder="{{ __('admin.github_link') }}..."
                                            value="{{ $portfolio_tr->github_link }}">
                                    </div>

                                    <!-- Input: Demo link -->
                                    <div class="mb-3">
                                        <label class="form-label" for="demo_link">{{ __('admin.demo_link') }}</label>
                                        <input type="text" class="form-control" id="demo_link"
                                            name="demo_link"
                                            placeholder="{{ __('admin.demo_link') }}..."
                                            value="{{ $portfolio_tr->demo_link }}">
                                    </div>

                                    <!-- Toggle: status -->
                                    <div class="mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" value="1"
                                                @checked($portfolio_tr->status === 1)>
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
                                            <a href="#form-turkish-tab" class="nav-link active" data-bs-toggle="tab"
                                                aria-selected="true" role="tab">{{ __('main.turkish') }}</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#form-english-tab" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab"
                                                tabindex="-1">{{ __('main.english') }}</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#form-german-tab" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab"
                                                tabindex="-1">{{ __('main.german') }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- Turkish -->
                                        <div class="tab-pane active show" id="form-turkish-tab" role="tabpanel">

                                            <!-- Input: title -->
                                            <div class="mb-3">
                                                <label class="form-label" for="title_tr">{{ __('admin.title') }}
                                                    ({{ __('main.turkish') }})</label>
                                                <input type="text" class="form-control" id="title_tr"
                                                    name="title_tr"
                                                    placeholder="{{ __('admin.title') }} ({{ __('main.turkish') }})..."
                                                    value="{{ $portfolio_tr->title }}" required>
                                            </div>

                                            <!-- Input: description -->
                                            <div class="mb-3">
                                                <label class="form-label" for="description_tr">{{ __('admin.description') }} ({{ __('main.turkish') }})</label>
                                                <input type="text" class="form-control" id="description_tr" name="description_tr" placeholder="{{ __('admin.description') }} ({{ __('main.turkish') }})..." value="{{ $portfolio_tr->description }}" required>
                                            </div>

                                            <!-- Input: content -->
                                            <div class="mb-3">
                                                <label class="form-label" for="content_tr">{{ __('admin.content') }}
                                                    ({{ __('main.turkish') }})</label>
                                                <textarea class="form-control" id="content_tr" name="content_tr" rows="6"
                                                    placeholder="{{ __('admin.content') }} ({{ __('main.turkish') }})..." required>{{ $portfolio_tr->content }}</textarea>
                                            </div>

                                            <!-- Input: features -->
                                            <div id="features-group-tr" data-features-group data-lang="tr">
                                                <label class="form-label" for="features">{{ __('admin.features') }}
                                                    ({{ __('main.turkish') }})</label>
                                                <input type="hidden" name="features_tr[]"><!-- keep this -->
                                                @forelse($portfolio_tr->features as $feature)
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="{{ $feature }}">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @empty
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @endforelse
                                                <button class="btn btn-success mt-3" type="button">
                                                    {{ __('admin.add_feature') }} </button>
                                            </div>
                                        </div>
                                        <!-- English -->
                                        <div class="tab-pane" id="form-english-tab" role="tabpanel">

                                            <!-- Input: title -->
                                            <div class="mb-3">
                                                <label class="form-label" for="title_en">{{ __('admin.title') }}
                                                    ({{ __('main.english') }})</label>
                                                <input type="text" class="form-control" id="title_en"
                                                    name="title_en"
                                                    placeholder="{{ __('admin.title') }} ({{ __('main.english') }})..."
                                                    value="{{ $portfolio_en->title }}" required>
                                            </div>

                                            <!-- Input: description -->
                                            <div class="mb-3">
                                                <label class="form-label" for="description_en">{{ __('admin.description') }} ({{ __('main.english') }})</label>
                                                <input type="text" class="form-control" id="description_en" name="description_en" placeholder="{{ __('admin.description') }} ({{ __('main.english') }})..." value="{{ $portfolio_en->description }}" required>
                                            </div>

                                            <!-- Input: content -->
                                            <div class="mb-3">
                                                <label class="form-label" for="content_en">{{ __('admin.content') }}
                                                    ({{ __('main.english') }})</label>
                                                <textarea class="form-control" id="content_en" name="content_en" rows="6"
                                                    placeholder="{{ __('admin.content') }} ({{ __('main.english') }})..." required>{{ $portfolio_en->content }}</textarea>
                                            </div>

                                            <!-- Input: features -->
                                            <div id="features-group-en" data-features-group data-lang="en">
                                                <label class="form-label">{{ __('admin.features') }}
                                                    ({{ __('main.english') }})</label>
                                                <input type="hidden" name="features_en[]">
                                                @forelse($portfolio_en->features as $feature)
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="{{ $feature }}">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @empty
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @endforelse
                                                <button class="btn btn-success mt-3" type="button">
                                                    {{ __('admin.add_feature') }} </button>
                                            </div>

                                        </div>

                                        <!-- German -->
                                        <div class="tab-pane" id="form-german-tab" role="tabpanel">

                                            <!-- Input: title -->
                                            <div class="mb-3">
                                                <label class="form-label" for="title_de">{{ __('admin.title') }}
                                                    ({{ __('main.german') }})</label>
                                                <input type="text" class="form-control" id="title_de"
                                                    name="title_de"
                                                    placeholder="{{ __('admin.title') }} ({{ __('main.german') }})..."
                                                    value="{{ $portfolio_de->title }}" required>
                                            </div>

                                            <!-- Input: description -->
                                            <div class="mb-3">
                                                <label class="form-label" for="description_de">{{ __('admin.description') }} ({{ __('main.german') }})</label>
                                                <input type="text" class="form-control" id="description_de" name="description_de" placeholder="{{ __('admin.description') }} ({{ __('main.german') }})..." value="{{ $portfolio_de->description }}" required>
                                            </div>

                                            <!-- Input: content -->
                                            <div class="mb-3">
                                                <label class="form-label" for="content_de">{{ __('admin.content') }}
                                                    ({{ __('main.german') }})</label>
                                                <textarea class="form-control" id="content_de" name="content_de" rows="6"
                                                    placeholder="{{ __('admin.content') }} ({{ __('main.german') }})..." required>{{ $portfolio_de->content }}</textarea>
                                            </div>

                                            <!-- Input: features -->
                                            <div id="features-group-de" data-features-group data-lang="de">
                                                <label class="form-label">{{ __('admin.features') }}
                                                    ({{ __('main.german') }})</label>
                                                <input type="hidden" name="features_de[]">
                                                @forelse($portfolio_de->features as $feature)
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="{{ $feature }}">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @empty
                                                    <div class="d-flex align-items-center mt-2">
                                                        <input type="text" name="features" class="form-control" value="">
                                                        <button class="btn btn-outline-danger btn-icon ms-2" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                                                    </div>
                                                @endforelse
                                                <button class="btn btn-success mt-3" type="button">
                                                    {{ __('admin.add_feature') }} </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <!-- Button: submit -->
                                    <button type="submit" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>{{ __('admin.save_portfolio') }}</button>
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
    <script>
        const marker = document.createElement('div');
        marker.className = 'drop-marker';

        const dz = document.getElementById('dropzone'),
            fi = document.getElementById('file'),
            pv = document.getElementById('preview');

        dz.onclick = () => fi.click();
        ['dragover', 'dragleave', 'drop'].forEach(ev => dz.addEventListener(ev, e => {
            if (ev !== 'click') e.preventDefault();
            dz.classList.toggle('dragover', ev === 'dragover');
            if (ev === 'drop') addFiles(e.dataTransfer.files);
        }));

        fi.onchange = () => addFiles(fi.files);

        function addFiles(fs) {
            [...fs].forEach(f => {
                if (!f.type.startsWith('image/')) return;
                const url = URL.createObjectURL(f);
                const d = document.createElement('div');
                d.className = 'thumb';
                d.draggable = true;
                d.dataset.url = url;

                d.innerHTML = `
        <div class="thumb-body">
            <img src="${url}" alt="">
            <div class="small text-muted text-truncate flex-grow-1">${f.name}</div>
            <div class="thumb-actions">
            <button class="btn btn-sm btn-icon btn-light thumb-handle" title="Drag to sort" draggable="true"> type="button"<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
            <button class="btn btn-sm btn-icon btn-outline-danger thumb-remove" title="Remove" type="button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
            </div>
        </div>
        `;
                pv.append(d);
            });
        }

        let allow = false,
            drag = null;

        pv.addEventListener('pointerdown', e => allow = !!e.target.closest('.thumb-handle'));
        window.addEventListener('pointerup', () => allow = false);

        pv.addEventListener('dragstart', e => {
            const card = e.target.closest('.thumb');
            if (!card || !allow) {
                e.preventDefault();
                return;
            }
            drag = card;
            drag.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', ''); // Safari
            const r = card.getBoundingClientRect();
            e.dataTransfer.setDragImage(card, r.width / 2, r.height / 2);
        });

        pv.addEventListener('dragend', () => {
            drag?.classList.remove('dragging');
            drag = null;
            marker.remove();
        });

        pv.addEventListener('dragover', e => {
            if (!drag) return;
            e.preventDefault();

            // find the thumb under the pointer (if any)
            const t = e.target.closest('.thumb');

            // if hovering empty space, put marker at the end
            if (!t) {
                if (pv.lastElementChild !== marker) pv.append(marker);
                return;
            }

            // decide before/after by comparing mouse Y with target midpoint
            const rect = t.getBoundingClientRect();
            const before = e.clientY < rect.top + rect.height / 2;

            // avoid placing marker inside the dragged node
            if (t === drag) {
                // if over itself, show marker either above or below depending on pointer
                const sib = before ? drag : drag.nextElementSibling;
                if (sib !== marker) pv.insertBefore(marker, sib);
                return;
            }

            // insert marker before/after hovered card
            pv.insertBefore(marker, before ? t : t.nextElementSibling);
        });

        pv.addEventListener('drop', e => {
            e.preventDefault();
            if (!drag) return;
            if (marker.parentNode) pv.insertBefore(drag, marker);
            marker.remove();
            drag.classList.remove('dragging');
            drag = null;
        });


        pv.addEventListener('click', e => {
            const btn = e.target.closest('.thumb-remove');
            if (!btn) return;
            const card = btn.closest('.thumb');
            URL.revokeObjectURL(card.dataset.url);
            card.remove();
        });
    </script>

    <script>
        (() => {
            const groups = [...document.querySelectorAll('[data-features-group]')];
            if (!groups.length) return;

            // Cache per-group helpers
            const meta = groups.map(g => ({
                el: g,
                lang: g.dataset.lang, // "tr" | "en" | "de"
                addBtn: g.querySelector(':scope > button.btn-success'),
                template: g.querySelector(':scope > .d-flex.align-items-center')
            }));

            // Add one new empty row to every language group
            function addRowAll() {
                meta.forEach(m => {
                    const row = m.template.cloneNode(true);
                    row.querySelector('input[type="text"]').value = '';
                    m.el.insertBefore(row, m.addBtn);
                });
            }

            // Remove row at the same index from every language group (keep at least 1)
            function removeRowAll(index) {
                meta.forEach(m => {
                    const rows = [...m.el.querySelectorAll(':scope > .d-flex.align-items-center')];
                    if (rows.length <= 1) {
                        rows[0].querySelector('input[type="text"]').value = '';
                        return;
                    }
                    if (rows[index]) rows[index].remove();
                    else rows[rows.length - 1].remove();
                });
            }

            // Wire add buttons in each tab to add everywhere
            meta.forEach(m => m.addBtn.addEventListener('click', addRowAll));

            // Delegated remove: compute index in the clicked group, then remove everywhere
            groups.forEach(g => {
                g.addEventListener('click', e => {
                    const rm = e.target.closest('.btn-outline-danger');
                    if (!rm) return;
                    const rows = [...g.querySelectorAll(':scope > .d-flex.align-items-center')];
                    const idx = rows.indexOf(rm.closest('.d-flex.align-items-center'));
                    removeRowAll(idx);
                });
            });

            // On submit: convert visible rows into per-language arrays
            const form = groups[0].closest('form');
            if (!form) return;

            form.addEventListener('submit', () => {
                meta.forEach(m => {
                    // clear old hidden inputs for this group
                    m.el.querySelectorAll('input[type="hidden"][name^="features_"]').forEach(n => n
                        .remove());

                    // collect values for this language
                    const values = [...m.el.querySelectorAll(
                            ':scope > .d-flex.align-items-center input[type="text"]')]
                        .map(i => i.value.trim()).filter(Boolean);

                    // build hidden inputs: features_{lang}[]
                    values.forEach(v => {
                        const h = document.createElement('input');
                        h.type = 'hidden';
                        h.name = `features_${m.lang}[]`;
                        h.value = v;
                        m.el.prepend(h);
                    });

                    // ensure the visible inputs don't submit (we only want the arrays)
                    m.el.querySelectorAll(':scope > .d-flex.align-items-center input[name="features"]')
                        .forEach(i => i.removeAttribute('name'));
                });
            });
        })
        ();
    </script>
@endPushOnce

@pushOnce('styles')
    <style>
        #dropzone {
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: .15s
        }

        #dropzone.dragover {
            background: #e7f1ff
        }

        #preview {
            min-height: 84px
        }

        .thumb {
            width: 100%;
            height: 64px;
            position: relative;
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            overflow: hidden
        }

        .thumb {
            width: 100%;
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            overflow: hidden
        }

        .thumb-body {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .5rem .75rem
        }

        .thumb img {
            width: 80px;
            height: 56px;
            object-fit: cover;
            border-radius: .35rem
        }

        .thumb-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: .25rem
        }

        .thumb-handle {
            cursor: grab;
            user-select: none
        }

        .drop-marker {
            height: 6px;
            border-radius: 999px;
            background: rgba(13, 110, 253, .35);
            margin: 4px 0;
        }

        .thumb.dragging {
            opacity: .6
        }
    </style>
@endPushOnce
