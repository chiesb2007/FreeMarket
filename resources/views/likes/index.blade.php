@extends('layouts.logged_in')
@section('title',$title)
@section('content')
    <h1>{{$title}}</h1>
    @forelse($like_items as $item)
        <section class="item_list">
            @if($item->isSold() !== 0)
                    <p class="sold">売り切れ</p>
                @else
                    <p class="sell">出品中</p>
                @endif
            <p class="item_name">出品者：{{$item->user->name}} さん | 出品日時：{{$item->created_at}}</p>
            <div class="flex">
                @if($item->image !== '')
                    <a href="{{route('items.show',$item)}}"><img src="{{asset('storage/' . $item->image)}}"></a>
                @else
                    <img src="{{asset('images/no_image.png')}}">
                @endif
                <dl class="item">
                    <p class="item_des">{{$item->description}}</p>
                    <dt>商品名</dt>
                        <dd>{{$item->name}}</dd>
                    <dt>価格</dt>
                        <dd>￥{{$item->price}}</dd>
                    <dt>カテゴリ</dt>
                        <dd>{{$item->category->name}}</dd>
            </div>
                @if($item->isSold() !==0 && $item->user->id !== $user->id)
                @elseif($item->user->id !== $user->id)
                    <form action="{{route('items.confirm',$item)}}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $item->id }}">
                        <input class="btn-border" type="submit" value="購入する">
                    </form>
                @endif
                </dl>
        </section>
    @empty
        <p>お気に入りに登録している商品はありません</p>
    @endforelse
@endsection('content')