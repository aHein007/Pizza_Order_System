@extends("user.userApp")

@section("content")
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{ asset("/uploadImage/".$pizzaItem->pizza_image) }}" class="img-thumbnail" width="100%"> <br>
        <a href="{{ route("user#orderBuy",$pizzaItem->pizza_id) }}">
            <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
        </a>
        <a href="{{ route("user#userPageSite") }}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>


    </div>
    <div class="col-6">

        <h5>Pizza Name</h5>
        <h6 class="text-muted">{{ $pizzaItem->pizza_name }}</h6> <hr>

        <h5>Pizza Price</h5>
        <h6 class="text-muted">{{$pizzaItem->pizza_price }} Ks</h6> <hr>

        <h5>Discount Price</h5>
        <h6 class="text-muted">{{ $pizzaItem->discount_price }} Ks</h6> <hr>

        <h5>Waiting Time</h5>
        <h6 class="text-muted">{{ $pizzaItem->waiting_time }} minutes</h6> <hr>

        <h5>Buy One Get One Status</h5>
        <h6 class="text-muted">
            @if ($pizzaItem->buy_one_get_one_status === 0)
                Can't get
            @else
                Can get
            @endif
        </h6> <hr>

        <h5>Description</h5>
        <h6 class="text-muted">{{$pizzaItem->description }}</h6> <hr>

    </div>
</div>
@endsection
