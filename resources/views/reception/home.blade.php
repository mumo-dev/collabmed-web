@extends('layouts.app')

@section('sidebar')
  @include('reception._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Reception Department</h6>
@endsection

@section('content')
     <app-reception></app-reception>
@endsection
