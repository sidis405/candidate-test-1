@extends('layouts.app')
@section('content')
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        @include('orders._form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@stop
