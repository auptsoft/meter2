<template>
    <div>
        <mdb-btn color="primary" @click.native="showModal = true">Consumption History</mdb-btn>
      <mdb-modal :show="showModal" @close="showModal = false" scrollable>
        <mdb-modal-header>
          <mdb-modal-title>Power Consumption</mdb-modal-title>
        </mdb-modal-header>
        <mdb-modal-body >
           <mdb-datatable
            :data="models"
            stripped
            bordered
            materialInputs
            responsive > 
           </mdb-datatable>
        </mdb-modal-body>
        <mdb-modal-footer>
          <mdb-btn color="secondary" size="sm" @click.native="showModal = false">Close</mdb-btn>
        </mdb-modal-footer>
      </mdb-modal>
    </div>
</template>

<script>
import {mdbBtn, mdbModal, mdbModalTitle, mdbModalHeader, mdbModalBody, mdbModalFooter } from "mdbvue";
import { mdbDatatable, mdbIcon, mdbRow, mdbContainer } from 'mdbvue';

export default {

    computed: {
      models() {
        return{
        columns: [
          {
            label: "Date/Time",
            field: "created_at"
          },
          {
            label: "Voltage",
            field: "voltage"
          },
          {
            label: "Current",
            field: "current"
          },
          /*{
            label: "Power Factor",
            field: "power_factor"
          },
          {
            label: "Frequency",
            field: "frequency"
          }, */
          {
            label: "Power Consumed",
            field: "power_consumed"
          }
        ],

        rows: this.$store.state.allPowerConsumption
      }
    }
    },
    mounted() {
      setInterval(this.getUpdate, 5000);
    },
    methods: {
      getUpdate() {
         console.log("hello");
         this.$store.commit("updateAllPowerConsumption");
      }
    },
    data() {
        return {
            showModal: false
        }
    },
    
    components: {
        mdbBtn,

        mdbModal,
        mdbModalTitle,
        mdbModalHeader, 
        mdbModalBody,
        mdbModalFooter,

        mdbDatatable,
        mdbContainer,
        mdbRow,
        mdbIcon
    }
}
</script>

<style lang="scss" scoped>

</style>
