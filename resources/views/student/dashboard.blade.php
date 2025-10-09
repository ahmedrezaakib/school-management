{{-- resources/views/student/dashboard.blade.php --}}
@extends('student.master')

@section('title', 'Student Dashboard')

@section('page_header')
    @if(!empty($announcements) && count($announcements))
        @foreach($announcements as $note)
            <div class="alert alert-warning py-2 mb-2">{{ $note->notice ?? $note }}</div>
        @endforeach
    @endif
    <h1 class="m-0">Student Dashboard</h1>
@endsection

@section('page')
    {{-- Quick Stats --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $gpa ?? '—' }}<sup style="font-size:20px">GPA</sup></h3>
                    <p>Current Grade Point Average</p>
                </div>
                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                <a href="#" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $attendancePct ?? '—' }}<sup style="font-size:20px">%</sup></h3>
                    <p>Attendance (This Month)</p>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
                <a href="#" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $todayClasses ?? 0 }}</h3>
                    <p>Today’s Classes</p>
                </div>
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <a href="{{ route('student.timetable') }}" class="small-box-footer">Go to Timetable <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $feeStatus ?? '—' }}</h3>
                    <p>Fee Status</p>
                </div>
                <div class="icon"><i class="fas fa-money-check-alt"></i></div>
                <a href="#" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Today’s Timetable --}}
        <div class="col-md-7">
            <div class="card h-100">
                <div class="card-header bg-gradient-primary">
                    <h3 class="card-title text-white"><i class="fas fa-clock mr-2"></i>Today’s Timetable</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 110px;">Time</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th class="text-right">Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todayPeriods ?? [] as $p)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($p->start_time)->format('h:i A') }}–{{ \Carbon\Carbon::parse($p->end_time)->format('h:i A') }}
                                    </td>
                                    <td>{{ $p->subject->name ?? $p->subject_name ?? '—' }}</td>
                                    <td>{{ $p->teacher->name ?? '—' }}</td>
                                    <td class="text-right">{{ $p->room ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No classes scheduled for today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('student.timetable') }}"><i
                            class="fas fa-list mr-1"></i> Full Timetable</a>
                </div>
            </div>
        </div>

        {{-- Recent Notices --}}
        <div class="col-md-5 mt-4 mt-md-0">
            <div class="card h-100">
                <div class="card-header bg-gradient-success">
                    <h3 class="card-title text-white"><i class="fas fa-bullhorn mr-2"></i>Recent Notices</h3>
                </div>
                <div class="card-body">
                    @forelse(($notices ?? []) as $n)
                        <div class="d-flex justify-content-between align-items-start border-bottom py-2">
                            <div>
                                <strong>{{ $n->title ?? 'Notice' }}</strong>
                                <div class="text-muted small">
                                    {{ $n->created_at ? \Carbon\Carbon::parse($n->created_at)->format('d M Y') : '' }}</div>
                                <div>{{ Str::limit($n->notice ?? $n->body ?? '', 80) }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No recent notices.</p>
                    @endforelse
                </div>
                
            </div>
        </div>
    </div>
@endsection