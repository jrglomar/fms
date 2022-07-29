<style>
    .btn-report{
        border: none;
        /* background-color: inherit; */
        cursor: pointer;
        display: inline-block;
        font-size: 17px;
    }

    .btn-report:hover {background: #eee;}

    .btn-reset{
        border: none;
        background-color: inherit;
        cursor: pointer;
        display: inline-block;
    }

    .btn-reset:hover {background: #fff;}

    .success {color: green;}
    .info {color: dodgerblue;}
    .warning {color: orange;}
    .danger {color: red;}
    .default {color: black;}

    .input-group-addon{
        font-size: 16px;
    }
</style>

<div class="row justify-content-between">
    <div class="btn-group">
        <label class="text-dark pl-3 pr-2 mt-2">Date From: </label>   
        <label> <input type="date" class="form-control date-range-filter" id="date_from" name="date_from"
            placeholder="date" tabindex="1" required>&nbsp;</label> 
        
        <label class="text-dark pl-3 pr-2 mt-2">Date To: </label>   
        <label> <input type="date" class="form-control date-range-filter" id="date_to" name="date_to"
            placeholder="date" tabindex="1" required>&nbsp;</label> 
        &nbsp;
        <button id="btnDateReset" class="btn btn-info ml-2 mb-5 pr-3 mt-1">Reset</button>
    </div>

    {{-- FILTER BUTTONS --}}
    <div class="btn-group btn-group-toggle mb-5 pr-3" data-toggle="buttons">
        <label class="text-dark pt-2 pr-2">Status Filter: </label>
        <label class="btn btn-outline-dark active">
          <input class="btnChangeStatus" type="radio" id="status_all" name="status_options" value="All" autocomplete="off" checked> All
        </label>&nbsp;
        <label class="btn btn-outline-secondary">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Submitted" autocomplete="off"> Submitted
        </label>&nbsp;
        <label class="btn btn-outline-info">
          <input class="btnChangeStatus" type="radio" name="status_options" value="For Revision" autocomplete="off"> For Revision
        </label>&nbsp;
        <label class="btn btn-outline-danger">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Declined" autocomplete="off"> Declined
        </label>&nbsp;
        <label class="btn btn-outline-success">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Approved"  autocomplete="off"> Approved
        </label>
    </div>
</div>
{{-- DATATABLES --}}
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">Observation Reports</h4>
                    {{-- <div class="card-header-action">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                        aria-expanded="false" aria-controls="create_card">New activity <i
                        class="fas fa-plus"></i></button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-start">
                        <div id="dt_btn_div">
                        </div>
                    </div>

                    <table class="table table-hover table-sm" id="dataTable" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>ID</th>
                                <th>Created at</th>
                                <th>Checked by</th>
                                <th>Faculty</th>
                                <th>Date of Class</th>
                                <th>Asgmt Code</th>
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th>Units</th>
                                <th>Year & Section</th>
                                <th>Room</th>
                                <th>Proof of Attendance</th>
                                <th>Status</th>
                                <th>Date of Class</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Created at</th>
                                <th>Checked by</th>
                                <th>Faculty</th>
                                <th>Date of Class</th>
                                <th>Asgmt Code</th>
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th>Units</th>
                                <th>Year & Section</th>
                                <th>Room</th>
                                <th>Proof of Attendance</th>
                                <th>Status</th>
                                <th>Date of Class</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
