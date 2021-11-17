$@extends('layouts.logged_in')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    <form method="POST" action="{{route('items.update',$item)}}">
        @csrf
        @method('patch')
        <dl>
            <dt><label>商品名:</dt>
                <dd><input type="text" name="name" value="{{$item->name}}"></label></dd>
                
            <dt><label>商品説明:</dt>
                <dd><textarea name="description" rows=10 cols=50>{{$item->description}}</textarea></dd>
                
            <dt><label>価格:</dt>
                <dd><input type="number" name="price" value="{{$item->price}}"></label></dd>
                
            <dt><label>カテゴリー:</dt>
                <dd>
                    <select name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->name}}" 
                                @if($category->name === $category_name)
                                selected
                                @endif
                                >{{$category->name}}</option>
                        @endforeach
                    </select>
                </label></dd>
        </dl>
        <input class="btn-border" type="submit" value="出品">
    </form>
@endsection