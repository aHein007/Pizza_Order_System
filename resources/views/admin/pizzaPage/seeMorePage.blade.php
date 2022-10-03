@extends("admin.mylayouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-4">
                <div class="card mt-3 ms-5">
                    <div class="card-header text-center fs-2 bg-secondary text-white">
                        Pizza Information
                    </div>
                    <div class="card-body">


                        <div class="fs-5  my-2">
                            <label for="">Pizza Name</label> : <span>{{ $dataPizza->pizza_name }}</span>
                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Image</label>
                            <div class="">
                                <img src="{{ asset("/uploadImage/".$dataPizza->pizza_image) }}" class="img-thumbnail" width="300px">
                            </div>

                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Price</label> : <span>{{ $dataPizza->pizza_price }} kyats</sp>
                        </div>



                        <div class="fs-5 my-2">
                            <label for="">Publish</label> :
                            <span >
                              @if ($dataPizza->publish_status == 0)
                                  Can't buy
                              @else
                                  Can buy
                              @endif
                            </span>


                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Category Name</label> : <span>{{ $dataPizza->category_name }}</span>
                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Discount Price</label> : <span>{{ $dataPizza->discount_price}} %</span>
                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Buy 1 get 1</label> : <span>
                               @if ($dataPizza->buy_one_get_one_status == 0)
                                   Can't get
                               @else
                                   Can get
                               @endif
                            </span>

                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Waiting Time</label> : <span >{{ $dataPizza->waiting_time }} minutes</span>
                        </div>

                        <div class="fs-5 my-2">
                            <label for="">Description</label> : <span>{{ $dataPizza->description }}</span>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route("admin#pizzaPage") }}"><button class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
