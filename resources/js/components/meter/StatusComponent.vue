<template>
    <div>
        <mdb-alert :color="alertColor"> {{message}} </mdb-alert>
    </div>
</template>

<script>
import { mdbAlert } from "mdbvue";
export default {
    components: {
        mdbAlert
    },

    computed: {
        alertColor() {
            let reason = this.$store.state.meter.shutdown_reason;
            if(reason==1 || reason == 5) {
                return "danger";
            } else if (reason==2 || reason == 3 || reason == 4) {
                return "warning";
            } else {
                return "success";
            }                
        },

        message() {
            let reason = this.$store.state.meter.shutdown_reason;
            if(reason == 1) {
                return "Meter shutdown. METER TAMPERED. Contact base station to turn on your meter";
            } else if (reason == 2) {
                return "Meter shutdown. Unit exhuasted. Kindly recharge meter";
            }else if (reason == 3) {
                return "Current phase down. Kindly use App to change phase";
            } else if (reason == 4) {
                return "Meter shutdown due to OVERLOAD. Kindly reduce load to turn on meter";
            } else if (reason == 5) {
                return "Meter Shutdown by ADMIN";
            } 
             else {
                return "Meter is working";        
            }
        }
    }
}
</script>

<style>

</style>
