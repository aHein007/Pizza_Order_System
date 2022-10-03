@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @if (Session::has("categorySuccess"))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  {{Session::get("categorySuccess")}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          @endif


              @if (Session::has("updateData"))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  {{Session::get("updateData")}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif


              @if (Session::has("deleteData"))
                <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                  {{Session::get("deleteData")}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
        <div class="row mt-4">
            <div class="mt-3">
                <a href="{{ route("admin#categoryPage") }}" class="text-black"><div><i class="fas fa-arrow-left mb-3"></i></div></a>
            </div>
            <h6 class="text-muted my-2" style="text-decoration:underline">Category Name -  {{ $pizzaData[0]->pizza_name }}</h6>
          <div class="col-12">

            <div class="card">


              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>

                      <th>Pizz Image</th>
                      <th>Pizza Price</th>

                      <th></th>
                    </tr>
                  </thead>

                 @foreach ($pizzaData as $newCategory )
                 <tbody style="border-top:none;">
                  <tr>
                    <td>{{$newCategory->category_id}}</td>
                    <td>{{$newCategory->pizza_name}}</td>
                    <td><img src="{{asset("/uploadImage/".$newCategory->pizza_image)}}"   class="img-thumbnail" width="100px"></td>
                    <td>{{$newCategory->pizza_price}}</td>
                    <td>

                    </td>

                  </tr>



                </tbody>
                 @endforeach

                </table>

              </div>

              <!-- /.card-body -->
            </div>
            <div class="float-end">
                <h6 class="text-muted">Total - {{ $pizzaData->total() }}</h6>
            </div>

            <div class="mt-3">
              {{$pizzaData->links()}}
            </div>


            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
