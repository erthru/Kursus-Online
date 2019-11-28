<template>
  <div>
    <vue-headful :title="title" />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form v-on:submit.prevent="login()">
            <div class="form-group">
              Email
              <input
                type="email"
                class="form-control"
                v-model="txEmailVal"
                placeholder="example@mail.com"
                required
              />
            </div>
            <div class="form-group">
              Password
              <input
                type="password"
                class="form-control"
                v-model="txPasswordVal"
                placeholder="Input password"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <div class="alert alert-danger" v-if="loginIsFail">Login gagal, Email atau Password salah.</div>
        </div>
      </div>
    </div>
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
      title: Const.TITLE + "Login Admin",
      loginIsFail: false,

      // form login
      txEmailVal: "",
      txPasswordVal: "",
      btnLoginIsDisabled: false
    };
  },
  mounted() {
    if (localStorage.getItem(Const.ADMIN_ID) != null) {
      this.$router.push("/admin");
    }
  },
  methods: {
    login() {
      this.loginIsFail = false;
      this.btnLoginIsDisabled = true;

      const body = {
        email: this.txEmailVal,
        password: this.txPasswordVal
      };

      axios.post(Const.API_BASE_URL + "admin/login", body).then(res => {
        if (res.data.data != null) {
          localStorage.setItem(Const.ADMIN_ID, res.data.data.id);
          this.$router.go(0);
        } else {
          this.loginIsFail = true;
          this.btnLoginIsDisabled = false;
        }
      });
    }
  }
};
</script>