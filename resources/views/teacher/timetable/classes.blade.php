@extends('teacher.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h3>👩‍🏫 My Classes</h3>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @forelse($classes as $c)
                        <div class="col-md-4 col-lg-3 mb-3">
                            <div class="border rounded p-3 h-100 d-flex flex-column">
                                <h5 class="mb-2">{{ $c->name }}</h5>
                                <a href="{{ route('teacher.timetable.class', $c->id) }}" class="btn btn-primary btn-sm mt-auto">
                                    View Timetable
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><em class="text-muted">No classes assigned.</em></div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection