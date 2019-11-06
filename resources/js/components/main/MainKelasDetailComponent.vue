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
      title: Const.TITLE
    };
  },
  mounted() {
    this.loadKelasDetail();
  },
  methods: {
    loadKelasDetail() {
      axios
        .get(Const.API_BASE_URL + "kelas/" + this.$route.params.id)
        .then(res => {
          this.title += res.data.data.nama;
        });
    }
  }
};
</script>