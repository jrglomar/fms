<style>
    .btn-report{
        border: none;
        background-color: inherit;
        cursor: pointer;
        display: inline-block;
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
        <!-- <label class="btn btn-outline-secondary">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Pending" autocomplete="off"> Pending
        </label>&nbsp; -->
        <label class="btn btn-outline-info">
          <input class="btnChangeStatus" type="radio" name="status_options" value="On Going" autocomplete="off"> On Going
        </label>&nbsp;
        <!-- <label class="btn btn-outline-danger">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Cancelled" autocomplete="off"> Cancelled
        </label>&nbsp; -->
        <label class="btn btn-outline-success">
          <input class="btnChangeStatus" type="radio" name="status_options" value="Done"  autocomplete="off"> Done
        </label>
    </div>
</div>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">Submission of Required Document Reports</h4>
                    <div class="card-header-action" id="filter_by">
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="SRDdataTable" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>ID</th>
                                <th>Created at</th>
                                <th>Created at</th>
                                <th>Title</th>
                                <th>Requirements</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr">
                                <th>ID</th>
                                <th>Created at</th>
                                <th>Created at</th>
                                <th>Title</th>
                                <th>Requirements</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
