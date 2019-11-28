<template></template>

<script>
import Const from "../../helper/Const";
export default {
  mounted() {
    if (localStorage.getItem(Const.ADMIN_ID) == null) {
      this.$router.push("/admin/login");
    }
  }
};
</script>