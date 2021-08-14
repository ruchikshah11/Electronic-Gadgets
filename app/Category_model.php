<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_model extends Model
{
    protected $table='categories';
    protected $primaryKey='id';
    protected $fillable=['parent_id','name','description','url','status'];

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];

    

}