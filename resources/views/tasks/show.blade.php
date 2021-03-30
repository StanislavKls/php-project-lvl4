@extends('layouts.app')

@section('title', 'Статусы')

@section('content')
    @include('flash::message')

    <h1 class="mb-5">Задача {{ $task->name }}</h1>
    <table class="table mt-2">
            <tr>
                <td>ID</td> <td>{{ $task->id }}</td> 
            </tr>
            <tr>
                <td>Дата создания</td><td>{{ $task->created_at }}</td>
            </tr>
            <tr>    
                <td>Имя</td><td>{{ $task->status->name }}</td>
            </tr>
            <tr>
                <td>Описание</td><td>{{ $task->description }}</td>
            </tr>
            <tr>
                <td>Автор</td><td>{{ $task->createdBy->name }}</td>
            </tr>
            <tr>
                <td>Описание</td><td>{{ $task->assignedTo->name ?? null}}</td>
            </tr>
            <tr>
                <td>Описание</td><td>{{ $task->created_at }}</td>
            </tr>        
            @auth
            <tr>    
                <td>Действие</td><<td><a href="{{ route('tasks.edit', $task->id) }}">Изменить</a></td>
            </tr>
            @endauth
    </table>
@endsection