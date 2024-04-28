<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KZ_Coffee</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-dTveN9AYCV/L8yQo4tlQSp9YBy5XlHI1fc0J90K9f7ZlpTkEULV0Bbiho3vQ8qaD" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        html {
            background-color: #f6f6f6;
        }

        .nav-icon.icon:before {
            width: 25px;
        }

        .bg-light {
            background-color: #ffffff !important;
            color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan */
        }


        .btn.btn-primary {
            background-color: #2e558f !important;
            color: #ffffff;
            /* Warna teks sesuaikan dengan kebutuhan */
        }

        .navbar {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .main-sidebar {
            background-color: #17386a;
        }

        .nav-sidebar .nav-link {
            color: #f1e9de;
        }

        .nav-sidebar .nav-link:hover {
            color: #c4baaf !important;
        }
    </style>


    @livewireStyles
</head>

<body>

    <body class="sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
        <div id="app" class="wrapper">
            <div class="main-header">
                @include('layouts.nav')
            </div>

            @include('layouts.sidebar')

            <main class="content-wrapper p-5">
                @yield('content')
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />
        <x-livewire-alert::flash />

        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <script>
            $('.open-invoice').click(function(e) {

                console.log('Tombol invoice diklik');

                let no_faktur = $(this).data('no_invoice');

                window.open("/transaction/invoice/" + no_faktur, "_blank",
                    "width=500px,height=700px");

            });
            // Sweet alert
            $('.btn-delete').on('click', function(e) {
                let nama_produk = $(this).closest('tr').find('td:eq(0)').text();
                Swal.fire({
                    icon: 'error',
                    title: 'Hapus Data',
                    html: 'Apakah Yakin data ini akan dihapus?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    showDenyButon: true,
                    focusConfirm: false
                }).then((result) => {
                    if (result.isConfirmed) $(e.target).closest('form').submit()
                    else swal.close()
                })
            })
        </script>

        <script>
            let table = new DataTable('#myTable');
        </script>

        @stack('scripts')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

        @if (session()->has('success'))
            <script>
                var notyf = new Notyf({
                    dismissible: true
                })
                notyf.success('{{ session('success') }}')
            </script>
        @endif

        @if ($errors->any())
            <script>
                var notyf = new Notyf({
                    dismissible: true
                });
                @foreach ($errors->all() as $error)
                    notyf.error('{{ $error }}');
                @endforeach
            </script>
        @endif

        <script>
            /* Simple Alpine Image Viewer */
            document.addEventListener('DOMContentLoaded', function() {
                function imageViewer(src = '') {
                    return {
                        imageUrl: src,

                        refreshUrl() {
                            this.imageUrl = this.el.getAttribute("image-url");
                        },

                        fileChosen(event) {
                            this.fileToDataUrl(event, (src) => (this.imageUrl = src));
                        },

                        fileToDataUrl(event, callback) {
                            if (!event.target.files.length) return;

                            let file = event.target.files[0];
                            let reader = new FileReader();

                            reader.readAsDataURL(file);
                            reader.onload = function(e) {
                                callback(e.target.result);
                            };
                        },
                    };
                }

                function defineData(name, callback) {
                    document.querySelectorAll(`[data-${name}]`).forEach((el) => {
                        callback.call({
                            el
                        });
                    });
                }

                defineData('image-viewer', function() {
                    imageViewer().call(this);
                });
            });
        </script>
    </body>

</html>
