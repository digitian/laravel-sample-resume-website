@extends('admin.layouts.master')

@section('title', 'Anasayfa')

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
                  {{ __('admin.home') }}
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
                <div class="row row-cards">
                  <!-- Content is coming -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection