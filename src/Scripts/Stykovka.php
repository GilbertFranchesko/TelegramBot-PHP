<?php

namespace Sync\Bot\Scripts;

class Stykovka
{

    public $token;

    function __construct()
    {
        var_dump("Hello");
    }

    public function setToken($storeToken)
    {
        $this->token = $storeToken;
        return true;
    }

    public function showToken()
    {
        return $this->token;
    }

}