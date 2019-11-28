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
