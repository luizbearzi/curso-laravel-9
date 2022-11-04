@extends('layouts.app')

@section('title', "Novo Comentário Para o Usuário {$user->name}")

@section('content')
<h1 class="text-2x1 font-semibold">
    Novo Comentário Para o Usuário {{$user->name}}
</h1>

@include('includes.validations-form')

<form action="{{ route('comments.store', $user->id) }}" method="post">
    @csrf <!--previne ataques csrf-->
    @include('users.comments._partials.form')
</form>

@endsection