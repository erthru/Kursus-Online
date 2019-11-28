<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <h4>Daftar kelas yang dibeli</h4>
      <div class="row justify-content-md-center">
        <div class="spinner-border text-primary mt-4" role="status" v-if="isLoading">
          <span class="sr-only">Loading...</span>
        </div>
        <div v-if="resultIsEmpty">
          <center>
            <label>
              Anda belum membeli kelas.
              <br />
              <router-link to="/">Cari kelas</router-link>
            </label>
          </center>
        </div>
      </div>
      <div class="row justify-content-md-center mt-4" v-for="kelas in kelass" :key="kelas.kelas.id">
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-3">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS1Nlfy8fzqVzcYr2k8euUk5wt071Qp5xGvkzUydVNj1ntgGdEs"
                width="100%"
                height="100px"
              />
            </div>
            <div class="col-md-9 mt-2">
              <router-link
                class="text-primary h5"
                :to="'/kelas_dibeli/'+kelas.kelas.id"
              >{{kelas.kelas.nama}}</router-link>
              <p style="overflow:hidden; white-space:nowrap">{{kelas.kelas.deskripsi}}</p>
              <small>Last updated on: {{kelas.kelas.updated_at}}</small>
            </div>
          </div>
          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueHeadful from "vue-headful";
import Const from "../../helper/Const";
import TextTools from "../../helper/TextTools";
export default {
  components: {
    VueHeadful
  },
  data() {
    return {
      title: Const.TITLE + "Kelas Yang Dibeli",
      isLoading: true,
      resultIsEmpty: false,
      page: 0,
      kelass: []
    };
  },
  mounted() {
    this.loadKelas();
    this.scroll();
  },
  methods: {
    loadKelas() {
      this.page += 1;

      axios
        .get(
          Const.API_BASE_URL +
            "kelas_anggota/anggota?pengguna_id=" +
            localStorage.getItem(Const.PENGGUNA_ID) +
            "&page=" +
            this.page
        )
        .then(res => {
          this.isLoading = false;

          for (var i = 0; i < res.data.data.data.length; i++) {
            this.kelass.push(res.data.data.data[i]);
          }

          if (this.kelass.length == 0) {
            this.resultIsEmpty = true;
          }
        });
    },
    getRupiah(x) {
      return TextTools.getRupiah(x);
    },
    scroll() {
      window.onscroll = () => {
        let bottomOfWindow =
          Math.max(
            window.pageYOffset,
            document.documentElement.scrollTop,
            document.body.scrollTop
          ) +
            window.innerHeight ===
          document.documentElement.offsetHeight;
        if (bottomOfWindow) {
          this.loadKelas();
          console.log("reached the bottom");
        }
      };
    }
  }
};
</script>