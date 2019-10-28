<template>
  <div>
    <!-- default menu -->
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-primary"
      v-bind:hidden="bergabungMenuIsHidden"
    >
      <router-link class="navbar-brand" to="/">Kursus Online</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContentBergabung"
        aria-controls="navbarSupportedContentBergabung"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContentBergabung">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/bergabung">Bergabung</router-link>
          </li>
        </ul>
      </div>
    </nav>

    <!-- when user logged in -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" v-bind:hidden="userMenuIsHidden">
      <router-link class="navbar-brand" to="/">Kursus Online</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContentUser"
        aria-controls="navbarSupportedContentUser"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContentUser">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/buka_kelas">Buka Kelas</router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/profile">Hello, {{userNamaLengkap}}</router-link>
          </li>
          <li class="nav-item active">
            <router-link class="nav-link" to="/logout">Logout</router-link>
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
  mounted() {
    if (localStorage.getItem(Const.PENGGUNA_ID) != null) {
      (this.bergabungMenuIsHidden = true), (this.userMenuIsHidden = false);

      this.loadUser();
    }
  },
  data() {
    return {
      bergabungMenuIsHidden: false,
      userMenuIsHidden: true,
      userNamaLengkap: "Memuat..."
    };
  },
  methods: {
    loadUser() {
      axios
        .get(
          Const.API_BASE_URL +
            "pengguna/" +
            localStorage.getItem(Const.PENGGUNA_ID)
        )
        .then(res => {
          this.userNamaLengkap =
            res.data.data.nama_depan + " " + res.data.data.nama_belakang;
        });
    }
  }
};
</script>