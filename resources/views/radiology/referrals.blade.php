@extends('layouts.app')

@section('sidebar')
  @include('radiology._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Radiology Department</h6>
@endsection

@section('content')
   <app-referral-dashboard :department="'radiology'"></app-referral-dashboard>

@endsection