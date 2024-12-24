@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<h1 class="h3 mb-4">Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Task Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title') }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Task Description</label>
        <textarea name="description" id="description" rows="4"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save Task</button>
</form>
@endsection
