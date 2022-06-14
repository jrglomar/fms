<template>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">List of Users</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                        aria-expanded="false" aria-controls="create_card">New Activity <i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-start">
                        <div id="dt_btn_div">
                        </div>
                    </div>
                    <table class="table table-striped" id="user_table" style="width:100%">
                        <thead>
                            <tr>
                                <th
                                v-for="(column, index) in columns"
                                v-bind:key="index"
                                v-on:click="sortRecords(index)"
                                >
                                {{column}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                            v-for="(row, index) in rows"
                            v-bind:key="index"
                            >
                            <td
                                v-for="(rowItem, itemIndex) in row"
                                v-bind:key="itemIndex"
                            >
                                {{rowItem}}
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Activity Table mounted.'),
            this.getActivity();
        },

        data() {
         return {
            term: '',
            rows: [
                [
                "Manoj", "24", "Software Developer", "1997"
                ],
                [
                "John", "26", "Lawyer", "1995"
                ],
                [
                "Lily", "34", "Saleswoman", "1987"
                ],
                [
                "Rachel", "34", "Saleswoman", "1987"
                ],
                [
                "Ross", "34", "Barber", "1987"
                ],
                [
                "Chandler", "30", "Salesman", "1991"
                ]
            ],
            //rows: [],
            columns: [
                'Name',
                'Age',
                'Profession',
                'Year of birth'
            ],
            sortIndex: null,
            sortDirection: null
            }
        },
        methods:{
            getActivity(){
                //var rows = []
                axios.get('http://127.0.0.1:8000/api/v1/activity')
                .then(function (response) {
                    for(var i=0; i < response.data.length; i++){
                    //rows =+ response.data[i];
                    console.log(JSON.stringify(response.data[i]))
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
        }
    }

    
</script>
