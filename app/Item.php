<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Item extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = [
        'user_id','name', 'description', 'price','category','image','category_id',
    ];
    
    
     public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User','likes');
    }
    
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    
    public function category(){
        // itemは1つのカテゴリーに属する　こっちは$item->category-nameでいける
        return $this->belongsTo('App\Category');
    }
    
    public function order(){
        return $this->belongsTo('App\Order');
    }
    //$item->orders->created_atだとうまくいかないitemにたいしてorderはたくさんあることになる
    
    public function buy_users(){
      return $this->belongsToMany('App\User', 'orders');
    }
    
    public function isSold(){
        //これだと時間かかる
        //$result = Order::all()->pluck('item_id')->contains($this->id);
        $result = Order::where('item_id','=',$this->id)->count();
        return $result;
    }
    
    

}
