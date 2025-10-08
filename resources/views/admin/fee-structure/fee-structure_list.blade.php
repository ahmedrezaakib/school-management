@extends('admin.master')

@section('customCss')
  {{-- DataTables CSS --}}
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  {{-- Your theme --}}
  <link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">

  {{-- Wide-table QoL fixes --}}
  <style>
    .card-body { overflow-x: auto; }      /* enable horizontal scroll inside card */
    #example1 { width: 100% !important; }
    #example1 thead th, #example1 tbody td { white-space: nowrap; }  /* no wrapping for months */
  </style>
@endsection

@section('page')
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fee Structure</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Fee Structure List</li>
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

              <div class="card-header row">
                <h3 class="card-title col-md-10">Fee Structure List</h3>
                <a href="{{ route('fee-structure.create') }}" class="col-md-2 nav-link btn btn-primary">
                  Add Fee Structure
                </a>
              </div>

              <div class="col-md-4 mt-2">
                <form method="GET">
                  <div class="form-group">
                    <label>Select Academic Year</label>
                    <select name="academic_year_id" class="form-control" id="academic-year-select">
                      <option value="" disabled selected>Select Academic Year</option>
                      @foreach ($academic_years as $academic_year)
                        <option value="{{ $academic_year->id }}" {{ $academic_year->id == request('academic_year_id') ? 'selected' : '' }}>
                          {{ $academic_year->name }}
                        </option>
                      @endforeach
                    </select>

                    <label class="mt-2">Select Class</label>
                    <select name="class_id" class="form-control" id="class-select">
                      <option value="" disabled selected>Select Class</option>
                      @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == request('class_id') ? 'selected' : '' }}>
                          {{ $class->name }}
                        </option>
                      @endforeach
                    </select>

                    {{-- Optional: student dropdown (only if you actually render it)
                    <label class="mt-2">Select Student</label>
                    <select name="student_id" class="form-control" id="student-select">
                      <option value="" disabled selected>Select Student</option>
                    </select>
                    --}}
                  </div>
                  <button class="btn btn-success" type="submit">Filter</button>
                </form>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Student Id</th>
                      <th>Academic Year</th>
                      <th>Class</th>
                      <th>Fee Name</th>
                      <th>January</th>
                      <th>February</th>
                      <th>March</th>
                      <th>April</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>August</th>
                      <th>September</th>
                      <th>October</th>
                      <th>November</th>
                      <th>December</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($feeStructure as $fee)
                      <tr>
                        <td>{{ $fee->id }}</td>
                        <td>{{ $fee->student_id }}</td>
                        <td>{{ $fee->AcademicYear->name }}</td>
                        <td>{{ $fee->Classes->name }}</td>
                        <td>{{ $fee->FeeHead->name }}</td>
                        <td>{{ $fee->january }}</td>
                        <td>{{ $fee->february }}</td>
                        <td>{{ $fee->march }}</td>
                        <td>{{ $fee->april }}</td>
                        <td>{{ $fee->may }}</td>
                        <td>{{ $fee->june }}</td>
                        <td>{{ $fee->july }}</td>
                        <td>{{ $fee->august }}</td>
                        <td>{{ $fee->september }}</td>
                        <td>{{ $fee->october }}</td>
                        <td>{{ $fee->november }}</td>
                        <td>{{ $fee->december }}</td>
                        <td><a href="{{ route('fee-structure.edit', $fee->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        <td><a href="{{ route('fee-structure.delete', $fee->id) }}" onclick="return confirm('are you sure')" class="btn btn-danger btn-sm">Delete</a></td>
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
  {{-- YOUR THEME JS (load once per page) --}}
  <script src="{{ asset('assets/js/school-theme.js') }}"></script>

  {{-- DataTables core --}}
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

  {{-- Optional plugins used here --}}
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
      // Use horizontal scroll instead of collapsing columns
      const dt = $("#example1").DataTable({
        responsive: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: false,
        lengthChange: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });

      dt.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      // Optional dynamic students loader (only if you have #student-select in DOM)
      const classSelect = document.getElementById('class-select');
      const studentSelect = document.getElementById('student-select');
      if (classSelect && studentSelect) {
        classSelect.addEventListener('change', function () {
          const classId = this.value;
          if (classId) {
            fetch(`/admin/get-students-by-class/${classId}`)
              .then(r => r.json())
              .then(students => {
                studentSelect.innerHTML = '<option value="" disabled selected>Select Student</option>';
                students.forEach(s => {
                  studentSelect.innerHTML += `<option value="${s.id}">${s.student_id} - ${s.name}</option>`;
                });
              });
          } else {
            studentSelect.innerHTML = '<option value="" disabled selected>Select Student</option>';
          }
        });
      }
    });
  </script>
@endsection
