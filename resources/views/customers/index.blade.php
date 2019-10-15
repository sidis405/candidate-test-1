@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-block">+ New Customer</a>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Company</th>
          <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customers as $customer)
          <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->company }}</td>
            <td><a href="{{ route('customers.edit', $customer) }}">[Edit]</a></td>
            <td><a href="#" onclick="event.preventDefault(); document.getElementById('delete-customer-{{ $customer->id }}-form').submit();">[Delete]</a></td>

            <form id="delete-customer-{{ $customer->id }}-form" action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    {{ $customers->links() }}
  </div>
</div>

@stop
