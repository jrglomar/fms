<template>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">List of Faculty Types</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                        aria-expanded="false" aria-controls="create_card">New Faculty Type <i
                        class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-start">
                        <div id="dt_btn_div">
                        </div>
                    </div>

                    <table class="table table-striped" id="faculty_type_table" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Datatables component mounted.')
        },
    }
</script>