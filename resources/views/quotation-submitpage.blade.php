@extends('layouts.app')

@section('php')
<?php

$order_date_current = date("y").date("m");
$order_date_latest = $quotations->date_id;

if ($order_date_latest==$order_date_current) {
    $order_id_current = sprintf('%03d', $quotations->order_id + 1);
} else {
    $order_id_current = "001";
}


?>
@endsection

@section('content')

     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quoatation | New</div>

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
                                    <a href="/quotation" class="btn btn-sm btn-danger">Back</a>
                                </div>
                        </div>

                        <form action="{{ route('quotation.storeform') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="date_id" value="{{$order_date_current}}"/>
                        <input type="hidden" name="order_id" value="{{$order_id_current}}"/>
                        <input type="hidden" name="quotation_no" value="QYM-{{$order_date_current}}-{{$order_id_current}}"/>

                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <label for="customer_name" class="col-md-2 col-form-label">Customer Name</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="customer_name" id="customer_name" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <label for="product" class="col-md-2 col-form-label">Product</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="product" id="product" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <label for="description" class="col-md-2 col-form-label">Description</label>
                                <div class="col-md-5">
                                    <textarea class="form-control"name="description" id="description" autocomplete="off" style="height: 200px;"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <label for="filename" class="col-md-2 col-form-label">Image Upload</label>
                                <div class="col-md-5">
                                    <input type="file" class="form-control" name="filename" id="filename" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-2"></div>
                                <label for="remark" class="col-md-2 col-form-label">Remark</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="remark" id="remark" autocomplete="off">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-sm btn-primary fs-6">Submit</button>
                                </div>
                            </div>
                        </form>



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
