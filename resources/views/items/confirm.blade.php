@extends('layouts.logged_in')
@section('title',$title)
@section('content')
    <h1>{{$title}}</h1>
    <dl>
        <dt>出品者：{{$item->user->name}} さん/ 出品日時：{{$item->created_at}}</dt>
        @if($item->image !== '')
            <dd><img src="{{asset('storage/' . $item->image)}}">{{$item->description}}</dd>
        @else
            <dd><img src="{{asset('images/no_image.png')}}"></dd>
        @endif
        <dt>商品名</dt>
            <dd>{{$item->name}}</dd>
        <dt>価格</dt>
            <dd>￥{{$item->price}}</dd>
        <dt>カテゴリ</dt>
            <dd>{{$item->category->name}}</dd>
    </dl>
    <form method="post" action="{{route('items.finish',$item)}}">
        @csrf
        <input type="hidden" name="order_id" value="{{ $item->id }}">
        <input  class="btn-border" type="submit" value="内容を確認し、購入する">
    </form>
@endsection('content')