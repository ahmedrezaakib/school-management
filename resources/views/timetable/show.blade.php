@extends('admin.master')

{{-- If your layout supports it, this sets proper body classes for AdminLTE --}}
@section('bodyClass', 'sidebar-mini layout-fixed')

@section('customCss')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">

<style>
  /* Make sure content never hides behind the sidebar */
  .content-wrapper { min-height: 100vh; }

  .timetable-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
  }

  .timetable-card {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    background-color: #f9fafc;
    box-shadow: 0 2px 6px rgba(0,0,0,.05);
    padding: 12px 14px;
    /* Responsive: allow wrapping and shrinking */
    flex: 1 1 260px;      /* grow | shrink | basis */
    max-width: 100%;
    transition: transform .2s ease, box-shadow .2s ease;
  }
  .timetable-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,.08);
  }
  .timetable-card strong { color: #007bff; }

  .day-label {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    border-radius: 5px;
    padding: 5px 10px;
    display: inline-block;
    white-space: nowrap;
  }

  /* Table containment on small screens */
  .table-responsive { overflow-x: auto; }
</style>
@endsection

{{-- ⚠️ Use the section name your layout expects.
     If your layout yields @yield('content'), use 'content'.
     If it yields @yield('page'), keep 'page'. --}}
@section('content')
<div class="content-wrapper">
  <!-- Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">📘 Timetable — {{ $class->name }}</h3>
        <a class="btn btn-success btn-sm px-3 shadow-sm" href="{{ route('timetable.create') }}">
          <i class="fas fa-plus"></i> Add Period
        </a>
      </div>
    </div>
  </section>

  <!-- Main -->
  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
      @endif

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 120px;">Day</th>
                  <th>Schedule</th>
                </tr>
              </thead>
              <tbody>
                @foreach($days as $d => $label)
                  <tr>
                    <td class="text-center align-middle">
                      <span class="day-label">{{ $label }}</span>
                    </td>
                    <td>
                      @php $dayPeriods = $periods->get($d) ?? collect(); @endphp
                      @if($dayPeriods->isEmpty())
                        <em class="text-muted">No periods scheduled.</em>
                      @else
                        <div class="timetable-grid">
                          @foreach($dayPeriods as $p)
                            <div class="timetable-card">
                              <div><strong>{{ $p->start_time }} – {{ $p->end_time }}</strong></div>
                              <div>{{ $p->subject->name ?? 'Subject' }}</div>
                              <div>👩‍🏫 {{ $p->teacher->name ?? '—' }}</div>
                              @if($p->room)
                                <div>🏫 Room: {{ $p->room }}</div>
                              @endif
                              <div class="mt-2 d-flex gap-2">
                                <a href="{{ route('timetable.edit', $p->id) }}" class="btn btn-sm btn-primary">
                                  <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('timetable.destroy', $p->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this period?')" class="d-inline">
                                  @csrf @method('DELETE')
                                  <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                  </button>
                                </form>
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

      <div class="text-end mt-3 mb-4">
        <a href="{{ route('timetable.index') }}" class="btn btn-secondary btn-sm">
          <i class="fas fa-arrow-left"></i> Back
        </a>
      </div>
    </div>
  </section>
</div>
@endsection

@section('customJs')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
  // Optional: auto-collapse sidebar on small screens for more space
  document.addEventListener('DOMContentLoaded', function () {
    if (window.innerWidth < 992) {
      document.body.classList.add('sidebar-collapse');
    }
  });
</script>
@endsection
