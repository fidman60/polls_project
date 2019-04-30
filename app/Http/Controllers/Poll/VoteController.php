<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoteRequest;
use App\Repositories\PollRepository;
use Auth;

class VoteController extends Controller {

    private $pollRepository;

    /**
     * VoteController constructor.
     * @param $pollRepository
     */
    public function __construct(PollRepository $pollRepository){
        $this->pollRepository = $pollRepository;

        $this->middleware('auth');
    }

    public function create($idPoll){
        $poll = $this->pollRepository->getPollWithAnswers($idPoll);
        $answers = $poll->answers;
        return view('polls.vote',compact('poll','answers'));
    }

    public function store(VoteRequest $request){
        $data = array_merge($request->input(),['user_id' => Auth::id()]);
        $message;

        if(isset($data['poll_id']) && !$this->pollRepository->polled($data['poll_id'],Auth::id())){
            $this->pollRepository->storeVote($data);
            $message = 'Merci d\'avoir participer à ce sondage';
        } else $message = 'Desolé, vous avez déjà participé à ce sondage';

        return redirect()->route('poll.show',$data['poll_id'])->with('info',$message);
    }

}
