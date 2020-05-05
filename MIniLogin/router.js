import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'

import WelcomePage from './components/welcome/welcome.vue'
import DashboardPage from './components/dashboard/dashboard.vue'
import SignupPage from './components/auth/signup.vue'
import SigninPage from './components/auth/signin.vue'
import CRUD from './components/CRUD/App.vue'
import Game from './components/MonsterSlayer/App.vue'
//import MonsterSlayer from './components/MonsterSlayer/TheMonsterSlayer.vue'

Vue.use(VueRouter)

const routes = [
  { path: '/', component: WelcomePage },
  { path: '/signup', component: SignupPage },
  { path: '/signin', component: SigninPage },
  {
        path: '/dashboard',
        component: DashboardPage,
        beforeEnter(to, from, next) {
            if (store.state.idToken) {
                next()
            } else {
                next('/signin')
            }
        }
    },
    {
        path: '/crud',
        component: CRUD,
        beforeEnter(to, from, next) {
            if (store.state.idToken) {
                next()
            } else {
                next('/signin')
            }
        }
    },
    {
        path: '/game',
        component: Game,
        beforeEnter(to, from, next) {
            if (store.state.idToken) {
                next()
            } else {
                next('/signin')
            }
        }
    }
    //{
    //    path: '/MonsterSlayer',
    //    component: MonsterSlayer,
    //    beforeEnter(to, from, next) {
    //        if (store.state.idToken) {
    //            next()
    //        } else {
    //            next('/signin')
    //        }
    //    }
    //}
]

export default new VueRouter({mode: 'history', routes})