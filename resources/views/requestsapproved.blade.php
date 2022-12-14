@extends('layouts.app')

@section('content')

<style>
    .buttonDelete {
        color: red;
        cursor: pointer;
    }
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Request Form | Approved</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                            <div class="row mb-5">
                                    <div class="col-sm-6">
                                    </div>

                                <div class="col-sm-6 text-end">
                                    <a href="/requests" class="btn btn-sm btn-danger">Back</a>
                                </div>
                            </div>


                        <div class="table-responsive">
                            <table class="table table-sm table-strped table-bordered" id="tasklist">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <td>Date In</td>
                                        <td>Title</td>
                                        <td>Requested By</td>
                                        <td>Approved By</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $r)
                                        <tr>
                                            <td>{!! date('d/m/Y', strtotime($r->created_at)) !!}</td>
                                            <td>
                                                {{ $r->title1 }}
                                            </td>
                                            <td>
                                                {{ $r->requestedBy->name }}
                                            </td>
                                            <td>
                                                {{ $r->approvedBy->name }}
                                            </td>
                                            <td>
                                                <a href="view/{{$r->id}}" class="buttonView"><i class="fa fa-tv"></i></a>
                                                @if(Auth::user()->getRoleNames()[0] == 'admin')
                                                <a href="/requests/destroy/{{$r->id}}" onclick="return confirm('Delete {{$r->title1}} request form permanently?')" class="buttonDelete"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modalCustomFilter" tabindex="-1" aria-labelledby="customFilterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('task.filtered') }}" method="POST" id="customFilterForm">
      <div class="modal-header">
        <h5 class="modal-title" id="customFilterLabel">Filter Task by Date</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            @csrf
          <div class="mb-3">
            <label for="do_number" class="col-form-label">From: </label>
            <input type="text" class="form-control dt" id="from" name="from" autocomplete="OFF">

            <label for="do_number" class="col-form-label">To: </label>
            <input type="text" class="form-control dt" id="to" name="to" autocomplete="OFF">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Go</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                "date-uk-pre": function ( a ) {
                var ukDatea = a.split('/');
                        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
                },

                "date-uk-asc": function ( a, b ) {
                        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },

                "date-uk-desc": function ( a, b ) {
                        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
        });


        $(document).ready(function() {
            $('#tasklist').DataTable({
                responsive: true,
                aoColumns: [
                        { "sType": "date-uk" },
                        null,
                        null,
                        null,
                        null
                ],
                order: [[0, 'desc']],
            });

            $('.dt').datetimepicker({
                timepicker: false,
                format: 'd/m/Y'
            });
        });
    </script>
@endsection
