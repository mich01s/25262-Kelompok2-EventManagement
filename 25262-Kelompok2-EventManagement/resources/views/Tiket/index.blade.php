@extends('usermain')

@section('title','Tiket')

@section('content')

@foreach ($result as $item)
{{$item->tiket_id}} - {{ $item->event_id}} - {{$item->nama_tiket}}<br>
@endforeach

@endsection