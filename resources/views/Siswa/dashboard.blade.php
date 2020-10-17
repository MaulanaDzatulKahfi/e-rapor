@extends('layout.authTemplate')

@section('judul', 'Dashboard')

@section('content')
    siswa Dashboard
    {{ Auth::user()->level }}
@endsection
