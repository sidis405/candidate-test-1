@extends('layouts.app')
@section('content')
  <form action="{{ route('customers.update', $customer) }}" method="POST">
    @csrf
    @method('PUT')
    @include('customers._form')
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
@stop
