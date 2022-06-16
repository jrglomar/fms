import Login from './components/auth/login/loginApp'
import User from './components/admin/user/userApp'

export default{
    mode: 'history',

    routes: [
        {
            path: '/login', component: Login, name: 'Login'
        },
        {
            path: '/admin/user', component: User, name: 'User'
        }
    ]
}
