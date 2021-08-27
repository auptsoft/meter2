import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

let state = {
    powerConsumption: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    powerConsumptionTime: ["1", "2", "3", "4", "5", "6", "8", "9", "10"],
    currentPowerConsumption: 0,

    allPowerConsumption: [],

    meter: { power: {}}
}

let mutations = {
    setPowerConsumption(state, powerConsumption) {
        state.powerConsumption = powerConsumption;
    },

    setPowerConsumptionTime(state, powerConsumptionTime) {
        state.powerConsumptionTime = powerConsumptionTime
    }, 

    updatePowerConsumption(state, currentPowerValue) {
        let d = new Date();
        let hour = d.getHours();
        let min = d.getMinutes();

        state.powerConsumption.push(currentPowerValue);
        state.powerConsumptionTime.push(hour+":"+min);
        
        state.powerConsumption.shift();
        state.powerConsumptionTime.shift();
    }, 

    updateCurrentPowerConsumption(state, currentPowerValue) {
        state.currentPowerConsumption = currentPowerValue;
    },

    updateAllPowerConsumption(state) {
        axios.get('/meter/public/api/meter/powerConsumption/'+window.meter_id).then((response)=>{
            let data = response.data;
            state.allPowerConsumption = data.reverse();
            //console.log(data);
        });
    },

    updateMeter(state, meter) {
        state.meter = meter;
    }
}

export default new Vuex.Store({
    state: state,
    mutations: mutations
})