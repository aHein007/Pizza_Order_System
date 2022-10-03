@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has("add"))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert" >
            {{ Session::get("add") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if (Session::has("delete"))
          <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" >
              {{ Session::get("delete") }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has("update"))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            {{ Session::get("update") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route("admin#addCategoryPage") }}"><button class="btn btn-sm btn-outline-dark">Add Category <i class="fa-light fa-plus fs-5"></i></button></a>
                </h3>

                <div class="card-tools mt-2">
                  <form action="{{ route('admin#categorySearch') }}" method="get">
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
                          <th>Category Name</th>
                          <th>Created Date</th>
                          <th>Pizza Count</th>
                          <th></th>
                        </tr>
                      </thead>
                    @if ($status == 0)
                    <td colspan="7">
                        <small class="text-muted">There is no data (or) Not result found!</small>
                      </td>
                    @else
                        @foreach ($categoryData as $items)
                        <tbody>
                        <tr>
                        <td>{{ $items->category_id }}</td>
                        <td>{{ $items->category_name }}</td>
                        <td>{{ $items->category_date }}</td>
                        <td>
                           @if ($items->count === 0)
                           <a href="#" style="text-decoration: none;">{{ $items->count }}</a>
                           @else
                           <a href="{{ route('admin#countItemsPage',$items->category_id) }}" style="text-decoration: none;">{{ $items->count }}</a>
                           @endif
                        </td>
                        <td>
                            <a href="{{ route("admin#categoryUpdatePage",$items->category_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                            <a href="{{ route("admin#categoryDelete",$items->category_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                        </tr>
                    </tbody>
                        @endforeach
                    @endif
                    </table>
                  </div>

              <!-- /.card-body -->
            </div>
            <small class="float-end text-muted fs-6">
                Total - {{ $categoryData->count() }}
             </small>
            {{ $categoryData->links() }}

            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
