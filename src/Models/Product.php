<?php

namespace Sync\Bot\Models;

class Product
{
    public $name;
    public $model;
    public $supplier;
    public $countOrders;


    function __construct(
        $name = null,
        $model = null,
        $supplier = null,
        $countOrders = null
    )
    {
        $this->name = $name;
        $this->model = $model;
        $this->supplier = $supplier;
        $this->countOrders = $countOrders;
    }


}