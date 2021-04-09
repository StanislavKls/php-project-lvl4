@extends('layouts.app')

@section('title', 'Метки')

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

    <h1 class="mb-5">Метки</h1>
    @auth
    <a href="{{ route('labels.create') }}" class="btn btn-primary">Создать метку</a>    
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Дата создания</th>
                @auth
                <th>Действие</th>
                @endauth
            </tr>
        </thead>
        @foreach ($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at->format('d.m.Y') }}</td>
                @auth
                <td>
                    <a
                        class="text-danger"
                        href="{{ route('labels.destroy', $label->id) }}"
                            data-method="delete"
                            data-confirm="Вы уверены?"
                    >Удалить</a>
                    <a href="{{ route('labels.edit', $label->id) }}">
                            Изменить </a>
                 </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection
