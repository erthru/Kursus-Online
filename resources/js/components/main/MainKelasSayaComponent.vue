<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <!--form buka kelas -->
        <div class="col-md-6">
          <h4>Buka Kelas Baru</h4>
          <div class="alert alert-success" v-bind:hidden="successMsgIsHidden">{{successMsg}}</div>
          <form v-on:submit.prevent="bukaKelas()">
            <div class="form-group">
              <label>Nama Kelas</label>
              <input
                type="text"
                class="form-control"
                placeholder="Contoh: Matematika Dasar"
                v-model="txNamaKelasVal"
                required
              />
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea
                type="text"
                class="form-control"
                placeholder="Keterangan"
                v-model="txDeskripsiVal"
                required
              />
            </div>
            <div class="form-group">
              <label>
                Tentukan Harga
                <br>
                * Terdapat potongan biaya administrasi sebesar {{biayaAdmin}}% dari harga jual kelas (Jika Berbayar)
              </label>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                value="0"
                v-model="txHargaVal"
                required
              />
            </div>
            <button
              type="submit"
              class="btn btn-primary"
              v-bind:disabled="btnSubmitIsDisabled"
            >Submit</button>
          </form>
        </div>
        <!--form daftar kelas -->
        <div class="col-md-6">
          <h4>Daftar Kelas Saya</h4>
          <div v-for="item in kelas" :key="item.id">
            <router-link class="text-primary" :to="'/kelas_saya/'+item.id">{{item.nama}}</router-link>
          </div>
          <div style="margin-top:10px">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li v-bind:class="pagePrevElementVal">
                  <button class="page-link" v-on:click="loadKelas('prev')">&laquo;</button>
                </li>
                <li class="page-item disabled">
                  <button class="page-link">{{page}} of {{totalPage}}</button>
                </li>
                <li v-bind:class="pageNextElementVal">
                  <button class="page-link" v-on:click="loadKelas('next')">&raquo;</button>
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
import Const from "../../helper/Const";
import VueHeadful from "vue-headful";
export default {
  components: {
    VueHeadful
  },
  mounted() {
    if (localStorage.getItem(Const.PENGGUNA_ID) == null) {
      this.$router.push("/");
    }
    this.loadKelas("next");
  },
  data() {
    return {
      title: Const.TITLE + "Kelas Saya",
      page: 0,
      totalPage: 0,
      pageNextElementVal: "page-item disabled",
      pagePrevElementVal: "page-item disabled",
      kelas: [],
      successMsg: "",
      successMsgIsHidden: true,
      biayaAdmin: Const.BIAYA_ADMIN,

      // buat kelas element
      txNamaKelasVal: "",
      txDeskripsiVal: "",
      txHargaVal: "0",
      btnSubmitIsDisabled: false
    };
  },
  methods: {
    bukaKelas() {
      this.btnSubmitIsDisabled = true;
      this.successMsgIsHidden = true;

      let params = {
        nama: this.txNamaKelasVal,
        deskripsi: this.txDeskripsiVal,
        harga: this.txHargaVal,
        pengguna_id: localStorage.getItem(Const.PENGGUNA_ID)
      };

      axios.post(Const.API_BASE_URL + "kelas", params).then(res => {
        this.successMsg = "Kelas berhasil dibuat.";
        this.successMsgIsHidden = false;
        this.btnSubmitIsDisabled = false;
        this.txNamaKelasVal = "";
        this.txDeskripsiVal = "";
        this.txHargaVal = "0";
        this.page = 0;
        this.loadKelas("next");
      });
    },
    loadKelas(mode) {
      if (mode == "next") {
        this.page += 1;
      } else {
        this.page -= 1;
      }

      axios
        .get(
          Const.API_BASE_URL +
            "pengguna/" +
            localStorage.getItem(Const.PENGGUNA_ID) +
            "?page=" +
            this.page
        )
        .then(res => {
          let hasManyCountKelas = parseInt(res.data.has_many_count.kelas);
          let limit = 15;
          this.totalPage = Math.ceil(hasManyCountKelas / limit);
          this.kelas = res.data.data.kelas;

          this.setupPagination();
        });
    },
    setupPagination() {
      if (this.page == 1) {
        this.pagePrevElementVal = "page-item disabled";
      }

      if (this.page > 1) {
        this.pagePrevElementVal = "page-item";
      }

      if (this.totalPage > 1) {
        this.pageNextElementVal = "page-item";
      }

      if (this.page == this.totalPage) {
        this.pageNextElementVal = "page-item disabled";
      }
    }
  }
};
</script>