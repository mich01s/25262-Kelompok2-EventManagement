@extends('main')

@section('title','ProfilOrganizer')

@section('content')
<h1>Profil Organisasi</h1>

@foreach ($result as $item)
{{$item->organizer_id}} - {{ $item->user_id}} - {{$item->nama_organizer}}<br>
@endforeach