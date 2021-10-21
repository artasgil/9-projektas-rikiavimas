<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Type extends Model
{
    use Sortable;

    protected $table="types";

    protected $fillable = ["title", "description"];

    public $sortable = ["id", "title", "description"];
}
