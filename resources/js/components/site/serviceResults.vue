<template>
    <div class="container bg-white" id="">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <h3 class="text-center font-weight-bold"><b class="h5 text-success"> </b> </h3>


        <div class="clear"></div>




        <div class="clear"></div>






        <div class="content_bottom">
            <div class="heading">
                <h3 class="my-5 text-center secondary_heading">Services</h3>
            </div>
            <div class="clear"></div>
        </div>





        <div class="row mt-4 row flex-column-reverse flex-md-row">

            <div class="col-md-6">
                <!-- Price Filter -->
                <div class="row">
                    <div class="col-sm-3"><span style="background:black;" class="btn text-light px-2 py-1 rounded">Filter by
                            Price:</span></div>
                    <div id="" class="col-sm-5  mt-1">
                        <div id="slider" class=""> </div>
                        <div class="row mt-3">
                            <div class="col-6  mt-1">
                                <span id="price_low" class="py-0 btn btn-light" name="min"> </span>
                            </div>
                            <div class="col-6 mt-1 pr-0">
                                <span id="price_high" class="float-right py-0 btn btn-light" name="min"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <!-- <a class="py-0 float-right border border-dark rounded" style="width:70px; height:40px;">
                            <div class="row">
                                <div class="col-6 pr-0">
                                    <p style="font-size:12px;" class="text-dark">More Filters</p>
                                </div>
                                <div class="col-6 px-1"> <img src="images/randomIcons/filter.jpg" width="20px;"
                                        style="margin-left:5px;">
                                </div>
                            </div>
                        </a>
 -->
                    </div>

                </div>
                <div class="row">
                    <p class="ml-1 my-0 text-secondary small">{{ count }} Services in found<!-- your location --></p>
                </div>
                <!-- Price Filter -->

                <div class="row" v-if="count != 0">
                    <div v-for="( result, index ) in results" class="listing col-md-6 my-3">
                        <router-link :to="`/serviceDetails/${result.id}`" class="shadow card border px-4">

                            <video v-if="result.file" controls style="width:100%; height:230px" alt="">
                                <source :src="result.file" type="video/mp4">
                            </video>

                            <img class="pt-2" v-else :src="result.image" style="width:100%; height:200px" alt="" />

                            <div class="p-1 pb-2">
                                <h5 class="card_heading mb-0 py-2">{{ result.name }} </h5>
                                <p class="my-1 text_color_p font-weight-bold"><i class="mr-2 fa fa-dollar"></i>{{
                                    result.price }}</p>

                                <p class="card_text pt-1 text-left"><i class="mr-2 fa fa-map-marker"></i>{{ result.location
                                }}</p>

                                <p><span class="mt-1 rounded small"><i class="mr-2 fa fa-category"></i>Category:
                                        {{ result.category }}</span></p>
                            </div>

                        </router-link>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="map_style m-auto">
                    <div id="googleMap" style="width:100%;height:95%;"></div>
                </div>
            </div>

        </div>


        <div class="row mt-4" v-if="this.ids == '0'">
            <h3 class="text-center font-weight-bold btn-light btn py-3 d-block">No Results Found! </h3>
        </div>


    </div>
</div></div></template>

<script>

