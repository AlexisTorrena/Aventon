<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>
 
  <body>
 
 @include('layout.partials.nav')
 
 @include('layour.partials.header')
  
 @include('Trips.newTrip')

 
 @yield('content')
 
 @include('layout.partials.footer')
 
 @include('layout.partials.footer-scripts')
 

  </body>
</html>
