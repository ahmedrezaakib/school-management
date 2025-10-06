@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Create New Teacher</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Create New Teacher
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
                                    Add Teacher
                                </h3>
                            </div>

                            <form action="{{ route('teacher.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="student_name">Teacher's Name</label>
                                            <input type="text" name="name" class="form-control" id="january"
                                                placeholder="Enter student name" />
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Teacher's Father Name</label>
                                            <input type="text" name="father_name" class="form-control" id="february"
                                                placeholder="Enter father name" />
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Teacher's Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="march"
                                                placeholder="Enter student's mother name" />
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="text" name="mobile" class="form-control" id="april"
                                                placeholder="Enter mobile number" />
                                            @error('mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="birth_date">Date of Birth</label>
                                            <input type="date" name="birth_date" class="form-control" id="may" />
                                            @error('birth_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="june"
                                                placeholder="Enter email address" />
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password">Create Student Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Enter password" />
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Add New Student
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection