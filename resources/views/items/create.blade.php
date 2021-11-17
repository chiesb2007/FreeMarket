@extends('layouts.logged_in')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    <form method="post" action="{{route('items.store')}}" enctype="multipart/form-data">
        @csrf
        <dl>
            <dt><label>商品名:</dt>
                <dd><input type="text" name="name"></label></dd>
                
            <dt><label>商品説明:</dt>
                <dd><textarea name="description" rows=10 cols=50></textarea></dd>
                
            <dt><label>価格:</dt>
                <dd><input type="number" name="price"></label></dd>
                
            <dt><label>カテゴリー:</dt>
                <dd>
                <!--<dd @if(!empty($errors->first('category'))) has-error @endif>-->
                    <select name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->name}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </label></dd>
                
            <dt><label>画像を選択:</dt>
                <dd><input type="file" name="image"></label></dd>
        </dl>
        <input class="btn-border" type="submit" value="出品">
    </form>
@endsection