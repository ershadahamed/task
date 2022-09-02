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
                    <div class="card-header">Quotation | Approved</div>

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
                                <a href="/quotation" class="btn btn-sm btn-danger">Back</a>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-sm table-strped table-bordered" id="tablelist">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <td>Quotation No</td>
                                        <td>Customer Name</td>
                                        <td>Request Revision</td>
                                        <td>Remark</td>
                                        <td>Approved By</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotations as $q)
                                        <tr>
                                            <td> {{ $q->quotation_no }} </td>
                                            <td> {{ $q->customer_name }} - {{ $q->product }}</td>
                                            <td>
                                                <input type="checkbox" name="request_revision" onclick="return confirm('Request revision for this quotation?')"
                                                    {{ $q->request_revision ? 'checked' : '' }} class="request_revision"
                                                    data-ids="{{ $q->id }}" @role('costing') disabled @endrole >
                                            </td>
                                            <td> {{ $q->remark }} </td>
                                            <td> {{ $q->approvedBy->name }} </td>
                                            <td>
                                                <a href="/quotation/view/{{$q->id}}" class="buttonView"><i class="fa fa-tv"></i></a>
                                                @if(Auth::user()->id == $q->submitted_by || Auth::user()->getRoleNames()[0] == 'admin')
                                                <a href="quotation/destroy/{{$q->id}}" onclick="return confirm('Delete {{$q->quotation_no}} permanently?')" class="buttonDelete"><i class="fa fa-trash"></i></a>
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

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablelist').DataTable({
                responsive: true,
                order: [[0, 'desc']]
            });
        });

        $(".request_revision").change(function() {
            let id = $(this).attr("data-ids");
            if (this.checked) {
                $.post('{{ route("quotation.request_revision") }}', {
                    checkedStatus: 1,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    location.reload()
                });
            } else {
                $.post('{{ route("quotation.request_revision") }}', {
                    checkedStatus: 0,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    location.reload()
                });
            }
        });
    </script>
@endsection
