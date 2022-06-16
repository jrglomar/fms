<template>
    <div class="userCreate">
        <label>Email: </label>
            <input type="text" v-model="user.email"/><br><br>
        <label>Password: </label>
            <input type="password" v-model="user.password"/><br><br>
        <label>Password Confirmation: </label>
            <input type="password" v-model="user.password_confirmation"/><br><br>

        <button @click="userCreate">Submit</button>
    </div>
</template>

<script>
export default {
    data: function (){
        return {
            user: {
                email: "",
                password: "",
                password_confirmation: ""
            }
        }
    },
    methods: {
        userCreate() {
            if( this.user.email == '' || this.user.password == '' || this.user.password_confirmation == ''){
                alert('Submission Failed');
            }
            
            axios.post('http://127.0.0.1:8000/api/v1/register', {
                email: this.user.email,
                password: this.user.password,
                password_confirmation: this.user.password_confirmation
            })
            .then( response => {
                this.user.email = "";
                this.user.password = "";
                this.user.password_confirmation = "";
                this.$emit('reloadlist');
            })
            .catch( error=> {
                console.log( error );
            })
        }
    }
}
</script>