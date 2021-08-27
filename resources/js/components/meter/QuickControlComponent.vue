<template>
 <div>
    <div class="q-card">
        <!-- {{ redPhase }} -->
    </div>
    <div> 
        <!-- <mdb-btn color="danger" >Shutdown </mdb-btn> -->
    </div>
    <phase-state></phase-state>
 </div>
</template>

<script>
//import PhaseStateComponent from './PhaseStateComponent.vue';
import { mdbBtn } from "mdbvue";
export default {
    name: 'quick-control',
    data: function() {
        return {
            fraudState: 'hello',
            meterState: window.meterState,
            powerUpdateCounter: 0
        }
    },
    props: {
        
    },

    components: {
        //PhaseStateComponent
        mdbBtn
    },

    computed: {
        redPhase() {
            return window.meterState.redP;
        },
        
        bluePhase() {
            return window.meterState.yellow_phase_active;
        }
    },
     mounted() {
        this.getUpdate();
        setInterval(this.getUpdate, 5000);
    },
    methods: {
        getUpdate() {
            //alert('hello');
            axios.get('/meter/public/api/meter/'+window.meter_id).then((response)=>{
                let data = response.data;
                console.log(data);
                window.meterState.red_phase_active = data.red_phase_active;
                window.meterState.blue_phase_active = data.blue_phase_active;
                window.meterState.yellow_phase_active = data.yellow_phase_active;
                window.meterState.is_shutdown = data.is_shutdown;
                window.meterState.fraud_detected = data.fraud_detected;
                window.meterState.powerConsumed = data.power_consumed;
                //window.meterState = data; //JSON.parse(data);

                this.$store.commit("updateCurrentPowerConsumption", data.power_consumed);
                if (this.powerUpdateCounter == 0) {
                    this.$store.commit("updatePowerConsumption", data.power_consumed);
                    this.powerUpdateCounter = 2
                }
                this.powerUpdateCounter--;

                this.$store.commit("updateMeter", data);
            });
        }
    }
}
</script>

<style>

</style>
