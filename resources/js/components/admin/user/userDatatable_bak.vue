<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="text-dark">List of Users</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                            aria-expanded="false" aria-controls="create_card">New Users <i
                            class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-start">
                            <div id="dt_btn_div">
                            </div>
                        </div>

                        <VueTabulator
                            class="table"
                            v-model="users"
                            :options="options"
                        />

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['users'],
    data: function () {
        return {
            options: {
                pagination: "local",
                paginationSize: 7,
                printStyled: true,
                layout: "fitColumns",
                movableColumns:true,
                columns: [
                    { title: 'ID', field: 'id', sorter: 'string', visible: false},
                    { title: 'Created At', field: 'created_at', sorter: 'string', visible: false},
                    { title: 'Email', field: 'email', sorter: 'string'},
                    { title: 'Actions', field: 'deleted_at', sorter: 'string'},

                ],
            }
        }
    },
}
</script>

