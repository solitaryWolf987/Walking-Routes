

<iframe width="1000" height="750" src="https://api.maptiler.com/maps/outdoor/?key=kVbYzZdvpCATj1RhoWrx#4.3/54.61178/-6.16035"></iframe>

<html>
  <head>
    <script src="https://cdn.maptiler.com/maptiler-geocoder/v1.1.0/maptiler-geocoder.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-geocoder/v1.1.0/maptiler-geocoder.css" rel="stylesheet" />
  </head>
  <body>
    <input autocomplete="off" id="search" type="text" placeholder="Search..."/>
    <script>
      var geocoder = new maptiler.Geocoder({
        input: 'search',
        key: 'kVbYzZdvpCATj1RhoWrx'
      });
      geocoder.on('select', function(item) {
        console.log('Selected', item);
        
      });
      
      
    </script>
  </body>
</html>

