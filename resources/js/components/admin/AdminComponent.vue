<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <router-link class="navbar-brand" to="/admin">Kursus Online | Admin</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/admin">
              Home
              <span class="sr-only">(current)</span>
            </router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto" v-if="admin != undefined">
          <li class="nav-item active">
            <span class="nav-link">Logged As, {{admin.nama_depan + ' ' + admin.nama_belakang}}</span>
          </li>
          <li class="nav-item active">
            <span class="nav-link" v-on:click="logout()">Logout</span>
          </li>
        </ul>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
import Const from "../../helper/Const";
export default {
    data(){
        return {
            admin: {}
        }
    },
    mounted(){
        this.loadAdminDetail();
    },
    methods: {
        loadAdminDetail(){
            axios.get(Const.API_BASE_URL + "admin/" + localStorage.getItem(Const.ADMIN_ID)).then(res => {
                this.admin = res.data.data;
            });
        },
        logout(){
            localStorage.removeItem(Const.ADMIN_ID);
            this.$router.go(0);
        }
    }
};
</script>