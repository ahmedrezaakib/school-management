@extends('admin.master')

@section('customCss')
    <link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">
    <style>
        .card {
            border: 0;
            border-radius: 16px
        }
    </style>
@endsection

@section('page')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $mode === 'create' ? 'Add Period' : 'Edit Period' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Timetable</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('timetable.store')}}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Class</label>
                                    <select name="class_id" class="form-control" required>
                                        <option value="">-- Choose --</option>
                                        @foreach($classes as $c)
                                            <option value="{{ $c->id }}" @selected(old('class_id', $period->class_id ?? null) == $c->id)>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Subject</label>
                                    <select name="subject_id" class="form-control" required>
                                        <option value="">-- Choose --</option>
                                        @foreach($subjects as $s)
                                            <option value="{{ $s->id }}" @selected(old('subject_id', $period->subject_id ?? null) == $s->id)>{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Teacher</label>
                                    <select name="teacher_id" class="form-control" required>
                                        <option value="">-- Choose --</option>
                                        @foreach($teachers as $t)
                                            <option value="{{ $t->id }}" @selected(old('teacher_id', $period->teacher_id ?? null) == $t->id)>{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Day</label>
                                    <select name="day_of_week" class="form-control" required>
                                        @foreach($days as $k => $v)
                                            <option value="{{ $k }}" @selected(old('day_of_week', $period->day_of_week ?? null) == $k)>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" name="start_time" class="form-control"
                                        value="{{ old('start_time', $period->start_time ?? '') }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control"
                                        value="{{ old('end_time', $period->end_time ?? '') }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Room (optional)</label>
                                    <input type="text" name="room" class="form-control"
                                        value="{{ old('room', $period->room ?? '') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Academic Year (optional)</label>
                                    <input type="number" name="academic_year_id" class="form-control"
                                        value="{{ old('academic_year_id', $period->academic_year_id ?? '') }}"
                                        placeholder="e.g., 1">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit"
                                    class="btn btn-primary">{{ $mode === 'create' ? 'Save' : 'Update' }}</button>
                                <a href="{{ $mode === 'create' ? route('timetable.index') : route('timetable.class', $period->class_id ?? 0) }}"
                                    class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection