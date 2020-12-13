<template>
  <div class="w-full h-full">
    <div v-if="route=='Form1' || route=='Form2'" class="sm:flex mb-2">
        <gmap-autocomplete
            class="sm:mb-0 mb-2 mr-2 w-1/2 form-input transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            placeholder="Introduce una ubicación aproximada"
            @place_changed="setPlace">
        </gmap-autocomplete>
     
        <button 
        class="py-2 px-2 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
        @click.prevent="addMarker2">Ubica un lugar cercano a tu casa</button>
    </div>

    <small v-if="error" class="text-blue-600">{{
      error
    }}</small>
    <!--Sección del mapa de google maps-->
    <gmap-map
      :center="center"
      :zoom="zoom"
      style="width: 100%; height: 100%"
      :options="options"
    >
      <gmap-marker v-for="marker in markers"
        :key="marker.index"
        :position="marker.position"
      >
      </gmap-marker>

      <div>
        <GmapCircle v-for="(marker, index) in markers"
          :key="index"
          :center="marker.position"
          :radius="radius"
          :options="{fillColor:'#3ba5af',
                      fillOpacity:0.35, 
                      strokeColor:'#3ba5af', 
                      strokeOpacity:0.8,
                      strokeWeight: 2
                    }"
        ></GmapCircle>
      </div>
    </gmap-map>   
    <!--Fin de la sección-->
  </div>
</template>

<script>
export default {
  name: "GoogleMap",
  props: {
    route: String,
    lati: Number,
    longi: Number,
  },
  watch: {
    lati: function(newVal, oldVal){ 
      this.lati = newVal;
    },
    longi: function(newVal, oldVal){
      this.center.lat = this.lati;
      this.center.lng = newVal;

      this.addMarker(this.lati, newVal);
    },
    route: function(newVal, oldVal){
      if(newVal == 'Form1'){
        this.zoom = 13.4;
        this.radius = 2500;
      }
      else if(this.route == 'Form3'){
        this.zoom = 15;
        this.radius = 500;
        this.options.streetViewControl = true;
      }
    }
  },
  data: ()=>{
    return {
      center: { 
        lat: 0, 
        lng: 0 
      },
      
      markers: [],
      zoom: 0,
      radius:4000,
      currentPlace: null,
      error: '',

      options: {
        zoomControl: true, // Establece el control de zoom del mapa
        mapTypeControl: false, // Oculta el control de tipos de mapas
        scaleControl: false, //  Oculta el control de escala del mapa
        streetViewControl: false, // Oculta el control de StreeView del mapa
        fullscreenControl: true // Establce el control full screen para ver el mapa a pantalla completa
      },
    }
  },
  created(){
    //Compruebo de que ruta traje mi mapa de google maps
    if(this.route == 'customer1'){
      this.zoom = 12;
    }
  },
  methods:{
    //Se añade marcador central
    async addMarker(lat, lng){
      const marker = {
          lat: lat,
          lng: lng
      };

      this.markers.push({ position: marker });
    }, 
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker2() {
      this.markers.pop();

      if (this.currentPlace) {
        this.error = '';

        //Evento que hara capturar la longitud y latitud
        this.$emit('getCoordinates', {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        })

        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({ position: marker });
        this.center = marker;
        this.currentPlace = null;
        this.zoom = 16;
        this.radius = 300;
        this.options.streetViewControl = true;
      }
      else{
        this.error = 'Ubicación no encontrada por nuestros geolocalizadores';

        //Evento que hara capturar la longitud y latitud
        this.$emit('getCoordinates', {
          lat: null,
          lng: null
        })
      };
    },
  }
}
</script>