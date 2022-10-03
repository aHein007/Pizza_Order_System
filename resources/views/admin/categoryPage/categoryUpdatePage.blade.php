@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-9">
        <div class="row mt-4">
          <div class="col-10 offset-4 mt-5">
            <div class="col-md-9">
                <a href="{{ route("admin#categoryPage") }}"><i class="fa-solid fa-arrow-left text-black fs-4 my-2"></i></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Update Category</legend>
                </div>
                <div class="card-body">
                    @if (Session::has("update"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get("update") }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif



                    @if (Session::has("notMatch"))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get("notMatch") }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif


                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route("admin#categoryUpdate",$categoryData->category_id) }}" method="POST">
                          @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Enter Update Name" value="{{ $categoryData->category_name}}" name="name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputDate" placeholder="Email"  value="{{ $categoryData->category_date }}" name="date">
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
      </section>
    </div>
@endsection
