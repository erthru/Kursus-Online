export default {
    getRupiah(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    cleanRupiah(x){
        return x.toString().replace(/,/g,"").replace(" ","").replace("Rp.", "");
    }
}