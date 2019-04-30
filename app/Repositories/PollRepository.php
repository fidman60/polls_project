<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/04/2019
 * Time: 17:31
 */

namespace App\Repositories;

interface PollRepository {

    public function getPaginate($n);

    public function getPollWithAnswers($id);

    public function getTotalAnswersByPoll($pollId);

    public function polled($pollId,$userId);

    public function storeVote($inputs);

    public function getVotedPolls();

    public function polledByAnyOne($pollId);

    public function deletePoll($pollId);

    public function storePollWithAnswers($question,array $answers);

}