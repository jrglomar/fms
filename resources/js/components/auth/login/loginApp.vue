<template>
    <div class="loginContainer">
        Login Page
        <login-form/>
    </div>
</template>

<script>
import loginForm from "./loginForm"

export default {
    name: 'Login',
    components: {
        loginForm
    }

}
</script>
