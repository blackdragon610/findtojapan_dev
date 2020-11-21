<template>
  <div :style="`height:100%`">

    <div id="googleMap" :style="`height:100%`"></div>


    <template v-if="google && map">
      <slot :google="google" :map="map" />
    </template>

      <GoogleMapMarker
          v-for="(marker, i) in datas"
          :key="i"
          :position="marker"
          :google="google"
          :map="map"
          :info="marker"
      />



  </div>
</template>

<script lang="ts">
    import {Component, Vue, Prop, Watch} from 'vue-property-decorator'
    import PostClass from "../../../http/PostClass";
    import GoogleMapMarker from "./GoogleMapMarker.vue";
    import UserClass from "../../../http/UserClass";


interface GoogleMapWindow extends Window {
  handleLoadGoogleMapsScript: Function
  google: any
}

declare const window: GoogleMapWindow

class Latlng{
    public lat:number=0
    public lng:number=0
}

@Component({
    components: {
        GoogleMapMarker
    }
})


export default class GoogleMap extends Vue {
    @Prop() private zoom!: number
    @Prop() private center!: { lat: number; lng: number }
    @Prop({ default: '240px' }) private height!: string

    public latlng:Latlng = new Latlng()
    public datas:any = {}
    public PostClass = new PostClass()

    public topRight:Latlng = new Latlng()
    public bottomLeft:Latlng = new Latlng()
    public keyword:string = ""

    google: any = null
    map: any = null

    key:string = ""

    constructor()
    {
        super();
        this.key = window.configs["key"].apiKey
    }
  mounted() {
    this.loadGoogleMapsScript().then(google => {
      this.google = google
      this.initializeMap()
    })
  }

  loadGoogleMapsScript() {
    return new Promise((resolve, reject) => {
      if (window.google) {
        return resolve(window.google)
      }
      const script = document.createElement('script')

      let $UserClass = new UserClass()

      script.src = "https://maps.googleapis.com/maps/api/js?key=" + this.key + "&language=" + $UserClass.user.language + "&libraries=geometry,drawing,places&callback=handleLoadGoogleMapsScript"
      const head = document.querySelector('head')
      if (!head) return reject(new Error('head node is undefined'))
      head.appendChild(script)

      window.handleLoadGoogleMapsScript = () => {
        resolve(window.google)
      }
      setTimeout(() => {
        if (!window.google) {
          reject(new Error('failed load google api'))
        }
      }, 5000)
    })
  }

  initializeMap() {
    const mapContainer = this.$el.querySelector('#googleMap')
    const { Map, MapTypeId } = this.google.maps


    this.map = new Map(mapContainer, {
        zoom: this.zoom,
        center: this.center,
        mapTypeId: MapTypeId.ROADMAP,
        mapTypeControl:false,
        zoomControl:false,
        fullscreenControl:false,
        rotateControl:false,
        scaleControl:false,
        streetViewControl: false,
        //scrollwheel: false
    })

      this.getCurrent()

      // @ts-ignore
      //google.maps.event.addListener(this.map, "bounds_changed", this.dragLatlng)
      google.maps.event.addListener(this.map, "dragend", this.dragLatlng)
  }

    @Watch('latlng', {deep:true})
    onLngChanged(newText: string, oldText: string) {this.changeLatlng()}
    @Watch('keyword')
    onKeywordChanged(newText: string, oldText: string) {
        this.PostClass.isLoading = true

        for (let key in this.datas){
            this.datas[key].Marker.delete()
            delete this.datas[key]
        }

        this.changeLatlng()
    }



    /**
     *  中心が変更された場合の処理
     **/
    public changeLatlng()
    {
        this.setCenter()

        let bounds:any = this.map.getBounds()
        this.topRight.lat = bounds.getNorthEast().lat()
        this.topRight.lng = bounds.getNorthEast().lng()
        this.bottomLeft.lat = bounds.getSouthWest().lat()
        this.bottomLeft.lng = bounds.getSouthWest().lng()

        var datas:any = {
            topRightLat:this.topRight.lat,
            topRightLng:this.topRight.lng,
            bottomLeftLat:this.bottomLeft.lat,
            bottomLeftLng:this.bottomLeft.lng
        }
        datas.keyword = this.keyword

        let self = this

        //マップ関連
        this.PostClass.getMap(datas,function(result:any){

            if (!self.datas.length){
                self.datas = JSON.parse(JSON.stringify({}))
            }

            for (let key in result.datas){
                let keyNumber:string = result.datas[key].id

                if (!self.datas[keyNumber]){
                    self.datas[keyNumber] = result.datas[key]
                }
            }


        })
        this.PostClass.isLoading = false


    }

    /**
     * 地図の真ん中の変更
     * @param lat
     * @param lng
     */
    public setCenter()
    {
      this.map.setCenter({lat:this.latlng.lat,lng:this.latlng.lng})
    }

    /**
     *  ドラッグで地図の変更
     **/
    public dragLatlng()
    {
        let center:any = this.map.getCenter()
        this.latlng.lat = center.lat()
        this.latlng.lng = center.lng()
    }

    /**
     * 現在位置の取得
     */
    public getCurrent()
    {
        let self = this
        navigator.geolocation.getCurrentPosition(
            this.loadCurrent.bind(this),
            function(error){
                self.latlng.lat = 35.681236
                self.latlng.lng = 139.767125
            }
        )
    }

    public loadCurrent(position:any)
    {
        this.latlng.lat = position.coords.latitude
        this.latlng.lng = position.coords.longitude
    }
}
</script>
