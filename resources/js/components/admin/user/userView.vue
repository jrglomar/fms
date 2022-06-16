<template>
    <div>
        <h3>User List</h3>
        <div v-for="(users, index) in users" :key="index">
            <user-list
                :users="users"
                :test_props="test_props"
                />
        </div>
    </div>
</template>

<script>
import userList from "./userList"

export default {
    props: ['users'],
    data: function() {
        return {
            test_props: {
                "name": "Raven"
            }
        }
    },
    components: {
        userList
    },

}
</script>
