<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Iuran Desa</title>

    {{-- INI CSS-MU (BOOTSTRAP) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .wrapper {
            display: flex;
            flex: 1;
        }
        #sidebar {
            width: 250px;
            background: #343a40; /* Warna gelap sidebar */
            color: #fff;
            flex-shrink: 0; /* Mencegah sidebar menyusut */
        }
        #content-wrapper {
            flex-grow: 1; /* Mengisi sisa ruang */
            display: flex;
            flex-direction: column;
            background-color: #f4f6f9; /* Warna latar konten */
        }
        main {
            padding: 20px;
            flex: 1;
        }
    </style>
</head>
<body>

    <div class="wrapper">

        @include('admin.partials.sidebar')

        <div id="content-wrapper">

            @include('admin.partials.header')

            <main>
                {{-- Di sinilah halamanmu (kelola_iuran) akan dimuat --}}
                @yield('content')
            </main>

            @include('admin.partials.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')

</body>
</html>
