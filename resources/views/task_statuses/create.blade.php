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
<h1 class="mb-5">Создать статус</h1>
{{ Form::model($status, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
    @csrf
    <div class="form-group">
    <label for="name">Имя</label>
    {{ Form::text('name', $status->name, ['class' => 'form-control', 'type' => 'text', 'id' => 'name']) }}
    </div>
    {{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}
@endsection