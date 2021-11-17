<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Item;

class OrderController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function confirm($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        return view('items.confirm',[
            'title' => '購入確認',
            'item' => $item,
            ]);
    }
    
    public function finish(Request $request,$id){
        $user = \Auth::user();
        $item = Item::find($id);
        Order::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            ]);
        \Session::flash('success', 'ご購入ありがとうございました');
        return redirect()->route('top');
    }
    
 
}
