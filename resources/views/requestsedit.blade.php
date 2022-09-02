@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Request Form | Edit</div>

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

                        @foreach($requests as $request)
                        <div class="row mb-5">
                                <div class="col-sm-12 text-end">
                                    <a href="/requests/view/{{ $request->id }}" class="btn btn-sm btn-danger">Cancel</a>
                                </div>
                        </div>

                        <form action="{{ route('requests.updateform') }}" method="POST">
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
                                    <input type="text" name="other_description" id="other_description" value="{{ $request->other_description }}" disabled>
                                </div>
                            </div>

                            <script type="text/javascript">
                            var tor1 = document.getElementById('material_purchase');
                            var tor2 = document.getElementById('semi_outsource');
                            var tor3 = document.getElementById('finishing');
                            var tor4 = document.getElementById('accessories');
                            var tor5 = document.getElementById('outsource');
                            var tor6 = document.getElementById('other');

                                if (tor1.value=='{{ $request->type_of_request }}') {
                                tor1.checked = true;
                                }
                                if (tor2.value=='{{ $request->type_of_request }}') {
                                tor2.checked = true;
                                }
                                if (tor3.value=='{{ $request->type_of_request }}') {
                                tor3.checked = true;
                                }
                                if (tor4.value=='{{ $request->type_of_request }}') {
                                tor4.checked = true;
                                }
                                if (tor5.value=='{{ $request->type_of_request }}') {
                                tor5.checked = true;
                                }
                                if (tor6.value=='{{ $request->type_of_request }}') {
                                tor6.checked = true;
                                }

                            </script>

                            <hr class="mb-5">

                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                    <label class="fw-bold" for="">1.</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title1" id="title1" placeholder="placeholder" autocomplete="off" value="{{ $request->title1 }}">
                                        <label class="" for="title1">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description1" id="description1" placeholder="placeholder" autocomplete="off" style="height: 200px;">{{ $request->description1 }}</textarea>
                                        <label class="" for="description1">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity1" id="quantity1" placeholder="placeholder" autocomplete="off" value="{{ $request->quantity1 }}">
                                        <label class="" for="quantity1">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark1" id="remark1" placeholder="placeholder" autocomplete="off" value="{{ $request->remark1 }}">
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
                                        <input type="text" class="form-control" name="title2" id="title2" placeholder="placeholder" autocomplete="off" value="{{ $request->title2 }}">
                                        <label class="" for="title2">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description2" id="description2" placeholder="placeholder" autocomplete="off" style="height: 200px;">{{ $request->description2 }}</textarea>
                                        <label class="" for="description2">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity2" id="quantity2" placeholder="placeholder" autocomplete="off" value="{{ $request->quantity2 }}">
                                        <label class="" for="quantity2">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark2" id="remark2" placeholder="placeholder" autocomplete="off" value="{{ $request->remark2 }}">
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
                                        <input type="text" class="form-control" name="title3" id="title3" placeholder="placeholder" autocomplete="off" value="{{ $request->title3 }}">
                                        <label class="" for="title3">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description3" id="description3" placeholder="placeholder" autocomplete="off" style="height: 200px;">{{ $request->description3 }}</textarea>
                                        <label class="" for="description3">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity3" id="quantity3" placeholder="placeholder" autocomplete="off" value="{{ $request->quantity3 }}">
                                        <label class="" for="quantity3">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark3" id="remark3" placeholder="placeholder" autocomplete="off" value="{{ $request->remark3 }}">
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
                                        <input type="text" class="form-control" name="title4" id="title4" placeholder="placeholder" autocomplete="off" value="{{ $request->title4 }}">
                                        <label class="" for="title4">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-floating">
                                        <textarea class="form-control"name="description4" id="description4" placeholder="placeholder" autocomplete="off" style="height: 200px;">{{ $request->description4 }}</textarea>
                                        <label class="" for="description4">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col md-1 text-center">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="quantity4" id="quantity4" placeholder="placeholder" autocomplete="off" value="{{ $request->quantity4 }}">
                                        <label class="" for="quantity4">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-9" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="remark4" id="remark4" placeholder="placeholder" autocomplete="off" value="{{ $request->remark4 }}">
                                        <label class="" for="remark4">Remark</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-5">

                            <div class="row mb-2">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="supplier" id="supplier" placeholder="placeholder" autocomplete="off" value="{{ $request->supplier }}">
                                        <label class="" for="supplier">Supplier</label>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3"></div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="price" id="price" placeholder="placeholder" autocomplete="off" value="{{ $request->price }}">
                                        <label class="" for="price">Price</label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 8px;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="so_no" id="so_no" placeholder="placeholder" autocomplete="off" value="{{ $request->so_no }}">
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

                            <input type="hidden" name="id" value="{{ $request->id }}">
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
