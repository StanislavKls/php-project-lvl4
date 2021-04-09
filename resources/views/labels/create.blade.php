@extends('layouts.app')

@section('title', 'Создать метку')

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

<h1 class="mb-5">Создать метку</h1>
{{ Form::model($label, ['url' => route('labels.store'), 'class' => 'w-50']) }}
    @csrf
    <div class="form-group">
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name', $label->name, ['class' => 'form-control', 'type' => 'text', 'id' => 'name']) }}
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description', $label->description, ['class' => 'form-control', 'type' => 'text', 'id' => 'description']) }}
    </div>
    {{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}
@endsection
