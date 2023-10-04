<x-front-layout title="Order Details">

  <x-slot:breadcrumb>
    <div class="breadcrumbs">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-6 col-12">
            <div class="breadcrumbs-content">
              <h1 class="page-title">Order # {{ $order->number }}</h1>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <ul class="breadcrumb-nav">
              <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
              <li><a href="#">Orders</a></li>
              <li>Order # {{ $order->number }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </x-slot:breadcrumb>

  <section class="checkout-wrapper section">
    <div class="container">
      <h3>My Google Maps Demo</h3>
      <div id="map" style="height: 50vh;"></div>
    </div>
  </section>

  <script>
    // Initialize and add the map
    let map;

    async function initMap() {
      // The location of Uluru
      const position = {
        // lat: {{ $delivery->lat }},
        // lng: {{ $delivery->lng }}
        lat: '-25.433',
        lng: '131.031'
      };


      // Request needed libraries.
      //@ts-ignore
      const {
        Map
      } = await google.maps.importLibrary("maps");
      const {
        AdvancedMarkerElement
      } = await google.maps.importLibrary("marker");

      // The map, centered at Uluru
      map = new Map(document.getElementById("map"), {
        zoom: 4,
        center: position,
        mapId: "DEMO_MAP_ID",
      });

      // The marker, positioned at Uluru
      const marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: "Uluru",
      });
    }

    initMap();
  </script>

  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu2zXApnWgBiTd-xSv40fRvqDoULOaT9k&callback=initMap&v=weekly"
    defer></script>

  <!-- prettier-ignore -->
   {{-- <script>
  (g=>{var
  h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var
  d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await
  (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in
  g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+"
  could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only
  loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
  key: "YOUR_API_KEY",
  v: "weekly",
  // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
  // Add other bootstrap parameters as needed, using camel case.
  });
  </script> --}}




</x-front-layout>
