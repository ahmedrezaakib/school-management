@extends('admin.master')

@section('customCss')
  {{-- DataTables CSS --}}
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  {{-- Theme (ok to keep; master may already include it) --}}
  <link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">

  {{-- Wide-table QoL fixes --}}
  <style>
    .card-body { overflow-x: auto; }                 /* horizontal scroll inside card */
    #example1 { width: 100% !important; }
    #example1 thead th, #example1 tbody td { white-space: nowrap; } /* prevent wrapping */
  </style>
@endsection

@section('page')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Students List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Students List</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">

            @if(Session::has('success'))
              <div class="alert alert-success">
                {{ Session::get('success') }}
              </div>
            @endif

            <div class="card-header">
              <form method="GET">
                <div class="row">
                  <div class="col-md-2">
                    <select name="academic_year_id" class="form-control">
                      <option value="" disabled selected>Select Academic Year</option>
                      @foreach ($academic_year as $item)
                        <option value="{{ $item->id }}" {{ $item->id == request('academic_year_id') ? 'selected' : '' }}>
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-2">
                    <select name="class_id" class="form-control">
                      <option value="" disabled selected>Select Class</option>
                      @foreach ($classes as $item)
                        <option value="{{ $item->id }}" {{ $item->id == request('class_id') ? 'selected' : '' }}>
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>

                  <div class="col-md-2">
                    <a href="{{ route('student.create') }}" class="nav-link btn btn-primary">Add New Student</a>
                  </div>
                </div>
              </form>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Academic Year</th>
                    <th>Class</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($students as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->student_id }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->academicYear->name ?? 'N/A' }}</td>
                      <td>{{ $item->studentClass->name ?? 'N/A' }}</td>
                      <td>{{ $item->father_name }}</td>
                      <td>{{ $item->mother_name }}</td>
                      <td>{{ $item->mobile }}</td>
                      <td>{{ $item->gender }}</td>
                      <td>{{ $item->email }}</td>
                      <td><a href="{{ route('student.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                      <td><a href="{{ route('student.delete', $item->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>

</div>
@endsection

@section('customJs')
  {{-- Theme JS (if not already loaded in master, safe to include) --}}
  <script src="{{ asset('assets/js/school-theme.js') }}"></script>

  {{-- DataTables core + extras --}}
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

  <script>
    $(function () {
      const dt = $("#example1").DataTable({
        responsive: false,          // use horizontal scroll for many columns
        scrollX: true,
        scrollCollapse: true,
        autoWidth: false,
        lengthChange: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });

      dt.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
