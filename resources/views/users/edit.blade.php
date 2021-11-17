@extends('layouts.logged_in')

@section('title',$title)
@section('content')

    <h1>{{$title}}</h1>
    <form method="POST" action="{{route('users.update')}}">
        @csrf
        @method('patch')
        <div>
            <label>
                名前:
                <input type="text" name="name" value="{{$user->name}}">
            </label>
        </div>
        <div>
            <label>
                <p>プロフィール:</p>
                <textarea name="profile" rows="10" cols="50">{{$user->profile}}</textarea>
            </label>
        </div>
        <div>
            <input class="btn-border" type="submit" value="更新">
        </div>
    </form>
@endsection