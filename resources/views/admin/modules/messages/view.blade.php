@extends('admin.layouts.master')

@section('title', __('admin.view_message') . ' - ' . __('admin.overview'))

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  {{ __('admin.view_message') }}
                </div>
                <h2 class="page-title">
                  {{ __('admin.messages') }}
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.messages.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    {{ __('admin.messages') }}
                  </a>
                  <a href="{{ route('admin.messages.index') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{ __('admin.messages') }}">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row gy-3">
                      <div class="col-md-4">
                        <div class="fw-bold">Name</div>
                        <div class="text-muted">{{ $message->name }}</div>
                      </div>
                      <div class="col-md-4">
                        <div class="fw-bold">E-Mail</div>
                        <div class="text-muted">{{ $message->email }}</div>
                      </div>
                      <div class="col-md-4">
                        <div class="fw-bold">Date</div>
                        <div class="text-muted">{{ $message->created_at->translatedFormat('j M Y G:i:s') }}</div>
                      </div>
                      <hr class="my-3" />
                      <div class="col-12">
                        <div class="fw-bold">Message</div>
                        <div class="text-muted">{{ $message->message }}</div>
                      </div>
                    </div>
                    <div class="mt-5">
                      <a href="javascript:;" onclick="event.preventDefault();
                                  if(confirm('{{ __('admin.are_you_sure') }}')) document.querySelector('#delete-action-{{ $message->id }}').requestSubmit();" class="btn btn-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>Mesajı Sil</a>
                    </div>
                    <form action="{{ route('admin.message.destroy', $message->id) }}" method="post" id="delete-action-{{ $message->id }}">
                      @csrf
                      @method('delete')
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection