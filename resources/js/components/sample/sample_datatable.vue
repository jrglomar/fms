<template>

    <div class="container">
        <JlDatatable
            :url="datatable.url"
            :columns="datatable.columns"
        />
    </div>
    
</template>

<script>

import JlDatatabble from 'jl-datatable';
    export default {
        name: "sample_datatable",
        conponents: {
            JlDatatabble
        },
        data(){
            return {
                datatable: {
                    url: 'http://127.0.0.1:8000/api/v1/designation/',
                    columns: [
                        {
                            title: 'ID',
                            key: 'id',
                            isSort: true,
                            width: '25%',
                        },
                        {
                            title: 'Title',
                            key: 'title',
                            isSort: true,
                            width: '25%',
                        },
                        {
                            title: 'Description',
                            key: 'description',
                            isSort: true,
                            width: '25%',
                        }
                        
                    ]
                }
            }
        }
        
    }
</script>