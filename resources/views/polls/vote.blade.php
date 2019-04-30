@extends('templates.template')

@section('content')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">{{ $poll->question }}</div>
            <div class="panel-body">
                <form method="post" action="{{ route('store.vote') }}">
                    @csrf
                    @foreach($answers as $answer)
                        <div class="radio">
                            <label>
                                <input type="radio" name="answer_id" value="{{ $answer->id }}"> {{ $answer->answer }}
                            </label>
                        </div>
                    @endforeach
                    <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                    <button class="btn btn-info pull-right">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
@endsection