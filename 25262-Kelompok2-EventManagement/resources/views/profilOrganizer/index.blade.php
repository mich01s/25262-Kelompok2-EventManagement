@extends('main')

@section('title','ProfilOrganizer')

@section('content')

@foreach ($result as $item)
{{$item->organizer_id}} - {{ $item->user_id}} - {{$item->nama_organizer}}<br>
@endforeach