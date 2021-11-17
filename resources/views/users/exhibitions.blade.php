@extends('layouts.logged_in')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    <a class="btn-new" href="{{route('items.create')}}">新規出品</a>
    @forelse($items as $item)
        <section class="item_list">
            <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? 'お気に入り解除':'お気に入り登録' }}</a>
            <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                @csrf
                @method('patch')
            </form>
            @if($item->isSold() !== 0)
                <p class="sold">売り切れ</p>
            @else
                <p class="sell">出品中</p>
            @endif
            <p class="item_name">商品NO.{{$item->id}} | 出品日時：{{$item->created_at}}</p>
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
                </dl>
            </div>
            <div class="flex">
                <a class="btn-new" href="{{route('items.edit',$item)}}">編集</a>
                <a class="btn-new" href="{{route('items.edit_image',$item)}}">画像を変更</a>
                <form method="POST" action="{{route('items.destroy',$item)}}">
                    @csrf
                    @method('delete')
                    <input class="delete" type="submit" value="削除">
                </form>
            </div>
        </section>
    @empty
        <p>出品している商品はありません</p>
    @endforelse
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      /* global $ */
      $('.like_button').on('click', (event) => {
          $(event.currentTarget).next().submit();
      })
    </script>
@endsection