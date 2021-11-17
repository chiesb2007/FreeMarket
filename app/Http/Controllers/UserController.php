<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Services\FileUploadService;
use App\Category;
use App\Item;
use App\Order;

class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(){
        //$user = User::find($id);
        $user = \Auth::user();
        return view('users.edit',[
            'title' => 'プロフィール編集',
            'user' => $user,
            ]);
    }
    
    public function update(UserRequest $request){
        //$user = User::find($id);
        $user = \Auth::user();
        $user->update($request->only([
            'name',
            'profile'
            ]));
        session()->flash('success','プロフィールを更新しました');
        return redirect()->route('users.show');
    }
    
    public function edit_image(){
        $user= \Auth::user();
        return view('users.edit_image',[
            'title'=>'画像変更',
            'user' => $user,
            ]);
    }
    
    public function update_image(UserImageRequest $request,FileUploadService $service){
        $path = $service->saveImage($request->file('image'));
        $user = \Auth::user();
        
        if($user->image !==''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
            'image' => $path,
            ]);
            
        session()->flash('success','画像を変更しました');
        return redirect()->route('users.show');
    }
    
    public function show(){
        $user= \Auth::user();
        $items_count = $user->items->count();
        //$onsell_items_count = $user->onsell_items()->count();
        $items_id = $user->items->pluck('id')->toArray();
        $solditems = Order::whereIn('item_id' ,$items_id);
        $onSale = $user->items->whereNotIn('id', $solditems->pluck('item_id')->toArray());
        
        return view('users.show',[
            'title' => 'プロフィール',
            'user' => $user,
            'items_count' => $items_count,
            'solditems' => $solditems->count(),
            'onSale' => $onSale->count(),
            ]);
    }
    
}

