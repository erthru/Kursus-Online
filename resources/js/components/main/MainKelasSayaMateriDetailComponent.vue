<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4>Perbarui Materi</h4>
          <div v-if="selected == 'MATERI'">
            <form v-on:submit.prevent="update()">
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
                v-bind:disabled="btnPerbaruiIsDisabled"
              >Perbarui</button>
              <button
                type="button"
                class="btn btn-danger"
                v-bind:disabled="btnHapusIsDisabled"
                v-on:click="hapus()"
              >Hapus</button>
            </form>
          </div>
          <div v-if="selected == 'KUIS'">
            <form v-on:submit.prevent="update()">
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
                v-bind:disabled="btnPerbaruiIsDisabled"
              >Perbarui</button>
              <button
                type="button"
                class="btn btn-danger"
                v-bind:disabled="btnHapusIsDisabled"
                v-on:click="hapus()"
              >Hapus</button>
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
      title: Const.TITLE + "Detail Materi",
      selected: "",
      materiMateriId: "",
      materiKkuisId: "",

      // form materi
      txJudulVal: "",
      txKontenVal: "",

      // form kuis
      txPertanyaanVal: "",
      txJawabanVal: "",

      btnPerbaruiIsDisabled: false,
      btnHapusIsDisabled: false
    };
  },
  mounted() {
    this.loadDetail();
  },
  methods: {
    loadDetail() {
      axios
        .get(Const.API_BASE_URL + "materi/" + this.$route.params.materi_id)
        .then(res => {
          this.selected = res.data.data.tipe;

          if (this.selected == "MATERI") {
            this.txJudulVal = res.data.data.materi[0].judul;
            this.txKontenVal = res.data.data.materi[0].konten;

            this.materiMateriId = res.data.data.materi[0].id;
          } else {
            this.txPertanyaanVal = res.data.data.kuis[0].pertanyaan;
            this.txJawabanVal = res.data.data.kuis[0].jawaban;

            this.materiKkuisId = res.data.data.kuis[0].id;
          }
        });
    },
    update() {
      this.btnPerbaruiIsDisabled = true;

      if (this.selected == "MATERI") {
        const bodyMateri = {
          judul: this.txJudulVal,
          konten: this.txKontenVal,
          materi_id: this.$route.params.materi_id
        };

        axios
          .put(
            Const.API_BASE_URL + "materi_materi/" + this.materiMateriId,
            bodyMateri
          )
          .then(res => {
            this.$router.push("/kelas_saya/" + this.$route.params.kelas_id);
          });
      } else {
        const bodyKuis = {
          pertanyaan: this.txPertanyaanVal,
          jawaban: this.txJawabanVal,
          materi_id: this.$route.params.materi_id
        };

        axios
          .put(Const.API_BASE_URL + "materi_kuis/" + this.materiKkuisId, bodyKuis)
          .then(res => {
            this.$router.push("/kelas_saya/" + this.$route.params.kelas_id);
          });
      }
    },
    hapus() {
      this.btnHapusIsDisabled = true;

      axios.delete(Const.API_BASE_URL + "materi/" + this.$route.params.materi_id).then(res => {
        this.$router.push("/kelas_saya/" + this.$route.params.kelas_id);
      });
    }
  }
};
</script>