<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Item;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\Item_editRequest;
use App\Http\Requests\ItemImageRequest;
use App\Category;
use App\Like;
use App\User;

class ItemsController extends Controller
    {
        
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function top(){
        $user = \Auth::user();
        $items = Item::where('user_id','<>',$user->id)->latest()->get();
        return view('items.top',[
            'title'=>'FreeMaket',
            'items'=>$items,
            ]);
    }
    
        
    public function exhibitions(){
        $user = \Auth::user();
        $items = $user->items()->latest()->get();
        
        return view('users.exhibitions',[
            'title' => $user->name . 'さんの出品商品一覧',
            'user' => $user,
            'items' => $items,
            ]);
    }
    
    
    //トップページの一覧もここにする？
    public function index()
    {   $items = \Auth::user()->items;
        return view('items.index',[
            'title' => '出品商品一覧',
            'items' => $items,
            ]);
    }

   
    public function create()
    {   $categories = Category::all();
        return view('items.create',[
            'title'=>'商品を出品',
            'categories' => $categories,
            ]);
    }

    
    public function store(ItemRequest $request,FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        $category_id = Category::where('name',$request->category)->pluck('id')->first();
        
        Item::create([
            'user_id'=> \Auth::user()->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=> $path,
            'category_id' => $category_id,
            ]);
            session()->flash('success','商品を出品しました');
            return redirect()->route('users.exhibitions',\Auth::user());
    }

    public function show($id)
    {   $item = Item::find($id);
        $user = \Auth::user();
        return view('items.show',[
            'title' => '商品詳細',
            'item' => $item,
            'user' => $user,
            ]);
    }
   
   
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        $category_name = $item->category->name;
        // $category_id = $item->category_id;
        // $category_name = Category::where('id',$category_id)->pluck('name')->first();
        return view('items.edit',[
            'title' => '商品情報の編集',
            'item' => $item,
            'categories' => $categories,
            'category_name' => $category_name,
            ]);
    }

    
    public function update(Item_editRequest $request, $id)
    {
        $item = Item::find($id);
        $category_id = Category::where('name',$request->category)->pluck('id')->first();
        
        $item->update($request->only([
            'name',
            'description',
            'price',
            'category_id' => $category_id,
            ]));
        session()->flash('success','商品情報を更新しました');
        return redirect()->route('users.exhibitions',\Auth::user());
    }

   
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        \Session::flash('success', '商品を削除しました');
        return redirect()->route('users.exhibitions',\Auth::user());
    }
    
    public function edit_image($id){
        $item= Item::find($id);
        return view('items.edit_image',[
            'title'=>'画像変更',
            'item' => $item,
            ]);
    }
    
    public function update_image($id,ItemImageRequest $request,FileUploadService $service){
        $path = $service->saveImage($request->file('image'));
        $item = Item::find($id);
        
        if($item->image !==''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        
        $item->update([
            'image' => $path,
            ]);
            
        session()->flash('success','画像を変更しました');
        return redirect()->route('users.exhibitions',\Auth::user());
    }
    
    public function toggleLike($id){
          $user = \Auth::user();
          $item = Item::find($id);
 
          if($item->isLikedBy($user)){
              // 取り消し
              $item->likes->where('user_id', $user->id)->first()->delete();
              \Session::flash('success', 'お気に入りを取り消しました');
          } else {
              Like::create([
                  'user_id' => $user->id,
                  'item_id' => $item->id,
              ]);
              \Session::flash('success', 'お気に入りに登録しました');
          }
          return redirect()->route('likes.index');
      }
}
