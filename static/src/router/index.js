import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Home from '@/components/Home'
import Login from '@/views/Login'
import Container from '@/container/Container'
import Dashboard from '@/views/dashboard'
import Admin from '@/views/admin'
import Student from '@/views/student'
import Grade from '@/views/grade'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            redirect: '/dashboard',
            name: 'Container',
            component: Container,
            children: [
                {path: 'dashboard', name: '首页', component: Dashboard,},
                {path: 'student', name: '学生管理', component: Student,},
                {path: 'grade', name: '成绩管理', component: Grade,},
                {path: 'admin', name: '系统管理', component: Admin,},
            ]
        }
    ]
})
