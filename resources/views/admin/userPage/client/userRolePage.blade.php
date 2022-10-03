@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
                <h3 class="card-title my-1">
                    <a href="{{ route("admin#adminRole") }}"><button class="btn btn-sm btn-outline-dark">Admin Role<i class="fa-solid fa-user mx-1"></i></button></a>
                    <a href="{{ route("admin#userRole") }}"><button class="btn btn-sm btn-outline-dark">User Role<i class="fa-solid fa-users mx-1"></i></button></a>
                </h3>

                <div class="card-tools my-2">
                  <form action="{{ route("admin#userSearch") }}" method="get">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="dataSearch" class="form-control float-right" placeholder="Search">

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
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                  @if ($counter == 0)
                  <td colspan="7">
                    <small class="text-muted">There is no result (or) No data found!</small>
                    </td>
                  @else
                    @foreach ($userData as $items)
                    <tr>
                        <td>{{ $items->id }}</td>
                        <td>{{ $items->name }}</td>
                        <td>{{ $items->email }}</td>
                        <td>{{ $items->phone }}</td>
                        <td>{{ $items->address }}</td>
                        <td>
                           <a href="{{ route("admin#userDelete",$items->id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                      </tr>
                    @endforeach
                     @endif
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            {{ $userData->links() }}
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection()
