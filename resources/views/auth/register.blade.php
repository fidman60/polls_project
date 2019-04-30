@extends('templates.template')

@section('content')
    <div class="col-sm-offset-3 col-sm-6">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Inscrivez-vous !</div>
            <div class="panel-body">
                <!-- Formulaire de création -->
                <form method="post" action="{{ url('register') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <input type="text" name="name" class="form-control" placeholder="Nom">
                        @if($errors->has('name'))
                            <small class="help-block">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        @if($errors->has('email'))
                            <small class="help-block">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                        @if($errors->has('password'))
                            <small class="help-block">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmation">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>

        <!-- Bouton de retour à la page précédente -->
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>

    </div>
@endsection
