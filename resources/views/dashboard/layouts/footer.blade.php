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
        <script src="{{ asset('default/stisla/stisla.js') }}"></script>
        <script src="{{ asset('default/stisla/sticky-kit.min.js') }}"></script>
        <!-- Page Specific JS File -->
        @yield('scripts')
        <!-- Template JS File -->
        <script src="{{ asset('default/stisla/scripts.js') }}"></script>
        @yield('settings.scripts')
    </body>
</html>
