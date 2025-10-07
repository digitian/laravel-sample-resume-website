@extends('admin.layouts.master')

@section('title', __('admin.messages') . ' - ' . __('admin.overview'))

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
                  {{ __('admin.messages') }}
                </h2>
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
                          <th>{{ __('admin.name') }}</th>
                          <th>{{ __('admin.message') }}</th>
                          <th>{{ __('admin.email') }}</th>
                          <th>{{ __('admin.date') }}</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($messages as $message)
                        <tr>
                            <td>
                              <a href="{{ route('admin.message.view', $message) }}" class="text-nowrap{{ $message->seen === 0 ? ' fw-bold text-reset' : '' }}">{{ Str::substr($message->name, 1, 40) }}{{ Str::length($message->name) > 40 ? '...' : '' }}</a>
                            </td>
                            <td class="text-secondary text-truncate" >
                              {{ Str::substr($message->message, 1, 40) }}{{ Str::length($message->message) > 40 ? '...' : '' }}
                            </td>
                            <td class="text-secondary" >
                              {{ Str::substr($message->email, 1, 40) }}{{ Str::length($message->email) > 40 ? '...' : '' }}
                            </td>
                            <td class="text-nowrap">
                              {{ $message->created_at->translatedFormat('j M Y G:i:s') }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">

                                  <!-- Delete button -->
                                  <a href="javascript:;" onclick="event.preventDefault();
                                  if(confirm('{{ __('admin.are_you_sure') }}')) document.querySelector('#delete-action-{{ $message->id }}').requestSubmit();" class="btn btn-sm btn-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>{{ __('admin.delete') }}</a>
                                  </div>

                                  <!-- External delete form -->
                                  <form action="{{ route('admin.message.destroy', $message->id) }}" method="post" id="delete-action-{{ $message->id }}">
                                    @csrf
                                    @method('delete')
                                  </form>

                            </td>
                        </tr>
                        @empty
                            <th colspan="5" class="text-center">{{ __('admin.no_data') }}</th>
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