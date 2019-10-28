<template>
  <div>
    <div class="container">
      <br />
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("App Mounted");
  }
};
</script>