<script>
import Const from "../../helper/Const";
export default {
    mounted(){
        localStorage.removeItem(Const.PENGGUNA_ID);
        this.$router.push("/");
    }
}
</script>