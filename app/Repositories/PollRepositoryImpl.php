<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/04/2019
 * Time: 17:34
 */

namespace App\Repositories;


use App\Models\Answer;
use App\Models\Poll;

use DB;

class PollRepositoryImpl implements PollRepository {

    private $poll;

    /**
     * PollRepositoryImpl constructor.
     * @param $poll
     */
    public function __construct(Poll $poll){
        $this->poll = $poll;
    }

    public function getPaginate($n){
        return $this->poll->paginate($n);
    }

    public function getPollWithAnswers($id){
        return $this->poll->where('id',$id)->with('answers')->first();
    }

    public function getTotalAnswersByPoll($idPoll){
        return (int)DB::table('answers')->select(DB::raw('SUM(answers.result) total'))->whereRaw('poll_id = ?',$idPoll)->first()->total;
    }

    public function polled($idPoll, $idUser){
        return DB::table('poll_user')
            ->whereRaw('poll_id = ? and user_id = ?',[$idPoll,$idUser])
            ->exists();
    }

    public function storeVote($inputs){
        try{
            DB::beginTransaction();

            DB::table('answers')
                ->where('id',(int)$inputs['answer_id'])
                ->update(['result' => DB::raw('result + 1')]);

            \App\Models\User::find((int)$inputs['user_id'])
                ->polls()->attach((int)$inputs['poll_id']);

            DB::commit();
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            DB::rollBack();
        }
    }

    public function getVotedPolls(){
        return DB::table('poll_user')->distinct('poll_id')->pluck('poll_id')->all();
    }

    public function polledByAnyOne($pollId){
        return DB::table('poll_user')->where('poll_id', $pollId)->exists();
    }

    public function deletePoll($pollId){
        $this->poll->findOrFail($pollId)->delete();
    }

    private function createAnswersModels($answers){
        $answersModel = [];
        foreach ($answers as $answer){
            array_push($answersModel,new Answer([
                'answer' => $answer
            ]));
        }
        return $answersModel;
    }

    public function storePollWithAnswers($question, array $answers){
        $poll = new Poll([
            'question' => $question
        ]);
        $answers = $this->createAnswersModels($answers);

        DB::transaction(function () use ($poll,$answers){
            $poll->save();
            $poll->answers()->saveMany($answers);
        });
    }


}