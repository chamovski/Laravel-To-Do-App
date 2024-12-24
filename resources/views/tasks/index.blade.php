@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-center mx-auto">Task Management</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Task
        </a>
    </div>

    @if($tasks->isEmpty())
        <p class="text-center text-muted">No tasks available. Click "Add Task" to create one!</p>
    @else
        <!-- For larger screens, display the table -->
        <div class="d-none d-md-block table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td class="text-muted">{{ $task->description }}</td>
                            <td>
                                <span class="badge bg-{{ $task->is_completed ? 'success' : 'warning' }}">
                                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @if (!$task->is_completed)
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- For smaller screens, display cards -->
        <div class="d-md-none">
            @foreach ($tasks as $task)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $task->title }}</h5>
                        <p class="card-text text-muted text-center">{{ $task->description }}</p>
                        <p class="text-center">
                            <span class="badge bg-{{ $task->is_completed ? 'success' : 'warning' }}">
                                {{ $task->is_completed ? 'Completed' : 'Pending' }}
                            </span>
                        </p>
                        <hr>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @if (!$task->is_completed)
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
