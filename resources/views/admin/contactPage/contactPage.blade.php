@extends("admin.mylayouts.app")

@section("content")
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has("contactMessage"))
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            {{ Session::get("contactMessage") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title p-1">Contact Table</h3>
                    <div class="card-tools my-2">
                        <form action="{{ route("admin#contactSearch") }}" method="get">
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
                      <th>Contact ID</th>
                      <th>Contact Name</th>
                      <th>Contact Email</th>
                      <th>Contact Message</th>

                      <th></th>
                    </tr>
                  </thead>
                  @if ($status == 0)
                      <td colspan="7">
                        <small class="text-muted">There is no data(or)Not Result Found!</small>
                      </td>
                  @else
                  <tbody>
                    @foreach ($contactData as $items)
                    <tr>
                        <td>{{ $items->contact_id }}</td>
                        <td>{{ $items->contact_name }}</td>
                        <td>{{ $items->contact_email }}</td>
                        <td>{{ $items->contact_message }}</td>

                        <td>

                          <a href="{{ route("admin#contactDelete",$items->contact_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  @endif
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="float-end">
                <h6 class="text-muted">Total - {{ $contactData->total() }}</h6>
            </div>
            {{ $contactData->links() }}
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
