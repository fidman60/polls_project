@extends('templates.template')

@section('content')
    <form method="post" action="{{ route('poll.store') }}" class="form-horizontal panel">
        @csrf
        <p><strong>Question</strong></p>
        <div class="form-group">
            <input type="text" name="question" class="form-control" placeholder="Question" value="{{ old('question') }}">
            @if($errors->has("question"))
                <small class="help-block">{{ $errors->first("question") }}</small>
            @endif
        </div><hr>
        <div id="answers">
            <p><strong>Réponses</strong></p>
            @for($i = 0; $i < 3; $i++)
                <div class="row ligne">
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="text" name="answers[]" class="form-control" value="{{ old("answers.{$i}") }}">
                            @if($errors->has("answers.{$i}"))
                                <small class="help-block">{{ $errors->first("answers.{$i}") }}</small>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger">Supprimer</button>
                        </div>
                    </div>
                </div>
            @endfor
        </div><hr>
        <div class="row">
            <button id="add_answer" type="button" class="btn btn-primary pull-right">Ajouter une réponse</button>
        </div><hr>
        <div class="form-group">
            <button class="btn btn-primary pull-right">Envoyer</button>
        </div>
    </form>
@endsection