import './bootstrap';
import VueRouter from 'vue-router';

// component
// main
import AppComponent from './components/AppComponent';

// main
import MainComponent from './components/main/MainComponent';
import MainHomeComponent from './components/main/MainHomeComponent';
import MainBergabungComponent from './components/main/MainBergabungComponent';
import MainKelasSayaComponent from './components/main/MainKelasSayaComponent';
import MainKelasSayaDetailComponent from './components/main/MainKelasSayaDetailComponent';
import MainKelasSayaMateriTambahComponent from './components/main/MainKelasSayaMateriTambahComponent';
import MainKelasSayaMateriDetailComponent from './components/main/MainKelasSayaMateriDetailComponent';
import MainKelasDibeliComponent from './components/main/MainKelasDibeliComponent';
import MainKelasDibeliDetailComponent from './components/main/MainKelasDibeliDetailComponent';
import MainKelasDibeliDetailMateriComponent from './components/main/MainKelasDibeliDetailMateriComponent';
import MainCariKelasComponent from './components/main/MainCariKelasComponent';
import MainKelasDetailComponent from './components/main/MainKelasDetailComponent';
import MainProfileComponent from './components/main/MainProfileComponent';

// admin
import AdminComponent from "./components/admin/AdminComponent";
import AdminDashboardComponent from "./components/admin/AdminDashboardComponent";
import AdminLoginComponent from "./components/admin/AdminLoginComponent";

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
                path: '/bergabung',
                component: MainBergabungComponent
            },
            {
                path:'/kelas_saya',
                component: MainKelasSayaComponent
            },
            {
                path:'/kelas_saya/:id',
                component: MainKelasSayaDetailComponent
            },
            {
                path:'/kelas_dibeli',
                component: MainKelasDibeliComponent
            },
            {
                path:'/kelas_dibeli/:id',
                component: MainKelasDibeliDetailComponent
            },
            {
                path:'/kelas_dibeli/:kelas_id/materi/:materi_id',
                component: MainKelasDibeliDetailMateriComponent
            },
            {
                path:'/kelas_saya/:id/materi/add',
                component: MainKelasSayaMateriTambahComponent
            },
            {
                path:'/kelas_saya/:kelas_id/materi/:materi_id',
                component: MainKelasSayaMateriDetailComponent
            },
            {
                path:"/cari",
                component: MainCariKelasComponent
            },
            {
                path:"/kelas/:id",
                component: MainKelasDetailComponent
            },
            {
                path:"/profile",
                component: MainProfileComponent
            }
        ]
    },
    {
        path: '/admin',
        component: AdminComponent,
        children: [
            {
                path: '/',
                component: AdminDashboardComponent
            },
            {
                path: '/login',
                component: AdminLoginComponent
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
