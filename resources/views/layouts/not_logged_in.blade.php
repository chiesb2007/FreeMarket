@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li>
            <a class="header_link" href="{{route('register')}}">ユーザー登録</a>
        </li>
        <li>
            <a class="header_link" href="{{route('login')}}">ログイン</a>
        </li>
    </ul>    
</header>

@endsection