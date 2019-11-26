export default {
    getRupiah(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    cleanRupiah(x){
        return x.replace(/,/g,"").replace(" ","").replace("Rp.", "");
    }
}