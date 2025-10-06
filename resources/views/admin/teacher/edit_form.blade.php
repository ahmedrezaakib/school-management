@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Update Teacher</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                UpdateTeacher
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
                                    Update Teacher
                                </h3>
                            </div>

                            <form action="{{ route('teacher.update', $teacher->id) }}" method="post">
                                @csrf
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="student_name">Teacher's Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter student name" value="{{ old('name',$teacher->name) }}" />
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Teacher's Father Name</label>
                                            <input type="text" name="father_name" class="form-control" id="father_name"
                                                placeholder="Enter father name"  value="{{ old('father_name',$teacher->father_name) }}" />
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mother_name">Teacher's Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name"
                                                placeholder="Enter student's mother name" value="{{ old('mother_name',$teacher->mother_name) }}" />
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="text" name="mobile" class="form-control" id="mobile"
                                                placeholder="Enter mobile number" value="{{ old('mobile',$teacher->mobile) }}" />
                                            @error('mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="birth_date">Date of Birth</label>
                                            <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ old('birth_date',$teacher->birth_date) }}" />
                                            @error('birth_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>>Female</option>
                                            
                                            </select>
                                            @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="june"
                                                placeholder="Enter email address" value="{{ old('email',$teacher->email) }}" />
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Update Teacher
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