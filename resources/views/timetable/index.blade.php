@extends('admin.master') {{-- or your admin layout --}}
@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">
@endsection
@section('page')
    <div class="container">
        <h1 class="mb-3">Timetable</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> @endif

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('timetable.class', ['classId' => 0]) }}" method="GET"
                    onsubmit="event.preventDefault(); if(this.class_id.value){ window.location='{{ url('/timetable/class') }}/'+this.class_id.value; }">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label">Select Class</label>
                            <select name="class_id" class="form-select">
                                <option value="">-- Choose --</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary w-100">View</button>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ route('timetable.create') }}" class="btn btn-success w-100">Add Period</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script src="{{ asset('assets/js/school-theme.js') }}"></script>
@endsection
@section('customJs')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>
    <script src="dist/js/demo.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection