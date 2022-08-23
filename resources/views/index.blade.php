<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-lt-installed="true">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">
    <title>Анализатор страниц</title>
    @vite(['resources/js/app.js'])
</head>
<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="https://php-project-lvl-3.herokuapp.com/">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="https://php-project-lvl-3.herokuapp.com/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="https://php-project-lvl-3.herokuapp.com/urls">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="flex-grow-1">
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">Анализатор страниц</h1>
                <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
                <form action="https://php-page-analyzer-ru.hexlet.app/urls" method="post" class="d-flex justify-content-center">
                    <input type="hidden" name="_token" value="sqci7mIDM8waWiNmnzoJjMV1V2Sskwd4u51BgjiM"> <label>
                        <input type="text" name="url[name]" value="" class="form-control form-control-lg" placeholder="https://www.example.com">
                    </label>
                    <input type="submit" class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" value="Проверить">
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="border-top py-3 mt-5 flex-shrink-0">
    <div class="container-lg">
        <div class="text-center">
            <a href="https://github.com/AslanAV" target="_blank">Aslan Autlev</a>
        </div>
    </div>
</footer>


</body>
</html>
