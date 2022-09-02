@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quotation | Edit</div>

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

                        @foreach($quotations as $q)
                        <div class="row mb-5">
                                <div class="col-sm-12 text-end">
                                    <a href="/quotation/view/{{ $q->id }}" class="btn btn-sm btn-danger">Cancel</a>
                                </div>
                        </div>

                        <form action="{{ route('quotation.updateform') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{$q->id}}"/>

                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <label for="customer_name" class="col-md-2 col-form-label">Customer Name</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{$q->customer_name}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <label for="product" class="col-md-2 col-form-label">Product</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="product" id="product" value="{{$q->product}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <label for="description" class="col-md-2 col-form-label">Description</label>
                                    <div class="col-md-5">
                                        <textarea class="form-control"name="description" id="description" autocomplete="off" style="height: 200px;">{{$q->description}}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <label for="filename" class="col-md-2 col-form-label">File Upload</label>
                                    <div class="col-md-5">
                                        @if ($q->filename==null)
                                            <input type="file" class="form-control" name="filename" id="filename">
                                        @else
                                            <input type="text" class="form-control" name="filename" id="filename" value="{{$q->filename}}" disabled>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2"></div>
                                    <label for="remark" class="col-md-2 col-form-label">Remark</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="remark" id="remark" value="{{$q->remark}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-primary fs-6">Update</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        document.getElementById('other').onchange = function() {
            document.getElementById('other_description').disabled = !this.checked;
            document.getElementById('other_description').value = "";
        };
    </script>
@endsection
