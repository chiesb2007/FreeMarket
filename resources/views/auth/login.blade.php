@extends('layouts.not_logged_in')

@section('content')

<h1>ログイン</h1>
<form method="POST" action="{{route('login')}}">
    @csrf
    <div>
        <label>
            メールアドレス:
            <input type="email" name="email">
        </label>
    </div>
    <div>
        <label>
            パスワード:
            <input type="password" name="password">
        </label>
    </div>
    <div>
        <input class="btn-border" type="submit" value="ログイン">
    </div>
</form>
@endsection