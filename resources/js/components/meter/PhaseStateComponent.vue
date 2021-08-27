<template>
    <div>
        <div class="item" > 
                <div v-if="redPhaseState==2" class="item-image" style="background-image:url('../storage/bad sign.jpg')"  > </div>
                <div v-if="redPhaseState==1" class="item-image" style="background-image:url('../storage/good sign.jpg')" > 
      	            <!-- <img src="{{ asset('') }}"/> -->
	            </div>
     	        <div>
	                <h2  class="item-title red-title" > RED PHASE </h2>
	                <p v-if="redPhaseState==2" class="item-text error-text " > This phase is down </p>
                    <p v-if="redPhaseState==1" class="item-text normal-text" > This phase is active </p>
	            </div>
        </div>
        
         <div class="item" > 
                <div v-if="yellowPhaseState==2" class="item-image" style="background-image:url('../storage/bad sign.jpg')"  > </div>
                <div v-if="yellowPhaseState==1" class="item-image" style="background-image:url('../storage/good sign.jpg')" > 
      	            <!-- <img src="{{ asset('') }}"/> -->
	            </div>
     	        <div>
	                <h2  class="item-title yellow-title" > YELLOW PHASE </h2>
	                <p v-if="yellowPhaseState==2" class="item-text error-text " > This phase is down </p>
                    <p v-if="yellowPhaseState==1" class="item-text normal-text" > This phase is active </p>
	            </div>
        </div>
         <div class="item" > 
                <div v-if="bluePhaseState==2" class="item-image" style="background-image:url('../storage/bad sign.jpg')"  > </div>
                <div v-if="bluePhaseState==1" class="item-image" style="background-image:url('../storage/good sign.jpg')" > 
      	            <!-- <img src="{{ asset('') }}"/> -->
	            </div>
     	        <div>
	                <h2  class="item-title blue-title" > BLUE PHASE </h2>
	                <p v-if="bluePhaseState==2" class="item-text error-text " > This phase is down </p>
                    <p v-if="bluePhaseState==1" class="item-text normal-text" > This phase is active </p>
	            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'phase-state',
    computed: {
        redPhaseState() {
            return window.meterState.red_phase_active;
        },
        bluePhaseState() {
            return window.meterState.blue_phase_active;
        },
        yellowPhaseState() {
            //window.meterState.yellow_phase_active=1;
            return window.meterState.yellow_phase_active;
        }
    }
}
</script>

<style>
  .item {
	    margin:20px 20px;
	    border-style: none;
	    /* background-color: #eee; */
	    float:left;
	    border-radius: 10px;
        /* box-shadow: 2px 2px 5px gray; */
        padding: 1em;
        transition: all 0.5s;
        flex-grow: 1;
        flex-basis: 1;
        display: flex;
        align-items: center;
        justify-content: center;
     }

     .item:hover {
        box-shadow: 2px 2px 5px gray;
	    /* background-color: #ccc; */
     }

     .item-image {
        width: 100px;
        height: 100px;
        float:left;
        background-repeat: no-repeat;
        background-size: contain;
       
     }
     .item-title {
	    font-size: 20px;
     }

     .item:hover .item-text {
         display: block;
         max-width: 200px;
         transition: max-width 1s;
     }

     .item-text {
         position: relative;
         display: none;
         max-width: 0px;
     }

     .red-title {
	    text-align: center;
        color: #800;
     }

     .blue-title {
	    text-align: center;
	    color: #008;
     }

     .yellow-title {
	    text-align: center;
	    color: #bb0;
     }
     
     .error-text {
	    color: red;
	    margin-left: 20px;
	    text-align:center;
     }

     .normal-text {
	    color: #090;
	    margin-left: 20px;
	    text-align:center;
     }

     .item-fraud {
	    width:30%;
	    animation: anim 1s infinite alternate;
     }

     @keyframes anim {
	    0% { opacity: 0 }
	    100% { opacity: 1 }
     }

</style>
