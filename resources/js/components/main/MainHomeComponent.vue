<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="jumbotron">
        <h1 class="display-4">Ingin Belajar Apa ?</h1>
        <p class="lead">Gunakan kotak pencarian di bawah untuk mencari kelas yang diinginkan.</p>
        <hr class="my-4" />
        <form @submit.prevent="gotoCari()">
          <label>Cari kelas</label>
          <div class="form-inline">
            <input type="text" name="query" class="form-control" v-model="txCariVal" placeholder="contoh: pemrograman" required />
            <button type="submit" class="btn btn-primary ml-2" v-bind:disabled="btnCariIsDisabled">Cari</button>
          </div>
        </form>
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
      title: Const.TITLE + "Selamat Datang",

      // search form
      txCariVal: "",
      btnCariIsDisabled: false
    };
  },
  methods:{
    gotoCari(){
      this.btnCariIsDisabled = true;

      this.$router.push("/cari?query="+this.txCariVal);
    }
  }
};
</script>