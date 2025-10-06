@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Update Assign Subject to Teacher</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Update Assign Subject to Teacher</li>
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
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card-header">
                                <h3 class="card-title">Update Assign Subject to Teacher</h3>
                            </div>

                            <form action="{{ route('assign-teacher.update',$assign_teacher->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option disabled selected>Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ $class->id == $assign_teacher->class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option disabled selected>Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->subject->id }}" {{ $subject->subject->id == $assign_teacher->subject_id ? 'selected' : ''}}>
                                                    {{ $subject->subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group"><!-- fixed -->
                                        <select name="teacher_id" class="form-control">
                                            <option disabled selected>Select Teacher</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ $assign_teacher->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id') <!-- fixed -->
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div><!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                var class_id = $(this).val();

                $.ajax({
                    url: "{{ route('findSubject') }}",
                    type: 'GET',
                    data: { class_id: class_id },
                    dataType: 'json',
                    success: function (response) {
                        var $subject = $('#subject_id');
                        // keep the first placeholder option, remove others
                        $subject.find('option').not(':first').remove();

                        if (response && Array.isArray(response.subjects) && response.subjects.length) {
                            $.each(response.subjects, function (key, item) {
                                // adjust these two lines to match your API shape:
                                var val = item.subject_id ?? item.id;        // <-- value to submit
                                var text = item.subject?.name ?? item.name;   // <-- label to show
                                $subject.append('<option value="' + val + '">' + text + '</option>');
                            });
                        } else {
                            $subject.append('<option disabled>(No subjects found)</option>');
                        }
                    },
                    error: function () {
                        alert('Failed to load subjects. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection