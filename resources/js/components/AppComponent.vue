<template>
  <div class="bg-white">
    <router-view></router-view>
  </div>
</template>

<script>
import Const from "../helper/Const";
export default {
  mounted() {
    console.log("App Mounted");
    console.log("Current Route: " + Const.ROUTE_ROOT_URL);
  }
};
</script>