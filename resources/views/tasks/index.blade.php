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

    <div class="d-flex">
    <div>
        {{Form::open(['method' => 'GET', 'class' => 'form-inline'])}}
            <select class="form-control mr-2" name="filter[status_id]"><option value="">Статус</option>
                @foreach ($statuses as $status)
                    @if ($status->id == $currentStatus)
                        <option selected="selected" value="{{ $status->id }}">{{ $status->name }}</option>
                    @else
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                     @endif 
                @endforeach
            </select>

            <select class="form-control mr-2" name="filter[created_by_id]"><option selected="selected" value="">Автор</option>
                @foreach ($users as $user)
                    @if ($user->id == $currentCreated)
                        <option selected="selected" value="{{ $user->id }}">{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endif 
                @endforeach
            </select>

            <select class="form-control mr-2" name="filter[assigned_to_id]"><option selected="selected" value="">Исполнитель</option>
            @foreach ($users as $user)
                    @if ($user->id == $currentAssigned)
                        <option selected="selected" value="{{ $user->id }}">{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endif 
                @endforeach
            </select>
            <input class="btn btn-outline-primary mr-2" type="submit" value="Применить">
        {{Form::close()}}
        </div>
    @auth
        <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">Создать задачу</a><br>  
    @endauth
    </div>

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
                <td>{{ $task->created_at->format('d.m.Y') }}</td>
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