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
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">List of Meeting</h4>
                    
                </div>
                <div class="card-body">
                    <div class="input-group-addon">&nbsp; <b>Date Range:</b> &nbsp;</div><br>
                    <div class="input-group col-md-6 input-daterange">
                        <div class="input-group-addon">From &nbsp;</div>
                        <input type="date" id="min-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="From:">
                        <div class="input-group-addon">&nbsp; to &nbsp;</div>
                        <input type="date" id="max-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="To:">
                        &nbsp;<button class="btn-reset info" id="reset_date_filter">reset</button>
                    </div>
                    <br>
                    <table class="table table-hover table-sm" id="MEETINGdataTable" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th width="5%">ID</th>
                                <th width="8%">Created by</th>
                                <th width="7%">Created at</th>
                                <th width="20%">Title</th>
                                <th width="10%">Meeting Type</th>
                                <th width="20%">Agenda</th>
                                <th width="7%">Location</th>
                                <th width="8%">Date</th>
                                <th>Required</th>
                                <th width="5%">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
