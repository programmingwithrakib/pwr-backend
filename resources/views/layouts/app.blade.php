<!DOCTYPE html>
    <html
        lang="{{app()->getLocale() == "en" ? 'en' : 'ar'}}"
        dir="{{app()->getLocale() == "en" ? 'ltr' : 'rtl'}}"
        class="{{session('theme') == "light" ? 'light-style' : 'dark-style'}} layout-menu-fixed"

        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template"
    >
    <head>
        <title>{{isset($title) ? $title : 'My Project Title'}} </title>
        <meta charset="utf-8" />
        @include('layouts.head')

    </head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('layouts.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper position-relative">
                <!-- Content -->

                @yield('content')

                <div class="mt-2"></div>
                <footer  style="bottom: 0" class="content-footer w-100 position-fixed footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-center py-1 flex-md-row flex-column">
                        <div style="margin-left: -200px" class="mb-2 text-center mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , This Application Made By
                            <a href="https://tazamun.com.sa" target="_blank" class="footer-link fw-bolder text-primary">Nexerb Limited</a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <x-delete-modal/>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{asset("assets/vendor/js/menu.js")}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{asset("assets/js/main.js")}}"></script>

    <!-- Page JS -->
    <script src="{{asset("assets/js/dashboards-analytics.js")}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        let timeout = null;
        function searchData(){
            clearTimeout(timeout);
            timeout = setTimeout(function (){
                $('#search-form').trigger('submit');
            }, 500)
        }


        $(document).ready(function() {
            $('.select-2').select2();
        });


        //delete modal from index list button
        $('.delete-btn').on('click', function (){
            let url = $(this).attr('url')
            $('#modal-delete-form').attr('action', url)
        });
    </script>
</body>
</html>
