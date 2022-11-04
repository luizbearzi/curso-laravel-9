@extends('layouts.app')

@section('title', "Comentários do usuário {$user->name}")

@section('content')
<h1 class="text-2x1 font-semibold">
    Listagem dos usuários {{ $user->name }}
    <a href="{{ route('comments.create', $user->id) }}" class="bg-blue-900 rounded-full text-white px-4 text-sm">+</a>
</h1> 

<form action="{{ route('comments.index', $user->id) }}" method="get">
    <input type="text" name="search" placeholder="Pesquisar..">
    <button class="shadow bg-purple-500 hover:bg-purple-900 rounded-full text-white px-4 text-sm">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left">
                Conteúdo
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                Visível
            </th>
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-20 bg-gray-100 text-left">
                Editar
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach ($comments as $comment)
        <tr>
            <td class="px-5 py-5 border-b border-gra-400"> {{ $comment->body }} </td>
            <td class="px-5 py-5 border-b border-gra-400"> {{ $comment->visible ? 'SIM' : 'NÃO' }} </td>
            
             <td class="px-5 py-5 border-b border-gra-400 px-5 py-5 border-b
             border-gra-500 bg-red-600 rounded-md text-white">
            <a href="{{route('comments.edit', ['user' => $user->id, 'id' => $comment->id])}}">Editar</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection