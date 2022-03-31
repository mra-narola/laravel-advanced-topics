@extends('layouts.app')

@section('content')
	<div class="row">
	  <!-- Blog Entries Column -->
	  <div class="col-md-8">
	    <h1 class="my-4">User List</h1>

	    @forelse ($users as $user)
	    	<x-user.list :user="$user" />
	    @empty
	    	<div class="card mb-4">
	    	  	<div class="card-body">
	    			<h2 class="card-title">Users not found...</h2>
	    		</div>
	    	</div>
	    @endforelse
	  </div>
	</div>
@endsection