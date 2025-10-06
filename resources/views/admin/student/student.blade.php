@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Create New Student</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Create New Student
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
                                    Add Student
                                </h3>
                            </div>

                            <form action="{{ route('student.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Select Class</label>
                                                <select name="class_id" class="form-control">
                                                    <option value="" disabled selected>Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('class_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Select Academic Year</label>
                                                <select name="academic_year_id" class="form-control">
                                                    <option value="" disabled selected>Select Academic Year</option>
                                                    @foreach ($academic_years as $academic_year)
                                                        <option value="{{ $academic_year->id }}">{{ $academic_year->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('academic_year_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Admission Date</label>
                                                <input type="date" name="admission_date" class="form-control">
                                                @error('admission_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="student_id">Student Id</label>
                                            <input type="text" name="student_id" class="form-control" id="student_id"
                                                placeholder="Enter student Id" />
                                            @error('student_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="student_name">Student Name</label>
                                            <input type="text" name="name" class="form-control" id="student_name"
                                                placeholder="Enter student name" />
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Student's Father Name</label>
                                            <input type="text" name="father_name" class="form-control" id="february"
                                                placeholder="Enter father name" />
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Student's Mother Name</label>
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
                                                <option value="other">Other</option>
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