<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   //カテゴリーは複数のアイテムを持つ
    public function item(){
        return $this->hasMany('App\Item');
    }
  
}
