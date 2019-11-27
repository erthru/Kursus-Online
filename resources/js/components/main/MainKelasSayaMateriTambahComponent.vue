<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4>Tambah Materi</h4>Pilih tipe materi:
          <br />
          <div class="btn-group mt-1" role="group">
            <button type="button" class="btn btn-warning" v-on:click="selected = 'MATERI'">Materi</button>
            <button type="button" class="btn btn-warning" v-on:click="selected = 'KUIS'">Kuis</button>
          </div>
          <br />
          <br />
          <div v-if="selected == 'MATERI'">
            <form v-on:submit.prevent="tambah()">
              <div class="form-group">
                Judul
                <input
                  type="text"
                  class="form-control"
                  placeholder="Contoh: Pengantar pemrograman"
                  v-model="txJudulVal"
                  required
                />
              </div>
              <div class="form-group">
                Konten
                <textarea
                  type="text"
                  class="form-control"
                  placeholder="Isi konten"
                  v-model="txKontenVal"
                  required
                />
              </div>
              <button
                type="submit"
                class="btn btn-primary"
                v-bind:disabled="btnTambahIsDisabled"
              >Tambah</button>
            </form>
          </div>
          <div v-if="selected == 'KUIS'">
            <form v-on:submit.prevent="tambah()">
              <div class="form-group">
                Pertanyaan
                <input
                  type="text"
                  class="form-control"
                  placeholder="Contoh: 1 + 1 ?"
                  v-model="txPertanyaanVal"
                  required
                />
              </div>
              <div class="form-group">
                Jawaban
                <textarea
                  type="text"
                  class="form-control"
                  placeholder="Isi Jawaban"
                  v-model="txJawabanVal"
                  required
                />
              </div>
              <button
                type="submit"
                class="btn btn-primary"
                v-bind:disabled="btnTambahIsDisabled"
              >Tambah</button>
            </form>
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
  data() {
    return {
      title: Const.TITLE + "Tambah Materi",
      selected: "",
      btnTambahIsDisabled: false,

      // form materi
      txJudulVal: "",
      txKontenVal: "",

      // form kuis
      txPertanyaanVal: "",
      txJawabanVal: ""
    };
  },
  methods: {
    async tambah() {
      this.btnTambahIsDisabled = true;

      const bodyMateri = {
        tipe: this.selected,
        kelas_id: this.$route.params.id
      };

      const materi = await axios.post(
        Const.API_BASE_URL + "materi",
        bodyMateri
      );

      if (this.selected == "MATERI") {
        const bodyMateriMateri = {
          judul: this.txJudulVal,
          konten: this.txKontenVal,
          materi_id: materi.data.data.id
        };

        axios
          .post(Const.API_BASE_URL + "materi_materi", bodyMateriMateri)
          .then(res => {
            this.$router.push("/kelas_saya/" + this.$route.params.id);
          });
      } else {
        const bodyMateriKuis = {
          pertanyaan: this.txPertanyaanVal,
          jawaban: this.txJawabanVal,
          materi_id: materi.data.data.id
        };

        axios
          .post(Const.API_BASE_URL + "materi_kuis", bodyMateriKuis)
          .then(res => {
            this.$router.push("/kelas_saya/" + this.$route.params.id);
          });
      }
    }
  }
};
</script>