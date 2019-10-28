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
      title: Const.TITLE + "Selamat Datang"
    };
  }
};
</script>