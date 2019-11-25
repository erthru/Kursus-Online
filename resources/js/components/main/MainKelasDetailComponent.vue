<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h4>{{kelasTitle}}</h4>
          <p>{{deskripsi}}</p>
          <br />
          <h4>Daftar Materi:</h4>
          <small v-if="materis.length == 0">Kelas ini belum memiliki materi.</small>
          <div
            v-for="(materi, index) in materis"
            :key="materi.id"
          >{{ (index+=1) + '. ' + (materi.tipe == 'MATERI' ? materi.materi[0].judul : 'Kuis') }}</div>
        </div>
        <div class="col-md-4">
          <div class="pb-4 pt-4 pl-4 pr-4" style="background-color: #dcdde1">
            <img
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS1Nlfy8fzqVzcYr2k8euUk5wt071Qp5xGvkzUydVNj1ntgGdEs"
              width="100%"
              height="200px"
            />
            <h1 class="display-5 mt-3">
              <strong>{{harga}}</strong>
            </h1>
            <button
              class="btn btn-warning w-100 mt-1"
              data-toggle="modal"
              data-target="#beliConfirmationModal"
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
            <h5>Anda yakin untuk membeli kelas ini ?</h5>
            <br />Saldo anda saat ini:
            <div class="text-danger"><strong>Rp. {{ penggunaSaldo }}</strong></div>
            <br />(saldo akan langsung terpotong saat anda menekan tombol beli)
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Beli</button>
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
      deskripsi: "",
      harga: "Rp. 0",
      materis: [],
      anggotas: [],
      penggunaSaldo: "0"
    };
  },
  mounted() {
    this.loadKelasDetail();
    this.loadKelasMateri();
    this.loadPenggunaDetail();
  },
  methods: {
    loadKelasDetail() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.kelasTitle = res.data.data.nama;
          this.title += this.kelasTitle;
          this.owner = res.data.data.pengguna;
          this.deskripsi = res.data.data.deskripsi;
          this.harga = "Rp. " + TextTools.getRupiah(res.data.data.harga);

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
        .get(
          Const.API_BASE_URL +
            "pengguna/" +
            localStorage.getItem(Const.PENGGUNA_ID)
        )
        .then(res => {
          this.penggunaSaldo = TextTools.getRupiah(res.data.data.saldo);
        });
    }
  }
};
</script>