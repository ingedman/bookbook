@include('partials.header')


    <main class="py-4 flex-grow-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('status'))
                        <status-toast
                                status="{{ session('status') }}"
                        ></status-toast>
                    @endif

                    @yield('content')

                    @include('partials.modals')

                </div>
                @hasSection('aside')
                    <div class="col-md-4 hidden-sm-down">
                        @yield('aside')
                    </div>
                @endif
            </div>
        </div>

    </main>



@include('partials.footer')