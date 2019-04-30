<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28/04/2019
 * Time: 01:43
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class PollFacade extends Facade {

    protected static function getFacadeAccessor(){
        return 'poll_repository';
    }

}