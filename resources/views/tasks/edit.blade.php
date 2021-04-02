@extends('layouts.app')

@section('title', 'Создать задачу')

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
<h1 class="mb-5">Изменить задачу</h1>
{{ Form::model($task, ['url' => route('tasks.update', $task), 'class' => 'w-50', 'method' => 'PATCH']) }}
    @csrf
    <div class="form-group">
        {{ Form::label('name', 'Имя') }}
        {{ Form::text('name', $task->name, ['class' => 'form-control', 'id' => 'name']) }}
        {{ Form::label('description', 'Описание') }}
        {{ Form::textarea('description', $task->description, ['class' => 'form-control', 'id' => 'description', 'cols' => '50', 'rows' => '10']) }}
        
        {{ Form::label('status_id', 'Статус') }}
        <select class="form-control"  id="status_id" name="status_id"><option selected="selected" value="{{ $task->status->id }}">{{ $task->status->name }}</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
        
        <input type="hidden" name="created_by_id" value="{{ $task->created_by_id }}">

        {{ Form::label('assigned_to_id', 'Исполнитель') }}
        <select class="form-control"  id="assigned_to_id" name="assigned_to_id"><option selected="selected" value="{{ $task->assignedTo->id ?? null }}">{{ $task->assignedTo->name ?? null }}</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        
        {{ Form::label('labels', 'Метки') }}
        <select multiple="multiple" class="form-control" id="labels" name="labels[]">
        @foreach ($labels as $label);
            @if ($lablesOfTask->contains($label->name))
                <option selected="selected" value="{{ $label->id }}">{{ $label->name }}</option>
            @else
                <option value="{{ $label->id }}">{{ $label->name }}</option>
            @endif 
        @endforeach
        </select>
    </div>

    {{ Form::submit('Обновить', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}

@endsection
