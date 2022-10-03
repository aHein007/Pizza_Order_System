@extends("user.userApp")

@section("content")




    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset("/uploadImage/".$pizzaItem->pizza_image) }}" class="img-thumbnail" width="100%" >            <br>


            <a href="{{ route('user#orderDetailPage',$pizzaItem->pizza_id) }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            @if (Session::has("orderSucces"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get("orderSucces") }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
            <h3>Name</h3>
            <h6 class="text-muted">{{ $pizzaItem->pizza_name }}</h6> <hr>

            <h3>Price</h3>
            <h6 class="text-muted">{{ $pizzaItem->pizza_price  - $pizzaItem->discount_price}} Ks (included discount)</h6> <hr>

            <h3>Waiting Time</h3>
            <h6 class="text-muted">{{ $pizzaItem->waiting_time }} minutes</h6> <hr>

            <form action="{{ route('user#orderProcess') }}" method="POST">
                @csrf
                <h3>Pizza Count</h3>
                <input type="number" class="form-control" placeholder="Enter your pizza count....." name="count"> <hr>

                <h3>Payment Method</h3>
                <input type="radio" name="pay" class="form-radio" value="0">Visa
                <input type="radio" name="pay" class="form-radio" value="1">Cash
                <hr>




            <button class="btn btn-primary">Order Now</button>
        </form>
        <p>
            <h3 class="text-danger">Total Price</h3>
            <h6 class="text-success">{{ $pizzaItem->pizza_price  - $pizzaItem->discount_price}} Ks</h6>
        </p>

        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js "></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js "></script>
</body>

</html>
@endsection
