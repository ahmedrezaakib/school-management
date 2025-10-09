@extends('student.master')

@section('page')

    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3 class="mb-0">📘 Class Timetable — {{ $class->name }}</h3>
        </div>
    </section>
        <section class="page">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:120px;">Day</th>
                                        <th>Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $d => $label)
                                        <tr>
                                            <td class="text-center align-middle"><span
                                                    class="badge bg-primary">{{ $label }}</span></td>
                                            <td>
                                                @php $dayPeriods = $periods->get($d) ?? collect(); @endphp
                                                @if($dayPeriods->isEmpty())
                                                    <em class="text-muted">No periods scheduled.</em>
                                                @else
                                                    <div class="d-flex flex-wrap gap-3">
                                                        @foreach($dayPeriods as $p)
                                                            <div class="border rounded p-2" style="flex:1 1 260px">
                                                                <div><strong>{{ $p->start_time }} – {{ $p->end_time }}</strong></div>
                                                                <div>{{ $p->subject->name ?? 'Subject' }}</div>
                                                                @if($p->room)
                                                                <div>Room: {{ $p->room }}</div>@endif
                                                                <div class="text-muted small">Teacher: {{ $p->teacher->name ?? '—' }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary btn-sm">← Back to Dashboard</a>
                </div>
            </div>
        </section>
@endsection