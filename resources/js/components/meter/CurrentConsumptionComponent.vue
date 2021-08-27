<template>
    <div>
        <mdb-line-chart :data="chartData.lineChartData" :options="lineChartOptions"> </mdb-line-chart>
        <mdb-card> 
            <mdb-card-header> 

            </mdb-card-header>
            <mdb-card-body>
              <span> Power Consumption: </span>
              <span>{{currentPowerConsumption}} </span>
              <hr />
               <span> Current: </span>
              <span>{{meter.current}} </span>
              <hr />
               <span> Voltage: </span>
              <span>{{meter.power.voltage}} </span>
              <hr />
               <!-- <span> Frequency: </span>
              <span>{{meter.power.frequency}} </span>
              <hr />
              <span> Power Factor: </span>
              <span>{{meter.power_factor}} </span>
              <hr /> -->
              <span> Available Unit: </span>
              <span>{{meter.available_units}} </span>
            </mdb-card-body>
        </mdb-card>
    </div>
</template>

<script>
import { mdbLineChart, mdbCard, mdbCardHeader, mdbCardBody} from "mdbvue";
    export default {
        components: {
            mdbLineChart,
            mdbCard,
            mdbCardHeader,
            mdbCardBody
        }, 

        computed: {
            currentPowerConsumption() {
                return this.$store.state.currentPowerConsumption; //this.$store.state.powerConsumption[this.$store.state.powerConsumption.length-10]
            },
            meter() {
                return this.$store.state.meter;
            },
            chartData(){
                return {
                    interval: null,
                    lineChartData: {
                        labels:  this.$store.state.powerConsumptionTime,
                        datasets: [{
                            label: "Current consumption",
                            data: this.$store.state.powerConsumption,
                            backgroundColor: "#dee",
                            borderWidth: 0.7,
                            borderColor: "#ddd"
                        }]
                    }
                }
            }
        },

        data() {
            return {
                lineChartOptions: {
                    responsive: false,
                    maintainAspectRatio: false,
                    scales: {
                      xAxes: [{
                        gridLines: {
                          display: true,
                          color: "rgba(0, 0, 0, 0.1)",
                        }
                      }],
                      yAxes: [{
                        gridLines: {
                          display: true,
                          color: "rgba(0, 0, 0, 0.1)",
                        },
                        ticks: {
                            beginAtZero: true
                        }
                      }],
                    }
                  }
            }
        },

        mounted() {
            //axios.get
            
            // let powerConsumptionTime = ["1", "2", "3", "4", "5", "6", "8", "9", "10"];
            // let powerConsumption = [200, 200, 300, 350, 320, 400, 380, 360, 370, 330];

            // this.$store.commit("setPowerConsumption", powerConsumption);
            // this.$store.commit("setPowerConsumptionTime", powerConsumptionTime);
        },

        methods: {

        }
    }
</script>

<style lang="scss" scoped>

</style>