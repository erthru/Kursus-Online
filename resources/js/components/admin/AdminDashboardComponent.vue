<template>
  <div>
    <vue-headful :title="title" />
  </div>
</template>

<script>
import Const from "../../helper/Const";
import VueHeadful from "vue-headful";
export default {
  components: {
    VueHeadful
  },
  data() {
    return {
      title: Const.TITLE + "Admin Dashboard"
    };
  },
  mounted() {
    if (localStorage.getItem(Const.ADMIN_ID) == null) {
      this.$router.push("/admin/login");
    }
  }
};
</script>