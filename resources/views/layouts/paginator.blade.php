@if ($paginator->hasPages())
<!-- container -->
<div class="container-fluid">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-lg-12">

            <!-- pagination -->
            <div class="art-a art-pagination">
                <!-- button -->
                @if ($paginator->onFirstPage())
                    <a href="javascript:;" class="art-link art-color-link art-w-chevron art-left-link" style="color: #666664;" aria-disabled="true"><span>@lang('pagination.previous')</span></a>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="art-link art-color-link art-w-chevron art-left-link" aria-label="@lang('pagination.previous')" rel="prev"><span>@lang('pagination.previous')</span></a>
                @endif

                {{-- Pagination Elements --}}
                <div class="art-pagination-center art-m-hidden">
                    @foreach ($elements as $element)

                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <a href="javascript:;">1</a>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <a href="javascript:;" class="art-active-pag" aria-current="page">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="art-link art-color-link art-w-chevron" aria-label="@lang('pagination.next')" rel="next"><span>@lang('pagination.next')</span></a>
                @else
                    <a href="javascript:;" style="color: #666664;" class="art-link art-color-link art-w-chevron" aria-disabled="true"><span>@lang('pagination.next')</span></a>
                @endif
                <!-- button -->
            </div>
            <!-- pagination end -->

        </div>
        <!-- col end -->

    </div>
    <!-- row end -->

</div>
<!-- container end -->
@endif