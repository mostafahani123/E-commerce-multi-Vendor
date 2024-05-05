@extends('layouts.dashboard')
@section('title')
Categories
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">Categories</li>
@parent
@endsection
@section('content')
<div class="mb-5 ml-3 breadcrumb-item">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-success">create</a>
</div>

@if (session()->has('success'))
<div class="alert alert-success ml-3">
{{ session('success') }}
</div>
@endif

@if (session()->has('info'))
<div class="alert alert-danger ml-3">
{{ session('info') }}
</div>
@endif

<table class="table table-dark ml-2">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">parent_id</th>
        <th scope="col">created_at</th>
        <th colspan="2"></th>
      </tr>
    </thead>
    <tbody>

        @forelse ($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->parent_id }}</td>
        <td>{{ $category->created_at }}</td>
        <td>
            <a href="{{ route('dashboard.categories.edit',  $category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
        </td>
        <td>
         <form action="{{ route('dashboard.categories.destroy', $category->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
         </form>
        </td>
      </tr>
      @empty

      <tr>
        <td colspan="7" > No category defined.</td>
      </tr>
    @endforelse

    </tbody>
  </table>
@endsection
