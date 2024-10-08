@extends('layout.app')
@section('style')
    <style>
        .toast-success.custom-toast {
            background-color: #0acf97 !important;
            /* Your desired background color */
        }

        .toast-error.custom-toast {
            background-color: #f44336 !important;
            /* Your desired error background color */
        }

        .text-truncate {
            max-width: 150px;
            /* Adjust the width as needed */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .popover-body,
        .popover-header {
            font-family: 'Hanuman', 'serif' !important;
        }

        :root {
            --light: hsl(220, 50%, 90%);
            --primary: hsl(255, 30%, 55%);
            --focus: hsl(210, 90%, 50%);
            --border-color: hsla(0, 0%, 100%, .2);
            --global-background: hsl(220, 25%, 10%);
            --background: linear-gradient(to right, hsl(210, 30%, 20%), hsl(255, 30%, 25%));
            --shadow-1: hsla(236, 50%, 50%, .3);
            --shadow-2: hsla(236, 50%, 50%, .4);
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 4rem 2rem;
        }

        .box:not(:first-child) {
            height: 45rem;
        }

        .box__title {
            font-size: 10rem;
            font-weight: normal;
            letter-spacing: .8rem;
            margin-bottom: 2.6rem;
        }

        .box__title::first-letter {
            color: var(--primary);
        }

        .box__p,
        .box__info,
        .box__note {
            font-size: 1.6rem;
        }

        .box__info {
            margin-top: 6rem;
        }

        .box__note {
            line-height: 2;
        }


        /* modal */
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            display: none;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease;
            background: var(--m-background);
        }

        .modal-container:target {
            display: flex;
        }

        .modal1 {
            width: 30rem;
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 1rem;
            padding-bottom: 2rem;
            border-radius: .8rem;
            color: var(--light);
            background: gray;
            box-shadow: var(--m-shadow, .4rem .4rem 10.2rem .2rem) var(--shadow-1);
            position: relative;

            overflow: hidden;
        }

        .modal__title {
            font-size: 2rem;
        }

        .modal__text {
            padding: 0 2rem;
            margin-top: 4rem;
            font-size: 1.6rem;
            line-height: 2;
        }

        .modal__btn {
            margin-top: 4rem;
            padding: 1rem 1.6rem;
            border: 1px solid var(--border-color);
            border-radius: 100rem;

            color: inherit;
            background: transparent;
            font-size: 1.2rem;
            font-family: inherit;
            letter-spacing: .2rem;

            transition: .2s;
            cursor: pointer;
        }

        .modal__btn:nth-of-type(1) {
            margin-right: 1rem;
        }

        .modal__btn:hover,
        .modal__btn:focus {
            background: var(--focus);
            border-color: var(--focus);
            transform: translateY(-.2rem);
        }


        /* link-... */
        .link-1 {
            font-size: 1rem;

            color: var(--light);
            background: var(--background);
            box-shadow: .4rem .4rem 2.4rem .2rem var(--shadow-1);
            border-radius: 100rem;
            padding: 1rem;

            transition: .2s;
        }

        .link-1:hover,
        .link-1:focus {
            transform: translateY(-.2rem);
            box-shadow: 0 0 4.4rem .2rem var(--shadow-2);
        }

        .link-1:focus {
            box-shadow:
                0 0 4.4rem .2rem var(--shadow-2),
                0 0 0 .4rem var(--global-background),
                0 0 0 .5rem var(--focus);
        }

        .link-2 {
            width: 3rem;
            height: 3rem;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            color: black;
            font-size: 2.2rem;
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all .2s ease-in-out;
        }

        .link-2::before {
            content: '×';

            transform: translateY(-.1rem);
        }

        .link-2:hover,
        .link-2:focus {
            background: var(--focus);
            border-color: var(--focus);
            color: white;
            transform: translateY(-.2rem);
        }

        .abs-site-link {
            position: fixed;
            bottom: 20px;
            left: 20px;
            color: hsla(0, 0%, 1000%, .6);
            font-size: 1.6rem;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [['title' => __('label.Carousels'), 'url' => route('guests.index')]];
        $currentPageTitle = __('label.Carousels');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex mb-2 flex-wrap justify-content-between align-items-center">
                        <h4 style="margin-top: -12px">@lang('label.images')</h4>
                        <a href="#m1-o" id="m1-c" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover"
                            data-bs-placement="right" data-bs-content="@lang('label.youcan')" title="@lang('label.createNewGuest')"
                            class="btn btn-danger mb-2">
                            <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addCarousel')
                        </a>
                    </div>
                    <div class="row">
                        @foreach ($carousels as $carousel)
                            <div class="col-md-6 col-xxl-3">
                                <div class="card d-block">
                                    <img class="card-img-top" src="{{ asset('storage/' . $carousel->image) }}"
                                        style="height: 180px" alt="project image cap">
                                    <div class="card-img-overlay">
                                        <a href="{{ url('carousels/' . $carousel->id . '/delete') }}"   onclick="confirmation(event)" 
                                            class="badge bg-danger text-light p-2 rounded-circle cursor-pointer border-none border-0"><i
                                                class=" mdi mdi-close-thick fs-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center d-flex justify-content-center align-items-center">
                            <nav>
                                <ul class="pagination mt-3 text-center pagination-rounded mb-0">
                                    @if ($carousels->currentPage() > 1)
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $carousels->previousPageUrl() }}{{ http_build_query(request()->except('page')) }}"
                                                aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript: void(0);">&laquo;</a>
                                        </li>
                                    @endif
                                    @for ($i = 1; $i <= $carousels->lastPage(); $i++)
                                        <li class="page-item{{ $carousels->currentPage() == $i ? ' active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $carousels->url($i) }}{{ http_build_query(request()->except('page')) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($carousels->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $carousels->nextPageUrl() }}{{ http_build_query(request()->except('page')) }}"
                                                aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal 1 -->
    <div class="modal-container" id="m1-o">
        <div class="modal1 bg-white ">
            <h1 class="modal__title mb-3 text-primary">New Carousel</h1>
            <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/carousels') }}" method="POST"
                novalidate="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">@lang('label.name')</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control  @error('name') is-invalid @enderror " placeholder="@lang('label.enterCarouselName') . . . "
                        required="">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">@lang('label.image')</label>
                    <input type="file" value="{{ old('email') }}" name="image"
                        class="form-control @error('image') is-invalid @enderror" required=""
                        placeholder="@lang('label.enterEmail') . . . ">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="@lang('label.enterDescription') . . ."></textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                <a href="{{ url('carousels') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
            </form>
            <a href="#m1-c" class="link-2"></a>
        </div>
    </div>

    <!-- /modal 1 -->
@endsection
@section('script')
    <script>
        ! function(i) {
            "use strict";

            function showSuccessNotification(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "4000",
                    "hideDuration": "2000",
                    "timeOut": "5000",
                    "extendedTimeOut": "4000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.success(message);
            }

            function showErrorNotification(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "3000",
                    "timeOut": "7000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.error(message);
            }

            @if (session('success'))
                showSuccessNotification(@json(session('success')));
            @endif

            @if (session('error'))
                showErrorNotification(@json(session('error')));
            @endif
        }(window.jQuery);


        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            var question = @json(__('label.areYourSure'));
            var maksure = @json(__('label.youWontBe'));
            var confirm = @json(__('label.ok'));
            var cancel = @json(__('label.cancel'));
            console.log(urlToRedirect);

            swal({
                    title: question,
                    text: maksure,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: cancel,
                            value: null,
                            visible: true,
                            // className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: confirm,
                            value: true,
                            visible: true,
                            // className: "btn btn-primary",
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                })

                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }

        /*============= Tranlsate ==============*/
        var displayText = @json(__('label.display'));
        var displayGuest = @json(__('label.guest'));
        var showingGuestsText =
            "{{ __('label.showing_guests', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection
