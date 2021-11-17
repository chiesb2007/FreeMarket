@extends('layouts.default')

@section('header')
    
<header>
    <ul class="header_nav">
        <li>
            <a class="header_link" href="{{route('top')}}">FreeMaket</a>
        </li>
        <li>
            <a class="header_link" href="{{route('users.show')}}">プロフィール</a>
        </li>
        <li>
            <a class="header_link" href="{{route('likes.index')}}">お気に入り一覧</a>
        </li>
        <li>
            <a class="header_link" href="{{route('users.exhibitions')}}">出品商品一覧</a>
        </li>
        <li>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <input class="logout" type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
    @auth
        <p class="header_user">{{Auth::user()->name}}さん！　こんにちは！！</p>
    @endauth
</header>
@endsection