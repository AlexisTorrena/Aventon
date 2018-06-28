<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>

  <body>

 @include('layout.partials.nav')


 <main class="py-4">
     @yield('content')
 </main>

 @include('layout.partials.footer')

 @include('layout.partials.footer-scripts')


  </body>
</html>
