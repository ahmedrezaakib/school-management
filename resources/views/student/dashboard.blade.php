@extends('student.layout')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($announcement as $item )
                        <div class="alter alert-warning">
                            {{ $item->notice }}
                        </div>
                        
                        @endforeach
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Student Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>Welcome to Student Dashboard</h3>
                            </div>
                            <section class="content">
                                <div class="container-fluid">
                                    <!-- Student Stats Row -->
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-info">
                                                <div class="inner">
                                                    <h3>3.75<sup style="font-size: 20px">GPA</sup></h3>
                                                    <p>Current Grade Point Average</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-graduation-cap"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">View Details <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-success">
                                                <div class="inner">
                                                    <h3>92<sup style="font-size: 20px">%</sup></h3>
                                                    <p>Attendance Rate</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">View Details <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-warning">
                                                <div class="inner">
                                                    <h3>5</h3>
                                                    <p>Pending Assignments</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-tasks"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">View Details <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-gradient-danger">
                                                <div class="inner">
                                                    <h3>Paid</h3>
                                                    <p>Fee Status</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-money-check"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">View Details <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header border-0 bg-gradient-success">
                                                <h3 class="card-title text-white">
                                                    <i class="fas fa-chart-line mr-2"></i>Recent Grades
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom py-2">
                                                    <div>
                                                        <i class="fas fa-calculator text-primary mr-2"></i>
                                                        Mathematics
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">85/100</span>
                                                        <span class="badge badge-primary ml-2">A</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom py-2">
                                                    <div>
                                                        <i class="fas fa-flask text-success mr-2"></i>
                                                        Science
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">92/100</span>
                                                        <span class="badge badge-success ml-2">A+</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom py-2">
                                                    <div>
                                                        <i class="fas fa-book text-warning mr-2"></i>
                                                        English
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">78/100</span>
                                                        <span class="badge badge-warning ml-2">B+</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-2">
                                                    <div>
                                                        <i class="fas fa-landmark text-danger mr-2"></i>
                                                        History
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">65/100</span>
                                                        <span class="badge badge-danger ml-2">C+</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header border-0 bg-gradient-indigo">
                                                        <h3 class="card-title text-white">
                                                            <i class="fas fa-rocket mr-2"></i>Quick Actions
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row text-center">
                                                            <div class="col-lg-3 col-6 mb-3">
                                                                <a href="#" class="btn btn-app bg-gradient-info">
                                                                    <i class="fas fa-book fa-2x"></i>
                                                                    Course Materials
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-3 col-6 mb-3">
                                                                <a href="#" class="btn btn-app bg-gradient-success">
                                                                    <i class="fas fa-file-alt fa-2x"></i>
                                                                    Assignments
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-3 col-6 mb-3">
                                                                <a href="#" class="btn btn-app bg-gradient-warning">
                                                                    <i class="fas fa-chart-bar fa-2x"></i>
                                                                    Grade Report
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-3 col-6 mb-3">
                                                                <a href="#" class="btn btn-app bg-gradient-danger">
                                                                    <i class="fas fa-money-check fa-2x"></i>
                                                                    Fee Payment
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    </div>
    </div>
@endsection