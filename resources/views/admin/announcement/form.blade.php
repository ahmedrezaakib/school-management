@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Notice Manage</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Notice
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
                                    Create Notice
                                </h3>
                            </div>

                            <form action="{{ route('announcement.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notice</label>
                                        <input type="text" name="notice" class="form-control" id="exampleInputEmail1"
                                            placeholder="Write notice" />
                                        @error('notice')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Send to</label>
                                        <select name="type" id="" class="form-control">
                                            <option value="" disabled selected>Select List</option>
                                            <option value="student">Student</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="parent">Parent</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer d-grid gap-2 d-md-block">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Send
                                        </button>
                                        <a href="{{ route('announcement.read') }}"
                                            class="btn btn-lg btn-info">
                                            View Notice
                                        </a>
                                    </div>
                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection