<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
use PollRepo;

class VoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        //$data = $this->request->all();
        //return isset($data['poll_id']) && Auth::check() && !PollRepo::polled($data['poll_id'],Auth::id());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            //
        ];
    }
}
