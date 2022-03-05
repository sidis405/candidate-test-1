@extends('layouts.app')
@section('content')
  <form action="{{ route('orders.update', $order) }}" method="POST">
    @csrf
    @method('PUT')
    @include('orders._form')
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
@stop
