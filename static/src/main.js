// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueParticles from 'vue-particles'
import ElementUI from 'element-ui'
import axios from 'axios'
import Global from './global/Global'
import 'element-ui/lib/theme-chalk/index.css'
import '@/styles/index.scss'
import 'font-awesome/scss/font-awesome.scss'

Vue.use(VueParticles)
Vue.use(ElementUI)
axios.defaults.baseURL = Global.baseUrl
Vue.prototype.$http = axios
Vue.config.productionTip = false

router.beforeEach((to, from, next) => {
    if (to.path === '/login') {
        sessionStorage.removeItem('user');
    }
    var user = sessionStorage.getItem('user');
    if (!user && to.path !== '/login') {
        next({
            path: '/login'
        })
    } else {
        next();
    }
})

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
})
