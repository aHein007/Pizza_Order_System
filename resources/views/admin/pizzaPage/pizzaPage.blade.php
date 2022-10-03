@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

                @if (Session::has("add"))
                    <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                        {{ Session::get("add") }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif

                 @if (Session::has("success"))
                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ Session::get("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                    @if (Session::has("delete"))
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        {{ Session::get("delete") }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">

              <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route("admin#addPizzaPage") }}"><button class="btn btn-sm btn-outline-dark">Add Pizza <i class="fa-light fa-plus fs-5"></i></button></a>
                  </h3>

                  <div class="card-tools mt-2">
                    <form action="{{ route('admin#pizzaSearch') }}" method="get">
                      <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="searchData" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   @if ($status == 0)
                        <td colspan="7">
                            <small class="text-muted">There is no result (or) No data found!</small>
                        </td>
                   @else
                   @foreach ($pizzaData as $items)
                   <tr>
                       <td>{{ $items->pizza_id }}</td>
                       <td>{{ $items->pizza_name }}</td>
                       <td>
                         <img src="{{ asset("/uploadImage/".$items->pizza_image) }}" class="img-thumbnail" width="80px">
                       </td>
                       <td>{{ $items->pizza_price }} kyats</td>
                       <td>
                           @if ( $items->publish_status == 0)
                               Can't buy
                           @else
                               Can buy
                           @endif
                       </td>
                       <td>@if ($items->buy_one_get_one_status == 0)
                           Can't get
                       @else
                           Can get
                       @endif</td>
                       <td>

                         <a href="{{ route('admin#seeMorePage',$items->pizza_id) }}"><button class="btn btn-sm bg-info text-white"><i class="fa-solid fa-eye"></i></button></a>
                         <a href="{{ route("admin#updatePizzaPage",$items->pizza_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                         <a href="{{ route('admin#deletePizza',$items->pizza_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                       </td>
                     </tr>
                   @endforeach
                   @endif


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="text-muted float-end">
              Total - {{ $pizzaData->count() }}
            </div>
            {{ $pizzaData->links() }}
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection()
