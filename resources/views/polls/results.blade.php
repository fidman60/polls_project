@extends('templates.template')

@section('content')
    <br>
    <div class="col-sm-offset-3 col-sm-6">

        <!-- Informations en alertes -->
        @if(auth()->guest())
            <div class="alert alert-warning">Vous devez être connecté pour participer aux sondages !</div>
        @elseif($done)
            @if(session('info'))
                <div class="alert alert-success">{{ session('info') }}</div>
            @else
                <div class="alert alert-warning">Vous avez déjà participé à ce sondage !</div>
            @endif
        @endif

        <div class="panel panel-primary">
            <div class="panel-heading">
                {{ $poll->question }}
                @if(auth()->check() && !$done)
                    <a href="{{ url("vote/{$poll->id}") }}" class="btn btn-info btn-xs pull-right">Votez vous aussi !</a>
                @endif
            </div>
            <div class="panel-body">
                <p>Voici les résultats actuels :</p>

                <!-- Balayage de toutes les réponses -->
                @foreach ($poll->answers as $index => $answer)
                    <p>
                        <strong>{{ $answer->answer }}</strong> : {{ $answer->result }}
                        @if ($answer->result > 1) votes	@else vote	@endif
                    </p>
                    <div class="progress">
                        <?php $pourcentage = $total == 0 ? 0 : number_format($answer->result / $total * 100) ?>
                        <div class="progress-bar progress-bar-success" style="width: {{ $pourcentage }}%;">
                            {{ $pourcentage }} %
                        </div>
                    </div>
            @endforeach
            </div>
        </div>

        @if(!session('info'))
            <a href="javascript:history.back()" class="btn btn-primary">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        @else
            <a href="{{ url('poll') }}" class="btn btn-primary">Retour à l'accueil</a>
        @endif

    </div>
@endsection