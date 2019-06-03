@extends('layouts.app')

@section('sidebar')
  @include('nursing._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Nursing Department</h6>
@endsection

@section('content')
     <app-visit :visit="{{$visit}}" :department="'nursing'"></app-visit>
@endsection