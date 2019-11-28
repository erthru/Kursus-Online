<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS1Nlfy8fzqVzcYr2k8euUk5wt071Qp5xGvkzUydVNj1ntgGdEs"
            width="100%"
            height="100px"
          />
        </div>
        <div class="col-md-10 mt-2">
          <h4>{{kelas.nama}}</h4>
          <small>oleh {{kelas.pengguna.nama_depan + ' ' + kelas.pengguna.nama_belakang}}</small>
        </div>
      </div>
      <br />
      <h5>Deskripsi</h5>
      {{kelas.deskripsi}}
      <br />
      <hr />
      <h5>Daftar Materi</h5>
      <small v-if="materis.length == 0">Kelas ini belum memiliki materi.</small>
      <div
        v-for="(materi, index) in materis"
        :key="materi.id"
      ><router-link class="text-primary" :to="'/kelas_dibeli/' + kelasId + '/materi/' + materi.id">{{(index += 1) + '. ' + (materi.tipe == 'KUIS' ? "Kuis" : materi.materi[0].judul)}}</router-link></div>
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
      title: Const.TITLE + "Kelas Yang Dibeli Detail",
      kelas: {},
      materis: [],
      anggotaIsExist: true,
      kelasId: this.$route.params.id
    };
  },
  mounted() {
    this.loadKelas();
  },
  methods: {
    loadKelas() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.kelas = res.data.data;
          this.materis = this.kelas.materi;

          var prepareAnggotaIsExist = true;

          if (this.kelas.kelas_anggota.length == 0) {
              prepareAnggotaIsExist = false;
          } else {
            for (var i = 0; i < this.kelas.kelas_anggota.length; i++) {
              if (
                this.kelas.kelas_anggota[i].pengguna_id !=
                localStorage.getItem(Const.PENGGUNA_ID)
              ) {
                prepareAnggotaIsExist = false;
              } else {
                prepareAnggotaIsExist = true;
              }
            }
          }

          this.anggotaIsExist = prepareAnggotaIsExist;
          
          if(!this.anggotaIsExist){
              this.$router.push("/");
          }
        });
    }
  }
};
</script>