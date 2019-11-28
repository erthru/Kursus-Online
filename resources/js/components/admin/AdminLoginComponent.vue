<template></template>

<script>
export default {
  mounted() {
    if (localStorage.getItem(Const.ADMIN_ID) != null) {
      this.$router.push("/admin");
    }
  }
};
</script>