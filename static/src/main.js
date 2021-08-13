// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueParticles from 'vue-particles'
import ElementUI from 'element-ui'
import axios from 'axios'
import Cookies from 'js-cookie'
import Global from './global/Global'
import filters from './filters/filters'
import 'element-ui/lib/theme-chalk/index.css'
import '@/styles/index.scss'
import 'font-awesome/scss/font-awesome.scss'

Vue.use(VueParticles)
Vue.use(ElementUI)

// axios
axios.defaults.baseURL = Global.baseUrl
axios.defaults.timeout = 5000

// http request 封装请求头拦截器
axios.interceptors.request.use(
  config => {
    let token = ''
    if (Cookies.get('user') === undefined) {
    } else {
      let user = JSON.parse(Cookies.get('user'))
      if (user) {
        token = user.token
      }
    }
    // 注意使用的时候需要引入cookie方法，推荐js-cookie
    config.data = JSON.stringify(config.data)
    config.headers = {
      'Content-Type': 'application/json'
    }
    if (token !== '') {
      config.headers.token = token
    }
    return config
  },
  error => {
    return Promise.reject(error)
  }
);

// http response 封装后台返回拦截器
axios.interceptors.response.use(
  response => {
    // 当返回信息为未登录或者登录失效的时候重定向为登录页面
    if (response.data.code === 401 || response.data.code === 403) {
      router.push('/login')
    }
    return response
  },
  error => {
    return Promise.reject(error)
  }
)
Vue.prototype.$http = axios

// Cookies
Vue.prototype.$cookies = Cookies

// filters
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})

Vue.config.productionTip = false

router.beforeEach((to, from, next) => {
  let user = Cookies.get('user')
  if (!user && to.path !== '/login' && to.path !== '/' && to.path !== '/game') {
    next({
      path: '/login'
    })
  } else {
    next()
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
