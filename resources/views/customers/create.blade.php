@extends('layouts.app')
@section('content')
  <form action="{{ route('customers.store') }}" method="POST">
    @csrf
    @include('customers._form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@stop
