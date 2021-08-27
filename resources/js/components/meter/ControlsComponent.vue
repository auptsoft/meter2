<template>
    <div class="parent"> 
        <mdb-card>
          <mdb-card-body>
            <mdb-card-title>Controls</mdb-card-title>
            <div v-if="isLoading==false">
             <mdb-btn v-if="isShutdown==1" @click="shutdown()" color="danger" size="sm">Shutdown</mdb-btn>
             <mdb-btn v-if="isShutdown==2" @click="start()" color="success" size="sm">Turn on</mdb-btn>
            </div>
            <mdb-alert v-if="isLoading==true" color="primary"> loading... </mdb-alert>
            <mdb-btn v-if="fraudDetected==2" color="danger"> Meter Tampared </mdb-btn>
          </mdb-card-body>
        </mdb-card>
    </div>
</template>

<script>
import {mdbAlert, mdbCard, mdbCardImage, mdbCardHeader, mdbCardBody, mdbCardTitle, mdbCardText, mdbBtn  } from "mdbvue"


export default {
    computed: {
      isShutdown() {
        return window.meterState.is_shutdown;
      }, 
      fraudDetected() {
        return window.meterState.fraud_detected;
      }
    },

    data() {
      return {
        isLoading: false
      }
    },
     methods: {
      shutdown() {
        //alert("shutdown");
        this.isLoading = true;
        axios.get("/meter/public/api/meter/"+window.meter_id+"/shutdown")
        .then((response)=> {
          let data = response.data;
          console.log(data);
          if (data.message && data.message=="success") {
            window.meterState.is_shutdown = true;
          }
          this.isLoading = false;
        });
      },
      start() {
        this.isLoading = true;
        axios.get("/meter/public/api/meter/"+window.meter_id+"/start")
        .then((response)=> {
          let data = response.data;
          console.log(data);
          this.isLoading = false;
        });
      }
    },
    components: {
        mdbAlert,

        mdbCard,
        mdbCardImage,
        mdbCardHeader,
        mdbCardBody,
        mdbCardTitle,
        mdbCardText,
        mdbBtn
    }
}
</script>

<style lang="scss" scoped>
  .parent {
    margin-bottom: 2em;
  }
</style>

