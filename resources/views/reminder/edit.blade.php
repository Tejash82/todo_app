@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="text-center mt-5">
        <h2>Edit Todo</h2>
    </div>


    <form method="POST" action="{{ route('reminder.update', ['reminder' => $reminder->id]) }}">

        @csrf

        {{ method_field('PUT') }}

        <div class="row justify-content-center mt-5">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ $reminder->title }}" maxlength="25">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description"
                        value="{{ $reminder->description }}">
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Date"
                        value="{{ $reminder->date }}">
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> <br><br> <br> <br>

                <div class="col-12">
                    <a class="btn btn-primary" href="{{ route('reminder.index') }}" style="margin-left: 1px;"> Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </div>

        </div>

    </form>
@endsection
@section('scripts')
@endsection
