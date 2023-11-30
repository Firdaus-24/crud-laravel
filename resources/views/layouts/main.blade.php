<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Test</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment('1') == 'kategoris' ? 'active' : '' }}"
                            aria-current="page" href="{{ url('kategoris') }}">Kategoris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment('1') == 'jenis' ? 'active' : '' }}" aria-current="page"
                            href="{{ url('jenis') }}">Jenis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment('1') == 'barangs' ? 'active' : '' }}"
                            href="{{ url('barangs') }}">Barangs</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('container')
    </div>
</body>
<script src="{{ asset('/') }}build/assets/jquery.js"></script>
<script src="{{ asset('/') }}build/assets/script.js"></script>

</html>
