<template>
  <div style="margin-bottom: 2em">
     <!-- Status  {{status}} -->
      <!-- Red Line: {{status.red_status==1 ? "OK": "Broken"}} -->
     <div class="line-status">
         <span style="color:red"> Red Phase: {{status.red_status==1 ? "Active": "Broken"}} </span>
          <div v-if="status.red_status==1">
              <img class="active-line" src="/meter/public/images/active_line.png" />
          </div>
          <div v-if="status.red_status==0">
              <img class="broken-line" src="/meter/public/images/broken_line.png" />
          </div>
     </div>

     <div class="line-status">
         <span style="color:yellow"> Yellow Phase: {{status.yellow_status==1 ? "Active": "Broken"}}</span>
          <div v-if="status.yellow_status==1">
              <img class="active-line" src="/meter/public/images/active_line.png" />
          </div>
          <div v-if="status.yellow_status==0">
              <img class="broken-line" src="/meter/public/images/broken_line.png" />
          </div>
     </div>

      <div class="line-status">
         <span style="color:blue">Blue Phase: {{status.blue_status==1 ? "Active": "Broken"}} </span>
          <div v-if="status.blue_status==1">
              <img class="active-line" src="/meter/public/images/active_line.png" />
          </div>
          <div v-if="status.blue_status==0">
              <img class="broken-line" src="/meter/public/images/broken_line.png" />
          </div>
     </div>

     <div class="line-status">
         <span style="color:black">Neutral Phase: {{status.blue_status==1 ? "Active": "Broken"}} </span>
          <div v-if="status.neutral_status==1">
              <img class="active-line" src="/meter/public/images/active_line.png" />
          </div>
          <div v-if="status.neutral_status==0">
              <img class="broken-line" src="/meter/public/images/broken_line.png" />
          </div>
     </div>

     <!-- <div class="line-status"> Yellow Line: {{status.yellow_status==1 ? "OK": "Broken"}} </div>
     <div class="line-status"> Blue Line: {{status.blue_status==1 ? "OK": "Broken"}} </div> -->
  </div>
</template>

<script>
export default {
    data() {
        return {
            status: {},
        }
    },

    methods: {
        getStatus() {
           axios.get('/meter2/public/api/fault').then((response)=>{
                 let payload = response.data;
                 
                 if (payload.status == 'success') {
                     this.status = payload.data;
                 }
                 console.log(payload);
           }); 
        }
    },

    mounted() {
        setInterval(()=>{
            this.getStatus();
        }, 5000);
    }
}
</script>

<style>
.line-status {
    margin-left: 4em;
    margin-right: 4em;
    padding: 5px;
}

.active-line {
    width: 100%;
    height: 5px;
}

.broken-line {
    width: 100%;
    height: 20px;
}
</style>