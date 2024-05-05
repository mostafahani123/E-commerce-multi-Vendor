@extends('layouts.dashboard')
@section('title')
create
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">Create</li>
@parent
@endsection
@section('content')
<form action="{{ route('dashboard.categories.store') }}" method="post" class="ml-4">
@csrf
    <div class="form-group" class='container'>


        <div class="mb-7" >
              <label for="exampleInputEmail1" class="form-label">Category Name</label>
              <input type="text" name="name"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
         <div class="form-group">
         <label for="">Category Parent</label>
         <select name="parent_id" class="form-control">
           <option value="">Primary Category</option>
           @foreach ($parents as $parent)
           <option value="{{ $parent->id }}">{{ $parent->name }}</option>
           @endforeach
         </select>
        </div>
          <div class="form-group">
            <label class="form-label" for="textAreaExample">Description</label>
               <div data-mdb-input-init class="form-outline">
                <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
              </div>
              </div>
         <div class="form-group">
        <label for="">Image</label>
       <input type="file" name="file" class="from-control">
        </div>
        <div class="form-group">
            <label for="">status</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="active" name='status'>
                <label class="form-check-label" >
               Active
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="inactive"  checked name='status'>
                <label class="form-check-label">
                    inactive
                </label>
              </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection
