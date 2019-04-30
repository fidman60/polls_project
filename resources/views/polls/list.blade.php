@extends('templates/template')

@section('content')
    <br>
    <div class="col-sm-offset-3 col-sm-6">

        <!-- Affichage des alertes -->
        @if(session()->has('info'))
            <div class="alert alert-success">{{ session('info') }}</div>
        @endif

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des sondages</h3>
            </div>

            <table class="table">
                @foreach ($polls as $poll)
                    <tr>
                        <td class="text-primary"><strong>{{ $poll->question }}</strong></td>
                        <td>
                            <a href="{{ route('poll.show',$poll->id) }}" class="btn btn-success btn-block">Voir</a>
                        </td>
                        @if(auth()->check() && auth()->user()->admin)
                            <td>
                                <a href="{{ route('poll.edit',$poll->id) }}" {{ in_array($poll->id,$votedPolls) ? 'disabled' : '' }} class="btn btn-warning btn-block">Modifier</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('poll.destroy',$poll->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-block" onclick="return confirm('Voulez-vous vraiment supprimer ce sondage ?')">Supprimer</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        @if(auth()->check() && auth()->user()->admin)
            <a href="{{ route('poll.create') }}" class="btn btn-info pull-right">Ajouter un sondage</a>
        @endif

        <!-- Pagination -->
        {!! $polls->render(); !!}

    </div>
@endsection