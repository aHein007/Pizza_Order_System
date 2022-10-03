@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">

      <div class="row mt-4">
        <div class="col-11 offset-2 mt-5">
          <div class="col-md-9">
            <a href="{{ route("admin#pizzaPage") }}" class="text-black"><div><i class="fas fa-arrow-left mb-3"></i></div></a>
            <div class="card">
              <div class="card-header p-2">

                <legend class="text-center">Update Category</legend>
              </div>
              <div class="card-body">

                <div class="text-center my-3">
                    <img src="{{ asset("/uploadImage/".$dataPizza->pizza_image) }}" class="img-thumbnail" width="200px" >
                </div>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                     {{-- for input file. enctypeform ထဲ မှာ photo တေ file တေ ပါချင် ရင် enctype="multipar/form-data" ရေးပေး ရပါတယ်။ --}}
                    <form class="form-horizontal" method="POST" action="{{ route("admin#updatePizza",$dataPizza->pizza_id) }}" enctype="multipart/form-data">
                       @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label " >Pizza Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Enter pizza name" name="name" value="{{ $dataPizza->pizza_name }}">
                          {{-- @if ($errors->has("name"))
                            <small class="text-danger">{{$errors->first("name")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputFile" class="col-sm-2 col-form-label " >Image</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputName" placeholder="Enter pizza image" name="image" value="">
                          {{-- @if ($errors->has("image"))
                            <small class="text-danger">{{$errors->first("image")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputFile" class="col-sm-2 col-form-label " >Price</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPrice" placeholder="Enter pizza price" name="price" value="{{ old("price",$dataPizza->pizza_price) }}">
                          {{-- @if ($errors->has("price"))
                            <small class="text-danger">{{$errors->first("price")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputPublish" class="col-sm-2 col-form-label">Publish Status</label>
                        <div class="col-sm-10">
                          <select name="publish" id="" class="form-control">
                            <option value="">Choose option.....</option>

                            @if ($dataPizza->publish_status == 0)
                                <option value="1" >Can buy</option>
                                <option value="0" selected>Can't buy</option>
                            @else
                                <option value="1" selected>Can buy</option>
                                <option value="0" >Can't buy</option>
                            @endif

                          </select>
                          {{-- @if ($errors->has("publish"))
                            <small class="text-danger">{{$errors->first("publish")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                          <select name="category" id="" class="form-control">
                            <option value="{{old("category",$dataPizza->category_id) }}">{{ $dataPizza->category_name }}</option>


                                @foreach ($dataCategory as $items )

                                @if ($dataPizza->pizza_name != $items->category_name)
                                <option value="{{ $items->category_id }}">{{ $items->category_name }}</option>

                                @endif
                                @endforeach

                          </select>
                           {{-- @if ($errors->has("category"))
                            <small class="text-danger">{{$errors->first("category")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputDiscount" class="col-sm-2 col-form-label " >Discount Price</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputDiscount" placeholder="Enter pizza discount" name="discount" value="{{old("discount",$dataPizza->discount_price)}}">
                          {{-- @if ($errors->has("discount"))
                            <small class="text-danger">{{$errors->first("discount")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputByOne" class="col-sm-2 col-form-label">By 1 Get 1</label>
                        <div class="col-sm-10  mt-2">

                                @if ($dataPizza->buy_one_get_one_status == 0)
                                <input type="radio" name="byOne" class="form-inoput-check" value="0" checked>Can't get
                                <input type="radio" name="byOne" class="form-input-check" value="1" >Can get
                                @else
                                <input type="radio" name="byOne" class="form-inoput-check" value="0" >Can't get
                                <input type="radio" name="byOne" class="form-input-check" value="1" checked>Can get
                                @endif

                            <br>
                          {{-- @if ($errors->has("byOne"))
                            <small class="text-danger">{{$errors->first("byOne")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputWaiting" class="col-sm-2 col-form-label " >Waiting Time</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputWaiting" placeholder="Enter pizza waiting" name="waiting" value="{{ old("waiting",$dataPizza->waiting_time) }}">
                          {{-- @if ($errors->has("waiting"))
                            <small class="text-danger">{{$errors->first("waiting")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputDescription" class="col-sm-2 col-form-label " placeholder="Enter description">Description</label>
                        <div class="col-sm-10">
                          <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ old("description",$dataPizza->description) }}</textarea>
                          {{-- @if ($errors->has("description"))
                            <small class="text-danger">{{$errors->first("description")}}***</small>
                          @endif --}}
                        </div>
                      </div>

                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Update</button>
                        </div>
                      </div>
                    </form>

                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
