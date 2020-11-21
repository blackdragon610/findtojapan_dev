<template></template>

<script lang="ts">
import { Component, Vue, Prop } from 'vue-property-decorator'

@Component
export default class GoogleMapMarker extends Vue {
  @Prop() private google!: any
  @Prop() private map!: any
  @Prop() public info!: any
  @Prop() private position!: { lat: number; lng: number }
  @Prop() private title!: string

    public isClick:boolean = false
  marker: any
  infoWindow: any



  mounted() {
    const { Marker } = this.google.maps
    this.marker = new Marker({
      position: this.position,
      map: this.map
    })

    this.info.Marker = this

    let self = this

    this.infoWindow = new this.google.maps.InfoWindow({
      content: `<div>${this.info.body}<div>` + '<br /><button class="btnpink" id="detail_' + this.info.id  +'" @click="onDetail">詳細</button>'
    })




      if (!self.isClick){
        this.google.maps.event.addListener(this.marker, 'click', () => {
            this.infoWindow.open(this.map, this.marker)

            if (!self.isClick) {

                //詳細選択
                this.infoWindow.addListener('domready', () => {
                    if (!self.isClick) {
                        (document as any).getElementById("detail_" + self.info.id).addEventListener('click', self.detail.bind(this))
                    }
                    self.isClick = true
                })
            }
        })
      }
  }

    /**
     * 詳細の選択
     */
    public detail()
    {
        this.$router.push({name:"post_detail", query:{target:this.info.id}})

    }


    /**
    * ピンの削除
    */
    public delete()
    {
      this.marker.setMap(null)

    }

}
</script>
