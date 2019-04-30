@extends('templates.template')

@section('content')
    <div class="col-sm-offset-3 col-sm-6">
        <br>
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @else
            <div class="panel panel-primary">
                <div class="panel-heading">Oubli du mot de passe, entrez votre email :</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <form method="post" action="{{ url('password/email') }}">
                            @csrf
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                @if($errors->has('email'))
                                    <small class="help-block">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <button class="btn btn-primary pull-right">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        @endif
    </div>
@endsection
