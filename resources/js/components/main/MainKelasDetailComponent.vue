<template>
  <div>
    <vue-headful :title="title" />
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
      title: Const.TITLE,
      pageMateri: 0,
      pageAnggota: 0,
      owner: {},
      materis: [],
      anggotas: []
    };
  },
  mounted() {
    this.loadKelasDetail();
    this.loadKelasMateri("next");
  },
  methods: {
    loadKelasDetail() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.title += res.data.data.nama;
          this.owner = res.data.data.pengguna;
        });
    },
    loadKelasMateri(mod) {
      if (mod == "next") {
        this.pageMateri += 1;
      } else {
        this.pageMateri -= 1;
      }

      axios
        .get(
          Const.API_BASE_URL +
            "kelas/" +
            this.$route.params.id +
            "?page=" +
            this.pageMateri
        )
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
    }
  }
};
</script>