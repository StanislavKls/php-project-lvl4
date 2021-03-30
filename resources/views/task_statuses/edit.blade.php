@extends('layouts.app')

@section('title', 'Создать статус')

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
<h1 class="mb-5">Изменить статус</h1>
{{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'class' => 'w-50', 'method' => 'PATCH']) }}
    @csrf
    <div class="form-group">
    {{ Form::label('name', 'Название') }}
    {{ Form::text('name', $taskStatus->name, ['class' => 'form-control', 'id' => 'name']) }}<br>
    </div>
    {{ Form::submit('Изменить', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}
@endsection
