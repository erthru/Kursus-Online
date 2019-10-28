import './bootstrap';
import VueRouter from 'vue-router';

// component
// main
import AppComponent from './components/AppComponent';

// default a.k.a non child
import BergabungComponent from './components/default/BergabungComponent';
import LogoutComponent from './components/default/LogoutComponent';

// main
import MainComponent from './components/main/MainComponent';
import MainHomeComponent from './components/main/MainHomeComponent';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: MainComponent,
        children: [
            {
                path:'/',
                component: MainHomeComponent
            }
        ]
    },
    {
        path: '/bergabung',
        component: BergabungComponent
    },
    {
        path: '/logout',
        component: LogoutComponent
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
