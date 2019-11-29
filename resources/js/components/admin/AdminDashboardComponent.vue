<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <h4>Dasboard</h4>
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="container bg-light p-3">
            <h5>Pengguna Terdaftar</h5>
            <h2>{{penggunaTerdaftar}}</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="container bg-light p-3">
            <h5>Kelas Di beli</h5>
            <h2>{{kelasDibeli}}</h2>
          </div>
        </div>
      </div>
      <br />
      <div class="container bg-light p-3">
        <h5>Pendapatan</h5>
        <h2>{{'Rp. ' + getRupiah(pendapatan)}}</h2>
      </div>
    </div>
  </div>
</template>

<script>
import Const from "../../helper/Const";
import TextTools from "../../helper/TextTools";
import VueHeadful from "vue-headful";
export default {
  components: {
    VueHeadful
  },
  data() {
    return {
      title: Const.TITLE + "Admin Dashboard",
      penggunaTerdaftar: 0,
      kelasDibeli: 0,
      pendapatan: 0
    };
  },
  mounted() {
    if (localStorage.getItem(Const.ADMIN_ID) == null) {
      this.$router.push("/admin/login");
    }

    this.loadData();
  },
  methods: {
    loadData() {
      axios.get(Const.API_BASE_URL + "pengguna").then(res => {
        this.penggunaTerdaftar = res.data.data.total;
      });

      axios.get(Const.API_BASE_URL + "kelas_anggota").then(res => {
        this.kelasDibeli = res.data.data.total;
      });

      axios.get(Const.API_BASE_URL + "perusahaan").then(res => {
        this.pendapatan = res.data.data.saldo;
      });
    },
    getRupiah(x) {
      return TextTools.getRupiah(x);
    }
  }
};
</script>