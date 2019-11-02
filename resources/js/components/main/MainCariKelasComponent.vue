<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
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