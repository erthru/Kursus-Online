<template>
  <div>
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form v-on:submit.prevent="editProfile()">
            <div class="form-group">
              Nama Depan:
              <input type="text" class="form-control" v-model="namaDepanVal" required />
            </div>
            <div class="form-group">
              Nama Belakang:
              <input
                type="text"
                class="form-control"
                v-model="namaBelakangVal"
                required
              />
            </div>
            <div class="form-group">
              Telp:
              <input type="text" class="form-control" v-model="telpVal" disabled required />
            </div>
            <div class="form-group">
              Email:
              <input type="email" class="form-control" v-model="emailVal" disabled required />
            </div>
            <div class="form-group">
              Password:
              <input type="password" class="form-control" v-model="passwordVal" required />
            </div>
            <button
              class="btn btn-primary"
              type="submit"
              v-bind:disabled="btnPerbaruiIsDisabled"
            >Perbarui</button>
          </form>
        </div>
        <div class="col-md-4 offset-md-2">
          <div class="pb-4 pt-4 pl-4 pr-4" style="background-color: #dcdde1">
            <h3>Saldo Anda:</h3>
            <h4>
              <strong>Rp. {{ textTools.getRupiah(owner.saldo) }}</strong>
            </h4>
            <button
              class="btn btn-warning w-100 mt-1"
              data-toggle="modal"
              data-target="#topupModal"
            >TOPUP</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Topup modal -->
    <div
      class="modal fade"
      id="topupModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form v-on:submit.prevent>
              <div class="form-group">
                Jumlah topup:
                <input
                  type="number"
                  class="form-control"
                  v-model="jumlahTopupVal"
                  required
                />
              </div>
              <div class="form-group">
                Pilih metode pembayaran: {{ selectedMetodePembayaran }}
                <br />
                <div class="btn-group mt-1" role="group">
                  <button
                    type="button"
                    class="btn btn-warning"
                    v-on:click="selectedMetodePembayaran = 'BRI LINK'"
                    required
                  >BRI Link</button>
                  <button
                    type="button"
                    class="btn btn-warning"
                    v-on:click="selectedMetodePembayaran = 'BNI DIRECT'"
                    required
                  >BNI Direct</button>
                </div>
              </div>
            </form>
            <div class="alert alert-danger" v-if="jumlahTopupIsNull">Jumlah topup belum diisi</div>
            <div
              class="alert alert-danger"
              v-if="selectedMetodePembayaranIsNull"
            >Metode pembayaran belum dipilih</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" v-on:click="topup">Topup</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Topup modal Status-->
    <div
      class="modal fade"
      id="topupModalStatus"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">{{ topupModalStatusInformation }}</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="reloadPage()">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Const from "../../helper/Const";
import TextTools from "../../helper/TextTools";
export default {
  data() {
    return {
      owner: {},
      saldo: "0",
      textTools: TextTools,
      const: Const,
      namaDepanVal: "",
      namaBelakangVal: "",
      telpVal: "",
      emailVal: "",
      passwordVal: "",
      btnPerbaruiIsDisabled: false,
      selectedMetodePembayaran: "",
      jumlahTopupVal: "",
      selectedMetodePembayaranIsNull: false,
      jumlahTopupIsNull: false,
      topupModalStatusInformation: ""
    };
  },
  mounted() {
    this.loadPenggunaDetail();
  },
  methods: {
    loadPenggunaDetail() {
      axios
        .get(
          this.const.API_BASE_URL +
            "pengguna/" +
            localStorage.getItem(this.const.PENGGUNA_ID)
        )
        .then(res => {
          this.owner = res.data.data;
          this.namaDepanVal = this.owner.nama_depan;
          this.namaBelakangVal = this.owner.nama_belakang;
          this.telpVal = this.owner.telp;
          this.emailVal = this.owner.email;
          this.passwordVal = this.owner.password;
        });
    },
    editProfile() {
      this.btnPerbaruiIsDisabled = true;

      const body = {
        nama_depan: this.namaDepanVal,
        nama_belakang: this.namaBelakangVal,
        telp: this.telpVal,
        email: this.emailVal,
        password: this.passwordVal
      };

      axios
        .put(
          this.const.API_BASE_URL +
            "pengguna/" +
            localStorage.getItem(this.const.PENGGUNA_ID),
          body
        )
        .then(res => {
          this.$router.go(0);
        });
    },
    topup() {
      this.jumlahTopupIsNull = false;
      this.selectedMetodePembayaranIsNull = false;

      if (this.jumlahTopupVal == "") {
        this.jumlahTopupIsNull = true;
      }

      if (this.selectedMetodePembayaran == "") {
        this.selectedMetodePembayaranIsNull = true;
      }

      if (!this.jumlahTopupIsNull && !this.selectedMetodePembayaranIsNull) {
        $("#topupModal").modal("hide");
        $("#topupModalStatus").modal();

        this.topupModalStatusInformation = "Memproses ...";

        const body = {
          saldo: this.jumlahTopupVal
        };

        axios
          .put(
            this.const.API_BASE_URL +
              "pengguna/" +
              localStorage.getItem(this.const.PENGGUNA_ID) +
              "/saldo/add",
            body
          )
          .then(res => {
              this.topupModalStatusInformation = "Topup berhasil.";
          });
      }
    },
    reloadPage(){
        this.$router.go(0);
    }
  }
};
</script>