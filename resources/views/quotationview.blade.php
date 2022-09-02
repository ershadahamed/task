@extends('layouts.app')

@section('content')

<style>
    .imageupload {
        width: 50%;
        min-width: 300px;
    }
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quotation | View</div>

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
                                <div class="col-sm-12 text-end">
                                    @foreach ($quotations as $q)
                                        @if($q->approved_by == null)
                                            @if(Auth::user()->id == $q->requested_by || Auth::user()->getRoleNames()[0] == 'admin')
                                                <a href="/quotation/edit/{{ $q->id }}" class="btn btn-sm btn-secondary">Edit</a>
                                            @endif
                                        @endif
                                    <a href="/quotation" class="btn btn-sm btn-danger">Back</a>
                                </div>
                        </div>

                        <div class="">
                            <table class="table table-borderless" id="quotationlist">
                                <tbody>
                                    <tr>
                                        <th class="text-end col-md-2">Quotation No:</th>
                                        <td class="text-start">{{ $q->quotation_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Customer Name:</th>
                                        <td class="text-start">{{ $q->customer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Product:</th>
                                        <td class="text-start">{{ $q->product }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Description:</th>
                                        <td class="text-start">{!!nl2br($q->description)!!}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Image Upload:</th>
                                        @if ($q->filename==null)
                                            <td class="text-start">No image uploaded</td>
                                        @else
                                            <td class="text-start"><img class="imageupload" src="{{ URL::to('/') }}/imageupload/{{$q->filename}}" alt="Sample Picture"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Remark:</th>
                                        <td class="text-start">{{ $q->remark }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end col-md-2">Submitted by:</th>
                                        <td class="text-start">{{ $q->submittedBy->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @hasanyrole('admin')
                            @if($q->approved_by == null)
                                <div class="row mb-2">
                                    <div class="col-sm-12 text-center">
                                        <a href="/quotation/approve/{{$q->id}}" onclick="return confirm('APPROVE this quotation?')" class="btn btn-sm btn-success fs-6">Approve</a>
                                    </div>
                                </div>
                            @endif
                        @endhasanyrole

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    </script>
@endsection
