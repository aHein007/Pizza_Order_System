@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-9 offset-2 mt-5">
            <a href="{{ route("admin#page") }}"><i class="fa-solid fa-arrow-left text-black fs-4"></i></a>
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Change Password</legend>
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

                    <div class="card-body">
                        @if (Session::has("notSame"))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get("notSame") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <div class="card-body">
                            @if (Session::has("oldError"))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get("oldError") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route("admin#changePassword",auth()->user()->id) }}" method="POST">
                          @csrf
                        <div class="form-group row">
                          <label for="inputOld" class=" col-form-label">Old Password</label>
                          <div class="col-sm-15">
                            <input type="text" class="form-control" id="inputOld" placeholder="Enter Old Password" value="" name="old">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputNew" class=" col-form-label">New Password</label>
                          <div class="col-sm-15">
                            <input type="text" class="form-control" id="inputNew" placeholder="Enter New Password"  value="" name="new">
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputConfirm" class=" col-form-label">Confirm Password</label>
                            <div class="col-sm-15">
                              <input type="text" class="form-control" id="inputConfirm" placeholder="Enter Confirm Password"  value="" name="confirm">
                            </div>
                          </div>


                        <div class="">
                          <div class="col-sm-15">
                            <button type="submit" class="btn bg-dark text-white">Change</button>
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
