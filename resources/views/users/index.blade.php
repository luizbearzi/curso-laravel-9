@extends('layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
<h1 class="text-2x1 font-semibold">
    Listagem dos usuários
    <a href="{{ route('users.create') }}" class="bg-blue-900 rounded-full text-white px-4 text-sm">+</a>
</h1> 

<form action="{{ route('users.index') }}" method="get">
    <input type="text" name="search" placeholder="Pesquisar..">
    <button class="shadow bg-purple-500 hover:bg-purple-900 rounded-full text-white px-4 text-sm">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">
                Nome
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                E-mail
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                Detalhes
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                Editar
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                Comentários (0)
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td class="px-5 py-5 border-b border-gra-400">
                @if ($user->name)
                    <img src="{{ url("storage/{$user->image}")}}" alt="{{ ($user->name) }}" class="object-cover w-20">
                @else
                    <img src="{{ url("images/favicon.ico")}}" alt="{{ ($user->name) }}" class="object-cover w-20">
                @endif
                {{ $user->name }} </td>
            <td class="px-5 py-5 border-b border-gra-400"> {{ $user->email }} </td>
            
            <td class="px-5 py-5 border-b border-gra-500 bg-green-600 rounded-md
             text-white"> <a href="{{ route('users.show', $user->id)}}">Detalhes</a> 
            </td>
            
             <td class="px-5 py-5 border-b border-gra-400 px-5 py-5 border-b
             border-gra-500 bg-red-600 rounded-md text-white">
            <a href="{{ route('users.edit', $user->id)}}">Editar</a> 
            </td>

            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm px-5 py-5 border-b
              bg-orange-600 rounded-md py-2 px-6">
            <a href="{{ route('comments.index', $user->id)}}">Anotações ({{ $user->comments->count() }})</a> 
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="py-4">
    {{ $users->appends([
        'search' => request()->get('search', '')
    ])->links() }}
</div>
@endsection