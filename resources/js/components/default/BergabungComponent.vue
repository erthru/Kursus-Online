<template>
  <div>
    <vue-headful :title="title" />
    <div class="row">
      <div class="col-md-4">
        <h4>DAFTAR</h4>
        <small>Bergabung dengan kami.</small>
        <br />
        <br />
        <form @submit.prevent="register()">
          <div class="form-group">
            <label>Nama Depan</label>
            <input
              type="text"
              class="form-control"
              placeholder="Input Nama Deapn"
              v-model="txNamaDepanRegisterVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Nama Belakang</label>
            <input
              type="text"
              class="form-control"
              placeholder="Input Nama Belakang"
              v-model="txNamaBelakangRegisterVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Telp</label>
            <input
              type="number"
              class="form-control"
              placeholder="Input No. Hp"
              v-model="txTelpRegisterVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input
              type="email"
              class="form-control"
              placeholder="Someone@example.com"
              v-model="txEmailRegisterVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="txPasswordRegisterVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Konfirmasi Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="txPasswordReRegisterVal"
              required
            />
          </div>
          <button
            type="submit"
            class="btn btn-primary"
            v-bind:disabled="btnDaftarRegisterIsDisabled"
          >DAFTAR</button>
        </form>
        <div
          class="alert alert-danger"
          v-bind:hidden="errorMessageRegisterIsHidden"
        >{{ errorMessage }}</div>
      </div>
      <div class="col-md-4">
        <h4>LOGIN</h4>
        <small>Login jika telah memiliki akun</small>
        <br />
        <br />
        <form @submit.prevent="login()">
          <div class="form-group">
            <label>Email</label>
            <input
              type="email"
              class="form-control"
              placeholder="someone@example.com"
              v-model="txEmailLoginVal"
              required
            />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input
              type="password"
              class="form-control"
              v-model="txPasswordLoginVal"
              placeholder="password"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary" v-bind:disabled="btnLoginIsDisabled">LOGIN</button>
        </form>
        <div class="alert alert-danger" v-bind:hidden="errorMessageLoginIsHidden">{{ errorMessage }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import VueHeadful from "vue-headful";
import Const from "../../helper/Const";
export default {
  components: {
    VueHeadful
  },
  mounted() {
    if (localStorage.getItem(Const.PENGAJAR_ID) != null) {
      this.$router.push("/");
    }
  },
  data() {
    return {
      title: Const.TITLE + "Bergabung",
      errorMessage: "",

      // register element
      txNamaDepanRegisterVal: "",
      txNamaBelakangRegisterVal: "",
      txTelpRegisterVal: "",
      txEmailRegisterVal: "",
      txPasswordRegisterVal: "",
      txPasswordReRegisterVal: "",
      btnDaftarRegisterIsDisabled: false,
      errorMessageRegisterIsHidden: true,

      // login element
      txEmailLoginVal: "",
      txPasswordLoginVal: "",
      btnLoginIsDisabled: false,
      errorMessageLoginIsHidden: true
    };
  },
  methods: {
    login() {
      this.errorMessageLoginIsHidden = true;
      this.btnLoginIsDisabled = true;

      let params = {
        email: this.txEmailLoginVal,
        password: this.txPasswordLoginVal
      };

      axios.post(Const.API_BASE_URL + "pengguna/login", params).then(res => {
        if (res.data.data != null) {
          localStorage.setItem(Const.PENGGUNA_ID, res.data.data.id);
          this.$router.push("/");
        } else {
          this.errorMessage =
            "Login gagal, email / password salah. Periksa kembali";
          this.errorMessageLoginIsHidden = false;
          this.btnLoginIsDisabled = false;
        }
      });
    },
    register() {
      this.errorMessageRegisterIsHidden = true;
      this.btnDaftarRegisterIsDisabled = true;

      if (this.txPasswordRegisterVal != this.txPasswordReRegisterVal) {
        this.errorMessage = "Password tidak sama, periksa kembali.";
        this.errorMessageRegisterIsHidden = false;
        this.btnDaftarRegisterIsDisabled = false;
      } else {
        let params = {
          nama_depan: this.txNamaDepanRegisterVal,
          nama_belakang: this.txNamaBelakangRegisterVal,
          telp: this.txTelpRegisterVal,
          email: this.txEmailRegisterVal,
          password: this.txPasswordRegisterVal
        };

        axios
          .post(Const.API_BASE_URL + "pengguna", params)
          .then(res => {
            localStorage.setItem(Const.PENGGUNA_ID, res.data.data.id);
            this.$router.push("/");
          })
          .catch(err => {
            if (err.response.data.message.includes("Duplicate entry")) {
              this.errorMessage = "No. telp atau email telah terdaftar.";
              this.errorMessageRegisterIsHidden = false;
            } else {
              this.errorMessage = "Terjadi kesalahan, coba lagi.";
              this.errorMessageRegisterIsHidden = false;
            }

            this.btnDaftarRegisterIsDisabled = false;
          });
      }
    }
  }
};
</script>