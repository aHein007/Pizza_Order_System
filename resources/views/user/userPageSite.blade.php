@extends("user.userApp")

@section("content")
<div class="container px-4 px-lg-5" id="home">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://graphiccloud.net/wp-content/uploads/2021/06/Pizza-Logo-Design-Illustrations-1.jpg" alt="..." /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">Crown <i class="fa-solid fa-crown"></i> Pizza</h1>
            <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <a class="btn btn-primary" href="#!">Enjoy!</a>
        </div>
    </div>

    <!-- Content Row-->
    <div class="d-flex justify-content-around">
        <div class="col-3 me-5">
            <div class="">
                <div class="py-5 text-center">
                    <form class="d-flex m-5" action="{{ route("user#userSearchBar") }}" method="GET">
                        <input class="form-control me-2" type="text" name="searchData" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>

                    <div class="">
                        <a href="{{ route("user#userPageSite") }}" style="text-decoration:none;color:black;" ><div class="m-2 p-2 user-select-none">All</div></a>
                        @foreach ($dataCategory as $categoryItems)
                        <a href="{{ route("user#clickSearch",$categoryItems->category_id) }}" style="text-decoration:none;color:black;" ><div class="m-2 p-2 user-select-none">{{ $categoryItems->category_name }}</div></a>
                        @endforeach

                    </div>
                    <hr>
                    <div class="text-center m-4 p-2">
                        <h3 class="mb-3">Start Date - End Date</h3>

                        <form action="{{ route('user#minPrice') }}" method="GET">

                            <input type="date" name="startDate" id="" class="form-control"> -
                            <input type="date" name="endDate" id="" class="form-control">
                            <hr>

                        <h3 class="mb-3">Min - Max Amount</h3>
                        <p class="text-muted">Note - we have Max Price start from 15000 ks</p>

                            @csrf
                            <input type="number" name="min" id="" class="form-control" placeholder="minimum price"> -
                            <input type="number" name="max" id="" class="form-control" placeholder="maximun price">
                            <button class="btn btn-outline-dark mt-3">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">

            <div class="row gx-4 gx-lg-5" id="pizza">
               @if ($status === 0)
                   <h3 class="text-muted">Not items found!</h3>
               @else
               @foreach ($pizzaItems as $items)

                <div class="col-auto mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->

                       @if ($items->buy_one_get_one_status === 0)
                            <div class="badge bg-dark text-white position-absolute user-select-none" style="top: 0.5rem; right: 0.5rem">Sale</div>
                       @else
                            <div class="badge bg-danger text-white position-absolute user-select-none" style="top: 0.5rem; right: 0.5rem">Buy One Get One</div>
                       @endif
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('/uploadImage/' .$items->pizza_image) }}" width="200px" height="190px" />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $items->pizza_name }}</h5>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">{{ $items->pizza_price -$items->discount_price }} ks</span> {{ $items->pizza_price }} ks
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route("user#orderDetailPage",$items->pizza_id) }}">Order Detail</a></div>
                        </div>
                    </div>
                </div>

               @endforeach
               @endif
            </div>
            {{ $pizzaItems->links() }}
        </div>
    </div>
</div>

<div class="text-center d-flex justify-content-center align-items-center" id="contact">
    <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
        <h3>Contact Us</h3>
        @if (Session::has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form action="{{ route("user#userContact") }}" class="my-4" method="POST">
            @csrf
            <input type="text" name="name" id="" class="form-control my-3" placeholder="Name">
            <input type="text" name="email" id="" class="form-control my-3" placeholder="Email">
            <textarea class="form-control my-3" id="exampleFormControlTextarea1" rows="3" placeholder="Message" name="message"></textarea>
            <button type="submit" class="btn btn-outline-dark">Send  <i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</div>
@endsection
