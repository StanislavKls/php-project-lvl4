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
                <td>Имя</td> <td>{{ $task->name }}</td> 
            </tr>
            <tr>
                <td>Дата создания</td><td>{{ $task->created_at->format('d.m.Y') }}</td>
            </tr>
            <tr>
                <td>Автор</td><td>{{ $task->createdBy->name }}</td>
            </tr>
            <tr>
                <td>Исполнитель</td><td>{{ $task->assignedTo->name ?? null}}</td>
            </tr>
            <tr>
                <td>Описание</td><td>{{ $task->description }}</td>
            </tr>     
            <tr>    
                <td>Статус</td><td>{{ $task->status->name }}</td>
            </tr>
            <tr>    
                <td>Метки</td><td>
                                @foreach($task->labels as $label)
                                    {{ $label->name }} 
                                @endforeach
                              </td>
            </tr> 
            @auth
            <tr>    
                <td>Действие</td>
                    <<td>
                        <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                        @can('delete', $task)
                        | <a class="text-danger" href="{{ route('tasks.destroy', $task->id) }}"
                                data-method="delete"
                                data-confirm="Вы уверены?"
                        >Удалить</a>
                    @endcan    
                    </td>
            </tr>
            @endauth
    </table>
@endsection