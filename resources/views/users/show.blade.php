@extends('layouts.app')

@section('title', 'Listagem do Usuário')

@section('content')
<h1>Listagem do usuário {{ $user->name }}</h1>

<ul class="text-2-1 font-semibold leading-tigh py-2">
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
</ul>

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @method('DELETE')
    @csrf <!--segurança apra o formulario laravel-->
    <button type="submit" class="rounded-full bg-red-400">Deletar</button>
</form>

@endsection