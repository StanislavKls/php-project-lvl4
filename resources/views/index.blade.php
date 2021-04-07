@extends('layouts.app')

@section('title', 'Главная')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @include('flash::message')
    </div>
@endif

<div class="jumbotron">
    <h1 class="display-4">Привет от Хекслета!</h1>
    <p class="lead">Заключительный проект курса от Hexlet по профессии PHP-программист.</p>
    <p class="lead">Task Manager – система управления задачами. Она позволяет ставить задачи, назначать исполнителей и менять их статусы. Для работы с системой требуется регистрация и аутентификация.</p>
</div>

@endsection
