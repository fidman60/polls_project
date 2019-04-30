<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon joli site</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>
<header class="jumbotron">
    <div class="container">
        <h1  class="page-header">
            <a href="{{ url('poll') }}">Le site des sondages !</a>
        </h1>
        @if(auth()->check())
            <div class="btn-group pull-right">
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-info">Deconnexion</button>
                </form>
            </div>
        @else
            <a href="{{ url('login') }}" class="btn btn-info pull-right">Se connecter</a>
        @endif
    </div>
</header>
<div class="container">
    @yield('content')
</div>
@yield('scripts')
</body>
</html>