<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class busquedas extends Model
{
    //
    protected $table = 'busquedas';
    protected $primaryKey="bus_id";
    public $timestamps = false;
}
