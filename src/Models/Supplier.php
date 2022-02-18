<?php

namespace Sync\Bot\Models;

use Sync\Bot\Scripts\Stykovka;

class Supplier
{
    public $supplierID;
    public $container;
    public $chatID;

    function __construct($supplierID, $container, $chatID)
    {
        $this->supplierID = $supplierID;
        $this->container = $container;
        $this->chatID = $chatID;
        
    }
}