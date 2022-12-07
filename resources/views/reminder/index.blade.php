@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="text-center mt-5">
        <h2>Add Todo</h2>

        <form class="row g-3 justify-content-center" method="POST" action="{{ route('reminder.store') }}">
            @csrf

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" name="title" placeholder="Title" maxlength="25">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" name="description" placeholder="Description">
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="date" class="form-control" name="date" placeholder="Date">
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> <br> <br>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>

            </div>
        </form>
    </div>

    <div class="text-center">
        <h2>All Todos</h2>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">DAte</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $counter=1 @endphp

                        @foreach ($reminders as $reminder)
                            <tr>
                                <th>{{ $counter }}</th>
                                <td>{{ $reminder->title }}</td>
                                <td>{{ $reminder->description }}</td>
                                <td>{{ $reminder->date }}</td>
                                <td>
                                    <a href="{{ route('reminder.edit', ['reminder' => $reminder->id]) }}"
                                        class="btn btn-info">Edit</a>

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['reminder.destroy', $reminder->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger',
                                        'onclick' => 'return confirm("Confirm delete?")',
                                    ]) !!}

                                    {!! Form::close() !!}
                                </td>
                            </tr>

                            @php $counter++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
