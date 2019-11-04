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
              <router-link class="text-primary h5" :to="'/detail/'+item.id">{{item.nama}}</router-link>
              <p style="overflow:hidden; white-space:nowrap">{{item.deskripsi}}</p>
              <small>Last updated on: {{item.updated_at}}</small>
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
      searchResults: []
    };
  },
  mounted() {
    this.loadHasilPencarian();
  },
  methods: {
    loadHasilPencarian() {
      axios
        .get(
          Const.API_BASE_URL + "kelas/search/query?q=" + this.$route.query.query
        )
        .then(res => {
          this.searchLoadingIsHidden = true;

          this.searchResults = res.data.data.data;

          if (this.searchResults.length == 0) {
            this.searchResultIsEmptyInfoIsHidden = false;
          }
        });
    }
  }
};
</script>