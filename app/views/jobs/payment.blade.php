@extends('layouts.default')

@section('content')

<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_G59xaf43g03xVDXtwrZQ2ByW"
    data-amount="2000"
    data-name="Demo Site"
    data-description="2 widgets ($20.00)"
    data-image="/128x128.png">
  </script>
</form>

@stop