@extends('welcome')
@section('title', 'Сокращатель')
@section('content')
    <div>
        <h1>Сокращатель</h1>
    </div>
    <div>
        <form method="post" action="{{ route('create') }}">
            @csrf
            <input name="link" type="url" placeholder="Введите ссылку">
            <button type="submit">Сократить</button>
        </form>
    </div>
@endsection
