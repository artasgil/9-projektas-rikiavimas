<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Company extends Model
{
    public function companyType() {
        return $this->belongsTo(Type::class,'type_id', 'id');
    }


    use Sortable;

    protected $table="companies";

    protected $fillable = ["title", "description", "type_id"];

    public $sortable = ["id", "title", "description", "type_id"];
}
