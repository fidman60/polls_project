<?php

namespace App\Http\Controllers\Poll;

use App\Http\Requests\PollCreateRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Repositories\PollRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PollController extends Controller {
    private $pollRepository;

    private $nbrPerPage = 4;

    /**
     * PollController constructor.
     * @param $pollRepository
     */
    public function __construct(PollRepository $pollRepository){

        $this->pollRepository = $pollRepository;

        $this->middleware('auth')->except(['index','show']);

        $this->middleware(['admin'])->only(['create','store','destroy','update','edit']);

        $this->middleware('vote')->only(['edit']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $polls = $this->pollRepository->getPaginate($this->nbrPerPage);
        $votedPolls = [];

        if (auth()->check() && auth()->user()->admin)
            $votedPolls = $this->pollRepository->getVotedPolls();

        return view('polls.list',compact('polls','votedPolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollCreateRequest $request){
        $this->pollRepository->storePollWithAnswers($request->input('question'),$request->input('answers'));
        return redirect('poll')->with('info','Le sondage a été bien ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $poll = $this->pollRepository->getPollWithAnswers($id);
        $done = $this->pollRepository->polled($id,Auth::id());
        $total = $this->pollRepository->getTotalAnswersByPoll($id);
        return view('polls.results',compact('poll','done','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $poll = $this->pollRepository->getPollWithAnswers($id);
        return view('polls.edit',compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PollUpdateRequest $request, $id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->pollRepository->deletePoll($id);
        return redirect('poll')->with('info','Le sendage a été bien supprimer !');
    }
}
