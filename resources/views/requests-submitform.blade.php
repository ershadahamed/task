@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Request Form | New</div>

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
                                    <a href="/requests" class="btn btn-sm btn-danger">Back</a>
                                </div>
                        </div>

                        <form action="{{ route('requests.storeform') }}" method="POST">
                        @csrf
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input class="form-check-input" type="radio" name="type_of_request" value="Material Purchase" id="material_purchase">
                                    <label class="form-check-label" for="material_purchase">Material Purchase</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input" type="radio" name="type_of_request" value="Semi-Outsource" id="semi_outsource">
                                    <label class="form-check-label" for="semi_outsource">Semi Outsource</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input" type="radio" name="type_of_request" value="Finishing" id="finishing">
                                    <label class="form-check-label" for="finishing">Finishing</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <input class="form-check-input" type="radio" name="type_of_request" value="Accessories" id="accessories">
                                    <label class="form-check-label" for="accessories">Accessories</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input" type="radio" name="type_of_request" value="Outsource" id="outsource">
                                    <label class="form-check-label" for="outsource">Outsource</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input other" type="radio" name="type_of_request" value="Other" id="other">
                                    <label class="form-check-label" for="other">Other:</label>
                                    <input type="text" name="other_description" id="other_description" disabled>
                                </div>
                            </div>

                            <hr class="mb-5">

                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                    <label class="fw-bold" for="">1.</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title1" id="title1" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="title1">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description1" id="description1" placeholder="placeholder" autocomplete="off" style="height: 200px;"></textarea>
                                        <label class="" for="description1">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity1" id="quantity1" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="quantity1">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark1" id="remark1" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="remark1">Remark</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                    <label class="fw-bold" for="">2.</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title2" id="title2" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="title2">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description2" id="description2" placeholder="placeholder" autocomplete="off" style="height: 200px;"></textarea>
                                        <label class="" for="description2">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity2" id="quantity2" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="quantity2">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark2" id="remark2" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="remark2">Remark</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                    <label class="fw-bold" for="">3.</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title3" id="title3" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="title3">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description3" id="description3" placeholder="placeholder" autocomplete="off" style="height: 200px;"></textarea>
                                        <label class="" for="description3">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity3" id="quantity3" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="quantity3">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark3" id="remark3" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="remark3">Remark</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                    <label class="fw-bold" for="">4.</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title4" id="title4" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="title4">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description4" id="description4" placeholder="placeholder" autocomplete="off" style="height: 200px;"></textarea>
                                        <label class="" for="description4">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity4" id="quantity4" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="quantity4">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark4" id="remark4" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="remark4">Remark</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-5">

                            <div class="row mb-2">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="supplier" id="supplier" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="supplier">Supplier</label>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3"></div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="price" id="price" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="price">Price</label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="so_no" id="so_no" placeholder="placeholder" autocomplete="off">
                                        <label class="" for="so_no">SO No.</label>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>


                            <div class="row mb-5">
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
        document.getElementById('other').onchange = function() {
            document.getElementById('other_description').disabled = !this.checked;
            document.getElementById('other_description').value = "";
        }
    </script>
@endsection
