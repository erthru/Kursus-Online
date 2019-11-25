<template>
  <div class="bg-white">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("App Mounted");
  }
};
</script>