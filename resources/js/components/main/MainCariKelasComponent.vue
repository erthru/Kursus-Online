<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <h4>Menampilkan hasil pencarian "{{queryParams}}"</h4>
      <br />
      <div class="row justify-content-md-center">
        <div
          class="spinner-border text-primary"
          role="status"
          v-bind:hidden="searchLoadingIsHidden"
        >
          <span class="sr-only">Loading...</span>
        </div>
        <div v-bind:hidden="searchResultIsEmptyInfoIsHidden">
          <center>
            <label>
              Data pencarian tidak ditemukan.
              <br />
              <router-link to="/">Kembali ke pencarian</router-link>
            </label>
          </center>
        </div>
      </div>
      <div class="row justify-content-md-center" v-for="item in searchResults" :key="item.id">
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
              <router-link class="text-primary h5" :to="'/kelas/'+item.id">{{item.nama}}</router-link>
              <p style="overflow:hidden; white-space:nowrap">{{item.deskripsi}}</p>
              <div class="row">
                <div class="col-md-4">
                  <small>Last updated on: {{item.updated_at}}</small>
                </div>
                <div class="col-md-8">
                  <h5
                    class="text-danger"
                    style="text-align:right"
                  >{{item.harga == '0' ? 'GRATIS' : 'Rp.' + getRupiah(item.harga)}}</h5>
                </div>
              </div>
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
      title: Const.TITLE + "Pencarian untuk kelas " + this.$route.query.query,
      queryParams: this.$route.query.query,
      searchLoadingIsHidden: false,
      searchResultIsEmptyInfoIsHidden: true,
      searchResults: [],
      page: 0
    };
  },
  mounted() {
    this.loadHasilPencarian();
    this.scroll();
  },
  methods: {
    loadHasilPencarian() {
      this.page += 1;

      axios
        .get(
          Const.API_BASE_URL +
            "kelas/search/query?q=" +
            this.$route.query.query +
            "&page=" +
            this.page
        )
        .then(res => {
          this.searchLoadingIsHidden = true;

          for (var i = 0; i < res.data.data.data.length; i++) {
            this.searchResults.push(res.data.data.data[i]);
          }

          if (this.searchResults.length == 0 && this.page == 1) {
            this.searchResultIsEmptyInfoIsHidden = false;
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
          this.loadHasilPencarian();
          console.log("reached the bottom");
        }
      };
    }
  }
};
</script>