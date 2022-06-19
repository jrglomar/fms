<template>
    <div class="userContainer">
        <div class="heading">

            <user-create-form
            />

            <user-datatable
            />

        </div>

    </div>
</template>

<script>
import userCreateForm from "./userCreateForm"
import userView from "./userView"
import userDatatable from "./userDatatable"

export default {
    name: 'User',
    components: {
        userCreateForm,
        userView,
        userDatatable
    },
    data: function () {
        return {
            users: [],
        }
    },
    methods: {
        getUser () {
            axios.get('http://127.0.0.1:8000/api/v1/user')
            .then( response => {
                this.users = response.data
            })
            .catch( errror => {
                console.log ( error )
            })
        },
    },
    created() {
        this.getUser();
    }
}
</script>
