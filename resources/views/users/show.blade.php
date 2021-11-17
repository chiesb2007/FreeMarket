@extends('layouts.logged_in')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    <section class="item_list">
        <p class="item_name">プロフィール</p>
        <div class="flex">
            <div>
                @if($user->image !== '')
                    <img src="{{asset('storage/' . $user->image)}}">
                @else
                    <img src="{{asset('images/no_image_man.png')}}">
                @endif
                <p><a class="btn-border" href="{{route('users.edit_image')}}">画像を変更</a></p>
            </div>
            <dl class="profile_list">
                <dt>名前</dt>
                    <dd>{{$user->name}}</dd>
                <dt>出品総数</dt>
                    <dd>　　{{$items_count}}点</dd>
                <dt>出品中の商品数</dt>
                    <dd>　　　{{$onSale}}点</dd>
                 @if($user->profile !=='')
                    <div class="profile">
                        <dt>プロフィール</dt>
                            <dd>{{$user->profile}}</dd>
                    </div>
                @else
                    <p>プロフィールが設定されていません</p>
                @endif
                <a class="btn-border" href="{{route('users.edit')}}">編集</a>
            </dl>
        </div>
    </section>
    <h2>購入履歴</h2>
        @forelse($user->orders as $order)
            <dl class="order_list">
                <p>出品者：{{$order->user->name}}さん | 購入日時：{{$order->created_at}}</p>
                <dt>商品名</dt>
                    <dd>{{$order->item->name}}</dd>
                <dt>価格</dt>
                    <dd>￥{{$order->item->price}}</dd>
                <dt>カテゴリ</dt>
                    <dd>{{$order->item->category->name}}</dd>
            </dl>
        @empty
            <p>購入した商品はありません</p>
        @endforelse
@endsection