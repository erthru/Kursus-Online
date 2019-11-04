<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <!-- kelas detail form -->
        <div class="col-md-6">
          <h4>Kelas Detail</h4>
          <div class="alert alert-success" v-bind:hidden="successMsgIsHidden">{{successMsg}}</div>
          <form @submit.prevent="updateKelas()">
            <div class="form-group">
              <label>Nama Kelas</label>
              <input
                type="text"
                placeholder="Contoh: Matematika dasar"
                class="form-control"
                v-model="txNamaKelasVal"
                required
              />
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea
                type="text"
                placeholder="Deksripsi"
                class="form-control"
                v-model="txDeskripsiVal"
                required
              />
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input
                type="number"
                placeholder="0"
                class="form-control"
                v-model="txHargaVal"
                required
              />
            </div>
            <button
              type="submit"
              class="btn btn-warning"
              v-bind:disabled="btnUpdateKelasDetailIsDisabled"
            >Update</button>
            <button
              type="button"
              class="btn btn-danger"
              v-on:click="deleteKelas()"
              v-bind:disabled="btnDeleteKelasDetailIsDisabled"
              v-bind:hidden="btnDeleteKelasDetailIsHidden"
            >Delete</button>
          </form>
        </div>
        <!-- kelas detail form -->
        <div class="col-md-6">
          <h4>Daftar Siswa Yang Terdaftar di Kelas Ini</h4>
          <small v-bind:hidden="lbNoSiswaIsHidden">
            Belum ada daftar siswa yang terdaftar
            <br />Kelas masih dapat dihapus saat belum ada siswa yang terdaftar
          </small>
          <div v-for="(siswa, index) in daftarSiswa" :key="siswa.id">
            {{index+=1}}. {{siswa.pengguna.nama_depan}} {{siswa.pengguna.nama_belakang}}
          </div>
          <div style="margin-top:10px">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li v-bind:class="pagePrevSiswa">
                  <button class="page-link" v-on:click="loadSiswa('prev')">&laquo;</button>
                </li>
                <li class="page-item disabled">
                  <button class="page-link">{{pageSiswa}} of {{pageSiswaTotal}}</button>
                </li>
                <li v-bind:class="pageNextSiswa">
                  <button class="page-link" v-on:click="loadSiswa('next')">&raquo;</button>
                </li>
              </ul>
            </nav>
          </div>
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
  mounted() {
    this.loadKelasDetail();
    this.loadSiswa("next");
  },
  data() {
    return {
      title: Const.TITLE + "Buka Kelas Detail",
      daftarSiswa: [],
      pageSiswa: 0,
      pageSiswaTotal: 0,
      pageNextSiswa: "page-item disabled",
      pagePrevSiswa: "page-item disabled",
      successMsg: "",
      successMsgIsHidden: true,

      // form kelas detail
      txNamaKelasVal: "",
      txDeskripsiVal: "",
      txHargaVal: "0",
      btnUpdateKelasDetailIsDisabled: false,
      btnDeleteKelasDetailIsDisabled: false,
      btnDeleteKelasDetailIsHidden: false,

      // daftar siswa
      lbNoSiswaIsHidden: false
    };
  },
  methods: {
    loadKelasDetail() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.txNamaKelasVal = res.data.data.nama;
          this.txDeskripsiVal = res.data.data.deskripsi;
          this.txHargaVal = res.data.data.harga;
        });
    },
    loadSiswa(mod) {
      if (mod == "next") {
        this.pageSiswa += 1;
      } else {
        this.pageSiswa -= 1;
      }

      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id + "?page="+this.pageSiswa)
        .then(res => {
          if (parseInt(res.data.has_many_count.kelasAnggota) > 0) {
            this.btnDeleteKelasDetailIsHidden = true;
            this.daftarSiswa = res.data.data.kelas_anggota;
            this.lbNoSiswaIsHidden = true;

            let hasManyCountKelas = parseInt(
              res.data.has_many_count.kelasAnggota
            );
            let limit = 15;
            this.pageSiswaTotal = Math.ceil(hasManyCountKelas / limit);

            this.setupPageSiswa();
          }
        });
    },
    setupPageSiswa() {
      if (this.pageSiswa == 1) {
        this.pagePrevSiswa = "page-item disabled";
      }

      if (this.pageSiswa > 1) {
        this.pagePrevSiswa = "page-item";
      }

      if (this.pageSiswaTotal > 1) {
        this.pageNextSiswa = "page-item";
      }

      if (this.pageSiswa == this.pageSiswaTotal) {
        this.pageNextSiswa = "page-item disabled";
      }
    },
    updateKelas() {
      this.successMsgIsHidden = true;
      this.btnUpdateKelasDetailIsDisabled = true;

      let params = {
        nama: this.txNamaKelasVal,
        deskripsi: this.txDeskripsiVal,
        harga: this.txHargaVal
      };

      axios
        .put(Const.API_BASE_URL + "kelas/" + this.$route.params.id, params)
        .then(res => {
          this.successMsg = "Data Kelas Diperbarui.";
          this.successMsgIsHidden = false;
          this.btnUpdateKelasDetailIsDisabled = false;
        });
    },
    deleteKelas() {
      this.successMsgIsHidden = true;
      this.btnDeleteKelasDetailIsDisabled = true;

      axios
        .delete(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.$router.push("/buka_kelas");
        });
    }
  }
};
</script>