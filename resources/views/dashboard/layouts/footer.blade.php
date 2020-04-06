                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                    </div>
                    <div class="footer-right">
                        2.3.0
                    </div>
                </footer>
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('default/js/manifest.js') }}"></script>
        <script src="{{ asset('default/js/vendor.js') }}"></script>
        <script src="{{ asset('default/js/app.js') }}"></script>
        <script src="{{ asset('default/stisla/sticky-kit.min.js') }}"></script>
        <script src="{{ asset('default/stisla/stisla.js') }}"></script>
        <script src="{{ asset('default/stisla/iziToast.min.js') }}"></script>
        <!-- Page Specific JS File -->
        @if (session()->has('success'))
            <x-alert
                title="Success"
                :message="session()->get('success')"
                color="green"
                icon='fas fa-check'
            />
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert
                    title="Error"
                    :message="$error"
                    color="red"
                    icon='fas fa-ban'
                />
            @endforeach
        @endif

        @yield('scripts')
        <!-- Template JS File -->
        <script src="{{ asset('default/stisla/scripts.js') }}"></script>
        {!! $settings->footer_scripts ?? '' !!}
    </body>
</html>
