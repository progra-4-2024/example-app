@extends('my-layouts.my-app-layout')
@section('content')
<h2> Formulario de Contacto</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST">
    @csrf
    <label for="nombre">Nombre:</label> 
        <input type="text" id="nombre" name="nombre" value="{{old('nombre')}}"><br />
    <label for="email" class="@error('email') is-invalid @enderror">
        Email:
    </label> 
        <input type="text" class="@error('email') is-invalid @enderror"
            id="email" name="email" value="{{old('email')}}"><br />
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    <input type="checkbox" id="publicidad" name="publicidad" @checked(old('publicidad'))><label for="publicidad">Recibir Publicidad</label><br />
    <label for="mensaje">Mensaje:</label> <br />
    <textarea id="mensaje" name="mensaje">{{old('mensaje')}}</textarea><br />
    <input type="submit" value="Enviar" />
</form>
@endsection