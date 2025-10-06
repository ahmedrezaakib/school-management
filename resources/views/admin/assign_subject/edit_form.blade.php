@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Update Assign Subject</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Update Assign Subject
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">
                                    Update Assign Subject
                                </h3>
                            </div>

                            <form action="{{ route('assign-subject.update',$assign_subject->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <select name="class_id" class="form-control">
                                        <option disabled selected> Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $assign_subject->class_id == $class->id  ? 'selected' : ''}}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select name="subject_id" class="form-control">
                                        <option disabled selected> Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ $assign_subject->subject_id == $subject->id  ? 'selected' : ''}}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Update Assign Subject
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection