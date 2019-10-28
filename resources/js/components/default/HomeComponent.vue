<template>
  <div>
    this is home
    <br />
    {{isLogged}}
    <br />
    <router-view></router-view>
  </div>
</template>

<script>
import VueHeadful from "vue-headful";
import Const from "../../helper/Const";
export default {
  mounted() {
    if (localStorage.getItem(Const.PENGGUNA_ID) != null) {
      this.isLogged = true;
    }
  },
  data() {
    return {
      isLogged: false
    };
  }
};
</script>