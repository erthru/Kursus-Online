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
import MainBukaKelasComponent from './components/main/MainBukaKelasComponent';
import MainBukaKelasDetailComponent from './components/main/MainBukaKelasDetailComponent';
import MainCariKelasComponent from './components/main/MainCariKelasComponent';
import MainKelasDetailComponent from './components/main/MainKelasDetailComponent';

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
            },
            {
                path:'/buka_kelas',
                component: MainBukaKelasComponent
            },
            {
                path:'/buka_kelas/:id',
                component: MainBukaKelasDetailComponent
            },
            {
                path:"/cari",
                component: MainCariKelasComponent
            },
            {
                path:"/kelas/:id",
                component: MainKelasDetailComponent
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