export default {
    props: ['auth_user'],
    data: () => ({
        results: [],
        ids: '',
        empty: false,
        count: 0,
         loc:'',
        queryLat:'',
        queryLng:''
    }),
    methods: {
        setRes: function () {
            let t = this;
            this.ids = atob(this.$route.params.results);
            //this.results = this.ids.split(",");
            axios.get('ServiceResults/' + t.ids).then((data) => {            
                if(data.data.count != 0){
                t.count = data.data.count;
                t.results = data.data.data;
                //console.log(data);
                //Setting Curr LatLng
                t.queryLat = data.data.data[0].lat;
                t.queryLng = data.data.data[0].lng;
            }
            }).catch((error) => { console.log(error); })
        },


        range() {
            this.ids = atob(this.$route.params.results);
            let t = this;

            if(t.ids != 'no-results')
            {
            var slider = document.getElementById('slider');
            noUiSlider.create(slider, {
                start: [0, 500000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 500000
                },

                step: 10000,
                margin: 600,
                pips: {
                    //mode: 'steps',
                    stepped: true,
                    density: 6
                }
            });
            var skipValues = [
                document.getElementById('price_low'),
                document.getElementById('price_high')
            ];
            slider.noUiSlider.on('update', function (values, handle) {
                skipValues[handle].innerHTML = '$' + values[handle];
                //console.log(values[1] - values[0]);

                axios.get('priceFilterS/' + values[0] + '/' + values[1] + '/' + t.ids).then((data) => {
                    t.results = '';
                    t.results = data.data.data;
                    //Setting Curr LatLng
                    t.queryLat = data.data.data[0].lat;
                    t.queryLng = data.data.data[0].lng;

                    //console.log(data);
                }).catch((error) => { })

            });
        }

        },

        getPhoto() {

            return '../';

        },
        cart() {
            //axios.get('cart').then((data) => {
               // document.getElementById('cart').innerHTML = data.data.cart;});
        },

        replaceText() {
            $('#call_to').html('');
            $('#call_to').html('<a onclick="c_to_actionS();" data-target="#loginModal" data-toggle="modal" class="header_buttons text-light px-sm-3 my-1 px-1 py-1 mx-1 d-inline-block small text-center" ><span style="font-weight:bolder;" id="c_to_ac">Add Your Service</span></a> ');
        },

        //MAP -- MAP

        success(position){
        var loc = this.loc;
        if((loc == true || loc == "true") && this.count !=0){
            var myLat = sessionStorage.getItem('SqueryLat');// this.queryLat;
            var myLong = sessionStorage.getItem('SqueryLng');// this.queryLng;
        }

        else{
             var myLat = position.coords.latitude;
             var myLong = position.coords.longitude;
        } 

        var coords = new google.maps.LatLng(myLat,myLong);
        var mapOptions = {
        zoom:8,
        center:coords,
        //center:new google.maps.LatLng(51.508742,-0.120850),
        mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var div = $("#googleMap").length;
        if(div)
        var map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);
 

        //console.log(this.results);
        for (const [key, value] of Object.entries(this.results)) {

            //INFO
            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h1 id="firstHeading" class="firstHeading">'+value.name+'</h1>' +
                '<div id="bodyContent">' +
                '<p><b>Location: </b>'+value.location+', <a class="searchListing header_buttons font-weight-bold w-50 text-center my-3" target="_blank" href="https://test.jitume.com/#/serviceDetails/'+value.id+'">' +
                "View Business</a> " +
                "</div>" +
                "</div>";

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                ariaLabel: value.name,
              });
            //INFO

              this.addMarker({lat:value.lat, lng:value.lng},map,value.name,value.price,infowindow);
              //"lat": 48.353783,"lng": 11.79
            }
        

            this.addMarkerHome(coords,map);
        },

        addMarker(coords,map,title,fee,infowindow){
        const icon = {
            url: "images/map/other_business.png", // url
            scaledSize: new google.maps.Size(55, 27), // scaled size
        };

        var marker = new google.maps.Marker({
        map:map,
        position:coords,
        title:title,
        label:'$'+fee,
        icon:icon
        });

        marker.addListener("click", () => {
            infowindow.open({
              anchor: marker,
              map,
            });
            });
        },

         addMarkerHome(coords,map){
        const icon = {
            url: "images/map/myloc.png", // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
        };

        var marker = new google.maps.Marker({
        map:map,
        position:coords,
        icon:icon
        });
        },

         failure(){},
        //MAP -- MAP

    },

    mounted() {
        this.loc = this.$route.params.loc;
        this.replaceText();
        this.setRes()
        this.range()
        //this.cart()

        //MAP -- MAP
        var x = navigator.geolocation;
        setTimeout(() => x.getCurrentPosition(this.success, this.failure), 1000);
        //MAP -- MAP

        //return this.$store.dispatch("fetchpro")
    }

}
</script>
