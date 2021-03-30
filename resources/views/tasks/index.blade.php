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
    <h1 class="mb-5">Задачи</h1>
    @auth
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Создать задачу</a>    
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Автор</th>
                <th>Исполнитель</th>
                <th>Дата создания	</th>
                @auth
                <th>Действие</th>
                @endauth
            </tr>
        </thead>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name}}</td>
                <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                <td>{{ $task->createdBy->name }}</td>
                <td>{{ $task->assignedTo->name ?? null}}</td>
                <td>{{ $task->created_at }}</td>
                @auth
                <td>
                      <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a> 
                    @can('delete', $task)
                        | <a class="text-danger" href="{{ route('tasks.destroy', $task->id) }}"
                                data-method="delete"
                                data-confirm="Вы уверены?"
                        >Удалить</a>
                    @endcan    
                </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection