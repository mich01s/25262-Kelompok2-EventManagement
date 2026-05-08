@extends('main')

@section('title','Kategori')

@section('content')
@foreach ($result as $item)
{{$item->kategori_id}} - {{ $item->nama}} <br>
@endforeach