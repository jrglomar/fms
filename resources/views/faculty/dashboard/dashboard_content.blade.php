@extends('layouts.app')

@section('content')
<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>

<div class="row">

  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Requirement Bins</h4>
        </div>
        <div class="card-body" id="total_srb">
          
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Meetings</h4>
        </div>
        <div class="card-body" id="total_meeting">
          
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Activities</h4>
        </div>
        <div class="card-body" id="total_activity">
          
        </div>
      </div>
    </div>
  </div>                 
</div>

<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-header">
        <label>Submitted Requirements Status</label>
      </div>
      <div>
        <canvas id="rsb_donut"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-header">
        <label>Meeting Status</label>
      </div>
      <div>
        <canvas id="meeting_donut"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-header">
        <label>Activity Status</label>
      </div>
      <div>
        <canvas id="activity_donut"></canvas>
      </div>
    </div>
  </div>  

</div>

@endsection