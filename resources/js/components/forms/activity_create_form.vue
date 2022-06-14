<template>
        <div class="row">
            <div class="col-md-12 collapse" id="create_card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="text-dark"> <span id="create_card_title">Create</span> Activity</h4>
                    </div>
                    <form id="create_form" @submit.prevent="addActivity()">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Title</label>
                                    <input type="text" class="form-control" id="activity_title"
                                    v-model="activity_title" placeholder="Title" tabindex="1" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required-input">Activity Type</label>
                                    <select class="form-control select2" id="activity_type_id" required
                                        name="activity_type_id" data-parsley-errors-container="#activity-errors">
                                    </select>
                                    <ul class="parsley-err-msg">
                                        <li id="activity-errors"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="required-input">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        v-model="description" placeholder="Description" tabindex="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Date and Time Starts</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" 
                                        v-model="start_time" tabindex="1" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required-input">Date and Time Ends</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        v-model="end_time" tabindex="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Status</label>
                                    <select class="form-control select2" id="status_form" required
                                        name="status_form" data-parsley-errors-container="#status-errors">
                                        <option value="Pending">Pending</option>
                                        <option value="Ongoing">Ongoing</option>
                                    </select>
                                    <ul class="parsley-err-msg">
                                        <li id="status-errors"></li>
                                    </ul>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="memo_upload" class="form-label">Memorandum File</label>
                                    <input class="form-control-file" type="file" ref="file" id="memo_upload" v-on:change="handleFileUpload()" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary"
                                id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create <i
                                    class="fas fa-check"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>


<script>
    export default {

        // ALL FUNCTIONS HERE AUTOMATICALLY RUNS WHEN MOUNTED
        mounted() {
            console.log('Activity Create Form mounted.')
            this.getActivityTypes();
        },

        // ALL DATA VARIABLES USED IN THIS COMPONENT
        data(){
            return {
                activity_title: '',
                description: '',
                start_time: '',
                end_time: '',
                file: '',

            }
        },

        // ALL FUNCTIONS USED IN THIS COMPONENT
        methods:{
            getActivityTypes(){
                axios.get('http://127.0.0.1:8000/api/v1/activity_type/')
                .then(function (response) {
                    var activityTypes = response.data;

                    var html = ""

                    for(var i=0; i < activityTypes.length; i++){
                    html += `<option value="${activityTypes[i].id}">${activityTypes[i].title}</option>`
                    }
                    
                    $('#activity_type_id').html(html);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },

            handleFileUpload(){
                this.memo_upload = this.$refs.file.files[0];
            },

            addActivity(){
                // let formData = new FormData();
                // formData.append('file', this.memo_upload);
                //console.log(formData)

                console.log({
                    title: this.activity_title,
                    activity_type_id: document.getElementById("activity_type_id").value,
                    description: this.description,
                    start_datetime: this.start_time,
                    end_datetime: this.end_time,
                    memorandum_file_directory: "url",
                    status: document.getElementById("status_form").value,
                })

                // axios.post('http://127.0.0.1:8000/api/v1/activity',
                // {
                //     title: this.activity_title,
                //     activity_type_id: document.getElementById("activity_type_id").value,
                //     description: this.description,
                //     start_datetime: this.start_time,
                //     end_datetime: this.end_time,
                //     memorandum_file_directory: formData,
                //     status: this.status,
                // },
                // {
                //     headers: {
                //         'Authorization': 'Bearer 4|Cpl2er8rfw5YxsjsT5SuMXMePhODNu8BRNnzAfGL'
                //     }
                // })
                // .then(function (response) {
                //     console.log(response);
                // })
                // .catch(function (error) {
                //     console.log(error);
                // });
            }
        }
    }

    
</script>
