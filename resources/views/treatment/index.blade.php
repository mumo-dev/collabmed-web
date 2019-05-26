@extends('layouts.app')

@section('sidebar')
  @include('treatment._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Treatment Department</h6>
@endsection

@section('content')
     <app-dashboard :department="'treatment'"></app-dashboard>
@endsection
