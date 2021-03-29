@extends('layouts.app')

@section('title', 'Статусы')

@section('content')
@include('flash::message')
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
    <h1 class="mb-5">Статусы</h1>
    @auth
    <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">Создать статус</a>    
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                @auth
                <th>Действие</th>
                @endauth
            </tr>
        </thead>
        @foreach ($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                @auth
                <td>
                    <a
                        class="text-danger"
                        href="{{ route('task_statuses.destroy', $status->id) }}"
                            data-method="delete"
                            data-confirm="Вы уверены?"
                    >Удалить</a>
                    <a href="{{ route('task_statuses.edit', $status->id) }}">
                            Изменить </a>
                 </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection