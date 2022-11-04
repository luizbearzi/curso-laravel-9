@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')
<h1 class="text-2x1 font-semibold">Novo Usuário</h1>

@include('includes.validations-form')

<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
    @csrf <!--previne ataques csrf-->
    @include('users._partials.form')
</form>

@endsection