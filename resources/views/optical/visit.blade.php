@extends('layouts.app')

@section('sidebar')
  @include('optical._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Optical Department</h6>
@endsection

@section('content')
     <app-visit :visit="{{$visit}}" :department="'optical'"></app-visit>
@endsection