@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Update Student</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Update Student
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
                                    Update Student
                                </h3>
                            </div>

                            <form action="{{ route('student.update', $student->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Select Class</label>
                                                <select name="class_id" class="form-control">
                                                    <option value="" disabled selected>Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}" {{ $class->id == $student->class_id ? 'selected' : '' }}>{{ $class->name }}</option>
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
                                                        <option value="{{ $academic_year->id }}" {{ $academic_year->id == $student->academic_year_id ? 'selected' : '' }}>{{ $academic_year->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('academic_year_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Admission Date</label>
                                                <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date',$student->admission_date) }}">
                                                @error('admission_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="student_id">Student Id</label>
                                            <input type="text" name="student_id" class="form-control" id="name"
                                                placeholder="Enter student id" value="{{ old('student_id',$student->student_id) }}"/>
                                            @error('student_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="student_name">Student Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter student name" value="{{ old('name',$student->name) }}"/>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Student's Father Name</label>
                                            <input type="text" name="father_name" class="form-control" id="father_name"
                                                placeholder="Enter father name" value="{{ old('father_name',$student->father_name) }}" />
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Student's Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name"
                                                placeholder="Enter student's mother name" value="{{ old('mother_name',$student->mother_name) }}" />
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="text" name="mobile" class="form-control" id="mobile"
                                                placeholder="Enter mobile number" value="{{ old('mobile',$student->mobile) }}" />
                                            @error('mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="birth_date">Date of Birth</label>
                                            <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ old('birth_date',$student->birth_date) }}" />
                                            @error('birth_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" required >
                                                <option value="" disabled selected >Select Gender</option>
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
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Enter email address" value="{{ old('email',$student->email) }}" />
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Update Student
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