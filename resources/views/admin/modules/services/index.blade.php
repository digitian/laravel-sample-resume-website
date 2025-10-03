@extends('admin.layouts.master')

@section('title', __('admin.services') . ' - ' . __('admin.overview'))

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  {{ __('admin.overview') }}
                </div>
                <h2 class="page-title">
                  {{ __('admin.services') }}
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.services.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    {{ __('admin.add_service') }}
                  </a>
                  <a href="{{ route('admin.services.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{ __('admin.add_service') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
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
                  <div class="table-responsive">
                    <table
		class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($services as $service)
                        <tr>
                            <td>
                                <div class="font-weight-medium">{{ $service->title }}</div>
                            </td>
                            <td class="text-secondary" >
                                {{ $service->created_at }}
                            </td>
                            <td class="text-secondary" >
                                @if ($service->status === 0)
                                <span class="badge bg-red text-red-fg">{{ __('admin.passive') }}</span>
                                @else
                                <span class="badge bg-lime text-lime-fg">{{ __('admin.active') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">

                                  <!-- Edit button -->
                                  <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-success me-1"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>{{ __('admin.edit') }}</a>

                                  <!-- Delete button -->
                                  <a href="javascript:;" onclick="event.preventDefault();
                                  if(confirm('{{ __('admin.are_you_sure') }}')) document.querySelector('#delete-action-{{ $service->id }}').requestSubmit();" class="btn btn-sm btn-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>{{ __('admin.delete') }}</a>
                                  </div>

                                  <!-- External delete form -->
                                  <form action="{{ route('admin.services.destroy', $service->id) }}" method="post" id="delete-action-{{ $service->id }}">
                                    @csrf
                                  @method('delete')
                                  </form>

                            </td>
                        </tr>
                        @empty
                            <th colspan="5" class="text-center">Veri bulunamadı</th>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection