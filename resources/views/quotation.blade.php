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
                    <div class="card-header">Quotation</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('failed') }}
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
                                    @hasanyrole('admin|requestor')
                                        <a  href="{{ route('quotation.submitpage') }}" type="submit" class="btn btn-sm btn-primary">New quotation</a>
                                    @endhasanyrole
                                    </div>

                                <div class="col-sm-6 text-end">
                                    <a href="{{ route('quotation.approved') }}" class="btn btn-sm btn-info">Approved</a>
                                </div>
                            </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-strped table-bordered" id="tablelist">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <td>Quotation No</td>
                                        <td>Customer Name</td>
                                        <td>Excel</td>
                                        <td>Urgent</td>
                                        <td>Request Revision</td>
                                        <td>Remark</td>
                                        <td>Submitted By</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotations as $q)
                                        <tr>
                                            <td> {{ $q->quotation_no }} </td>
                                            <td> {{ $q->customer_name }} - {{ $q->product }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="excel"
                                                    {{ $q->excel ? 'checked' : '' }} class="excel"
                                                    data-ids="{{ $q->id }}" @role('requestor') disabled @endrole >
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="urgent" id="urgent{{$q->id}}" @if($q->urgent==true)style="display: none;"@endif
                                                    {{ $q->urgent ? 'checked' : '' }} class="urgent form-check-input"
                                                    data-ids="{{ $q->id }}" @role('costing') onclick="return false;" @endrole >
                                                    @if ($q->urgent==true)
                                                        <label class="form-check-label btn-danger" style="padding: 2px 5px;" for="urgent{{$q->id}}">URGENT</label>
                                                    @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($q->request_revision==true)
                                                    <label class="btn-warning" style="padding: 2px 5px;">REQ REVISE</label>
                                                @endif
                                            </td>
                                            <td> {{ $q->remark }} </td>
                                            <td> {{ $q->submittedBy->name }} </td>
                                            <td>
                                                <a href="quotation/view/{{$q->id}}" class="buttonView"><i class="fa fa-tv"></i></a>
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

        $(".excel").change(function() {
            let id = $(this).attr("data-ids");
            if (this.checked) {
                $.post('{{ route("quotation.excel") }}', {
                    checkedStatus: 1,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            } else {
                $.post('{{ route("quotation.excel") }}', {
                    checkedStatus: 0,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            }
        });

        $(".urgent").change(function() {
            let id = $(this).attr("data-ids");
            if (this.checked) {
                $.post('{{ route("quotation.urgent") }}', {
                    checkedStatus: 1,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            } else {
                $.post('{{ route("quotation.urgent") }}', {
                    checkedStatus: 0,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            }
        });
    </script>
@endsection
