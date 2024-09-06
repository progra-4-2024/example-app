@extends('my-layouts.my-app-layout') 
@section('title', 'Mi primer controller')
@section('sidebar')
    
    <ul>
    <li>otro enlace especial.</li></ul>
    @parent
@endsection


@section('content')
<p>Con locale: {{ __('messages.welcome', ['name' => 'dayle']) }} </p>
<p style="direction:rtl;">Hola mundo</p>
<div style="text-align:right;">
	<bdo dir="rtl">Hola mundo</bdo>
</div>

<style>
        .vertical{
        -webkit-writing-mode: vertical-rl;
        -moz-writing-mode: vertical-rl;
        -ms-writing-mode: vertical-rl;
        writing-mode: vertical-rl;
        }
 </style>
 <p class=vertical lang=ja>これはテストテキスト。<br/>
日本語は楽しいです。</p>

<ul>
@foreach($messages as $index=>$message)
    <li>{{$index}}: {{$message[0]}}</li>
@endforeach
</ul>
Contador: {{$contador}}<br/>
Contador Cache: {{$contadorCache}}<br/>
{{$texto}}<br />
The current UNIX timestamp is {{ time() }}.<br />
@{{ name }}<br />
@verbatim
<div class="container">
    Hello, {{ name }}.
</div>
@endverbatim

@if (count($records) === 1)
I have one record!
@elseif (count($records) > 1)
I have multiple records!
@else
I don't have any records!
@endif
<br />
@unless (Auth::check())
You are not signed in.
@endunless
<br />
@auth
// The user is authenticated...
@else
El usuario no esta logueado con @@auth
@endauth
<br />
@env(['staging', 'production'])
// The application is running in "staging" or "production"...
@else
App en preproducción.
@endenv
<br />
@for ($i = 0; $i
< 10; $i++)
    The current value is {{ $i }} <br />
@endfor
@@foreach normal:
@foreach ($users as $user)
<p>This is user {{ $user->id }}</p>
@endforeach
@@forelse:
@forelse ($users as $user)
<li>{{ $user->name }}</li>
@empty
<p>No users</p>
@endforelse

{{-- comentario --}}

@php
$isActive = false;
$hasError = true;
@endphp

<span @class([ 'p-4' , 'font-bold'=> $isActive,
    'text-gray-500' => ! $isActive,
    'bg-red' => $hasError,
    ])></span>
<form method="POST">
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="email" name="email" value="{{ old('email') }}" />
    <input type="checkbox"
        name="active"
        value="active"
        @checked(old('active', true)) />

    <select name="userSelectedId">
        @foreach ($users as $user)
        <option value="{{ $user->id }}" @selected(old('userSelectedId')== $user->id )>
            {{ $user->id }} - {{$user->name}}
        </option>
        @endforeach
    </select>
    <input type="submit" />

    @include('mis-views/included-view', ['status' => 'complete'])

    @foreach ($users as $user)
    @if ($loop->first)
        This is the first iteration.
    @endif
 
    @if ($loop->last)
        This is the last iteration.
    @endif
 
    <p>This is user {{ $user->id }}</p>
@endforeach

</form>
@endsection