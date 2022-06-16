<template>
    <div class="userContainer">
        <div class="heading">
            <h2>User List</h2>
            <user-create-form
                v-on:reloadlist="getUser()"
                />
        </div>
        <user-view :users="users" />
    </div>
</template>

<script>
import userCreateForm from "./userCreateForm"
import userView from "./userView"

export default {
    name: 'User',
    components: {
        userCreateForm,
        userView
    },
    data: function () {
        return {
            users: []
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
        }
    },
    created() {
        this.getUser();
    }
}
</script>
