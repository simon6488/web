import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home'
import Login from '../views/Login'
import Container from '../container/Container'
import Dashboard from '../views/dashboard/Index'
import Admin from '../views/admin/Index'
import Student from '../views/student/Index'
import Grade from '../views/grade/Index'
import Game from "../views/game/Game";

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/dashboard',
      redirect: '/dashboard',
      name: 'Container',
      component: Container,
      children: [
        {path: 'dashboard', name: '首页', component: Dashboard},
        {path: 'student', name: '学生管理', component: Student},
        {path: 'grade', name: '成绩管理', component: Grade},
        {path: 'admin', name: '系统管理', component: Admin}
      ]
    },
    {
      path: '/game',
      name: 'Game',
      component: Game
    }
  ]
})
