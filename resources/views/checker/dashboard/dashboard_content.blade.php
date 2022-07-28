@extends('layouts.app')

@section('content')
<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>

      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Class Attendance</h4>
              </div>
              <div class="card-body" id="total_srb">
                
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Class Schedule</h4>
              </div>
              <div class="card-body" id="total_meeting">
                
              </div>
            </div>
          </div>
        </div>
     
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1 pb-3">
            <div class="card-header">
              <label>Class Attendance Status Count/s</label>
            </div>
            <div>
              <canvas id="rsb_donut"></canvas>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1 pb-3">
            <div class="card-header">
              <label>Class Schedule Status Count/s</label>
            </div>
            <div>
              <canvas id="meeting_donut"></canvas>
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-6">
          <button type="button" class="btn btn-dark btn-lg btn-block" onclick="location.href='/checker/class_attendance'">View Class Attendance Page</button>
        </div>
        <div class="col-6">
          <button type="button" class="btn btn-info btn-lg btn-block" onclick="location.href='/checker/schedule'">View Class Schedule Page</button>
        </div>
      </div>
      

@endsection