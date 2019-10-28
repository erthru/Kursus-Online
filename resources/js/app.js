import './bootstrap';
import VueRouter from 'vue-router';

// component
// main
import AppComponent from './components/AppComponent';

// default a.k.a non child
import HomeComponent from './components/default/HomeComponent';
import BergabungComponent from './components/default/BergabungComponent';

// dashboard
import DashboardComponent from './components/dashboard/DashboardComponent';
import DashboardHomeComponent from './components/dashboard/DashboardHomeComponent';


window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: HomeComponent
    },
    {
        path: '/bergabung',
        component: BergabungComponent
    },
    {
        path: '/dashboard',
        component: DashboardComponent,
        children: [
            {
                path: '/',
                component: DashboardHomeComponent
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    base: '/',
    scrollBehavior: function (to) {
        if (to.hash) {
            return {
                selector: to.hash
            }
        }
    }
});

new Vue(Vue.util.extend({ router }, AppComponent)).$mount('#app');
