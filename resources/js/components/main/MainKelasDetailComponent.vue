<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h4>{{ kelasTitle }}</h4>
          <small>Oleh {{ owner.nama_depan + " " + owner.nama_belakang }}</small>
          <p>{{ deskripsi }}</p>
          <br />
          <h4>Daftar Materi</h4>
          <small v-if="materis.length == 0">Kelas ini belum memiliki materi.</small>
          <div v-for="(materi, index) in materis" :key="materi.id">
            {{
            (index += 1) +
            ". " +
            (materi.tipe == "MATERI" ? materi.materi[0].judul : "Kuis")
            }}
          </div>
        </div>
        <div class="col-md-4">
          <div class="pb-4 pt-4 pl-4 pr-4" style="background-color: #dcdde1">
            <img
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS1Nlfy8fzqVzcYr2k8euUk5wt071Qp5xGvkzUydVNj1ntgGdEs"
              width="100%"
              height="200px"
            />
            <h1 class="display-5 mt-3">
              <strong>{{ harga }}</strong>
            </h1>
            <small v-if="alreadyBuy">Anda telah berada di kelas ini</small>
            <button
              class="btn btn-warning w-100 mt-1"
              data-toggle="modal"
              data-target="#beliConfirmationModal"
              v-if="owner.id != penggunaId && !alreadyBuy"
            >BELI SEKARANG</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Beli Confirmation Modal -->
    <div
      class="modal fade"
      id="beliConfirmationModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="isLoggedIn">
              <h5>Anda yakin untuk membeli kelas ini ?</h5>
              <br />Saldo anda saat ini:
              <div class="text-danger">
                <strong>Rp. {{ penggunaSaldo }}</strong>
              </div>
              <br />(saldo akan langsung terpotong saat anda menekan tombol beli)
            </div>
            <div v-if="!isLoggedIn">
              Bergabung untuk bisa beli kelas.
              <br />
              <a href="#" v-on:click="bergabung()">Bergabung</a>
            </div>
          </div>
          <div class="modal-footer" v-if="isLoggedIn">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              v-on:click="beli()"
            >Beli</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Beli Information Modal -->
    <div
      class="modal fade"
      id="beliInformationModal"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-labelledby="exampleModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
          </div>
          <div class="modal-body">
            <h5>Keterangan Pembelian</h5>
            {{ keteranganPembelian }}
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              v-on:click="reloadPage()"
              v-if="keteranganPembelian != 'Memproses...'"
            >Tutup</button>
          </div>
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
      title: Const.TITLE,
      pageAnggota: 0,
      owner: {},
      kelasTitle: "",
      kelasId: "",
      deskripsi: "",
      harga: "Rp. 0",
      materis: [],
      anggotas: [],
      penggunaSaldo: "0",
      penggunaId: "",
      alreadyBuy: false,
      keteranganPembelian: "",
      isLoggedIn: false
    };
  },
  mounted() {
    this.penggunaId = localStorage.getItem(Const.PENGGUNA_ID);

    this.isLoggedIn =
      localStorage.getItem(Const.PENGGUNA_ID) == null ? false : true;

    this.loadKelasDetail();
    this.loadKelasMateri();
    this.loadPenggunaDetail();
  },
  methods: {
    checkAlreadyBuy() {
      axios
        .get(
          Const.API_BASE_URL +
            "kelas_anggota/check/anggota?pengguna_id=" +
            this.penggunaId +
            "&kelas_id=" +
            this.kelasId
        )
        .then(res => {
          if (res.data.data != null) {
            this.alreadyBuy = true;
          }
        });
    },
    loadKelasDetail() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.kelasTitle = res.data.data.nama;
          this.title += this.kelasTitle;
          this.owner = res.data.data.pengguna;
          this.deskripsi = res.data.data.deskripsi;
          this.harga = "Rp. " + TextTools.getRupiah(res.data.data.harga);
          this.kelasId = res.data.data.id;

          if (this.harga == "Rp. 0") {
            this.harga = "GRATIS";
          }
        });
    },
    loadKelasMateri(mod) {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          for (var i = 0; i < res.data.data.materi.length; i++) {
            this.materis.push(res.data.data.materi[i]);
          }
        });
    },
    loadKelasAnggota(mod) {
      if (mod == "next") {
        this.pageAnggota += 1;
      } else {
        this.pageAnggota -= 1;
      }

      axios
        .get(
          Const.API_BASE_URL +
            "kelas/" +
            this.$route.params.id +
            "?page=" +
            this.pageAnggota
        )
        .then(res => {
          for (var i = 0; i < res.data.data.materi.length; i++) {
            this.anggotas.push(res.data.data.kelas_anggota[i]);
          }
        });
    },
    loadPenggunaDetail() {
      axios
        .get(Const.API_BASE_URL + "pengguna/" + this.penggunaId)
        .then(res => {
          this.penggunaSaldo = TextTools.getRupiah(res.data.data.saldo);
          this.checkAlreadyBuy();
        });
    },
    async beli() {
      $("#beliInformationModal").modal();

      this.keteranganPembelian = "Memproses...";

      if (
        parseInt(TextTools.cleanRupiah(this.penggunaSaldo)) >=
        parseInt(
          TextTools.cleanRupiah(this.harga == "GRATIS" ? "0" : this.harga)
        )
      ) {
        const body = {
          saldo: TextTools.cleanRupiah(this.harga)
        };
        await axios.put(
          Const.API_BASE_URL + "pengguna/" + this.penggunaId + "/saldo/min",
          body
        );

        const body2 = {
          kelas_id: this.kelasId,
          pengguna_id: this.penggunaId
        };
        await axios.post(Const.API_BASE_URL + "kelas_anggota", body2);

        const saldoToPenjualKotor = parseInt(TextTools.cleanRupiah(this.harga));
        const saldoToAdmin = (Const.BIAYA_ADMIN / 100) * saldoToPenjualKotor;
        const saldoToPenjualBersih = saldoToPenjualKotor - saldoToAdmin;

        const body3 = {
          saldo: saldoToPenjualBersih
        };
        await axios.put(
          Const.API_BASE_URL + "pengguna/" + this.owner.id + "/saldo/add",
          body3
        );

        const body4 = {
          saldo: saldoToAdmin
        };
        await axios.put(Const.API_BASE_URL + "perusahaan/saldo/add", body4);

        this.keteranganPembelian = "Pembelian berhasil, Terima kasih.";
      } else {
        this.keteranganPembelian =
          "Pembelian gagal, saldo tidak mencukupi. Silahkan topup saldo anda.";
      }
    },
    reloadPage() {
      this.$router.go(0);
    },
    bergabung(){
      $("#beliConfirmationModal").modal("toggle");
      this.$router.push("/bergabung");
    }
  }
};
</script>
