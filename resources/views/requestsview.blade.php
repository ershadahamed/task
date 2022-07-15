@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Request Form | View</div>

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
                                        @foreach ($requests as $request)
                                            @if(Auth::user()->id == $request->requested_by || Auth::user()->getRoleNames()[0] == 'admin')
                                                @if($request->approved_by == null)
                                                    <a href="/requests/edit/{{ $request->id }}" class="btn btn-sm btn-secondary">Edit</a>
                                                @else
                                                    <a href="/requests/pdf/{{ $request->id }}" class="btn btn-sm btn-info">PDF</a>
                                                @endif
                                            @endif
                                        <a href="/requests" class="btn btn-sm btn-danger">Back</a>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p><span class="fw-bold">Date Request:</span> {!! date('d/m/Y H:i A', strtotime($request->created_at)) !!}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <p><span class="fw-bold">Request For:</span> {{ $request->type_of_request }}@if($request->other_description != null) - {{ $request->other_description }}@endif</p>
                                </div>
                            </div>
                        

                        <div class="">
                            <table class="table text-center" id="requestlist">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Desription</th>
                                        <th>Quantity</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>{{ $request->title1 }}</td>
                                        <td class="text-start">{!!nl2br($request->description1)!!}</td>
                                        <td>{{ $request->quantity1 }}</td>
                                        <td>{{ $request->remark1 }}</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>{{ $request->title2 }}</td>
                                        <td>{{ $request->description2 }}</td>
                                        <td>{{ $request->quantity2 }}</td>
                                        <td>{{ $request->remark2 }}</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>{{ $request->title3 }}</td>
                                        <td>{{ $request->description3 }}</td>
                                        <td>{{ $request->quantity3 }}</td>
                                        <td>{{ $request->remark3 }}</td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>{{ $request->title4 }}</td>
                                        <td>{{ $request->description4 }}</td>
                                        <td>{{ $request->quantity4 }}</td>
                                        <td>{{ $request->remark4 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mb-2 mt-5">
                            <div class="col-md-6">
                                <p><span class="fw-bold">Supplier:</span> {{ $request->supplier }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="fw-bold">SO No:</span> {{ $request->so_no }}</p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <p><span class="fw-bold">Price:</span> {{ $request->price }}</p>
                            </div>
                        </div>

                        @hasanyrole('admin')
                            @if($request->approved_by == null)
                                <div class="row mb-5">
                                    <div class="col-sm-12 text-center">
                                        <a href="/requests/approve/{{$request->id}}" onclick="return confirm('APPROVE this request form?')" class="btn btn-sm btn-success fs-6">Approve</a>
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