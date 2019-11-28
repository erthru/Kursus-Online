<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4>{{kelas.nama}}</h4>
          <h5 v-if="materi != undefined ">{{materi.judul}}</h5>
          <h5 v-if="kuis != undefined">Sesi Kuis</h5>
          <hr />
          <div v-if="materi != undefined ">
            <p>{{materi.konten}}</p>
          </div>
          <div v-if="kuis != undefined ">
            <h6>Pertanyaan</h6>
            {{kuis.pertanyaan}}
            <br />
            <br />
            <form v-on:submit.prevent="jawab()">
              <div class="form-group">
                <h6>Jawaban</h6>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Input jawaban dari pertanyaan"
                  v-model="txJawabanVal"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div v-if="isAnswer">
              <hr />
              <div class="alert alert-success" v-if="correctAnswer">Jawaban benar</div>
              <div class="alert alert-danger" v-if="!correctAnswer">Jawaban salah</div>
              <br />
              Kunci jawaban: {{kuis.jawaban}}
            </div>
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
      title: Const.TITLE + "Kelas Dibeli Lihat Materi",
      kelas: {},
      materi: {},
      kuis: {},

      // form kuis
      txJawabanVal: "",

      isAnswer: false,
      correctAnswer: false
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get(Const.API_BASE_URL + "materi/" + this.$route.params.materi_id)
        .then(res => {
          this.kelas = res.data.data.kelas;
          this.materi = res.data.data.materi[0];
          this.kuis = res.data.data.kuis[0];

          console.log(this.kuis);
        });
    },
    jawab() {
      this.isAnswer = true;

      if (this.kuis.jawaban == this.txJawabanVal) {
        this.correctAnswer = true;
      }
    }
  }
};
</script>