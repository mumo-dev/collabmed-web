@extends('layouts.app')

@section('sidebar')
  @include('admin.layouts._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Admin Dashboard</h6>
@endsection

@section('content')
<div class="card">
  <div class="card-header bg-white">All Accounts </div>
  <div class="card-body">
      <div class="table-responsive">
            <table class="table  table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Department</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->department}}</td>
                </tr> 
                @endforeach
                
            </tbody>
        </table>
      </div>
  </div>

</div>
@endsection
