<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<style>
    html {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10pt;
    }

    .GP-logo {
        width: 20%;
    }

    .title {
        margin-top: -30px;
        margin-bottom: 50px;
        width: 100%;
        text-align: center;
    }

    .details {
        margin: 0px;
        padding: 0px;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
    }

    thead{
        background-color: lightgrey;
    }

    .fw-bold{
        font-weight: bold;
    }

    .details-bottom {
        margin-top: 20px;
        width: 100%;
        display: flex;
    }

    .details-bottom .left {
        width: 40%;
    }

    .details-bottom .right {
        width: 40%;
        float: right;
    }
</style>

<body>

<img class="GP-logo" src="{{ public_path("/images/GP_new_logo.png") }}" alt="">

<div class="title fw-bold">RESOURCES REQUEST FORM<br>(RRF)</div>
    
@foreach($requests as $r)
<div class="details">
    <span class="details-top"><span class="fw-bold">Date Request:</span> {!! date('d/m/Y H:i A', strtotime($r->created_at)) !!}</span>
    <br>
    <span class="details-top"><span class="fw-bold">Request For:</span> {{ $r->type_of_request }}</span>
</div>


<table class="">
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
            <td>{{ $r->title1 }}</td>
            <td class="text-start">{!!nl2br($r->description1)!!}</td>
            <td>{{ $r->quantity1 }}</td>
            <td>{{ $r->remark1 }}</td>
        </tr>
        <tr>
            <th>2</th>
            <td>{{ $r->title2 }}</td>
            <td>{{ $r->description2 }}</td>
            <td>{{ $r->quantity2 }}</td>
            <td>{{ $r->remark2 }}</td>
        </tr>
        <tr>
            <th>3</th>
            <td>{{ $r->title3 }}</td>
            <td>{{ $r->description3 }}</td>
            <td>{{ $r->quantity3 }}</td>
            <td>{{ $r->remark3 }}</td>
        </tr>
        <tr>
            <th>4</th>
            <td>{{ $r->title4 }}</td>
            <td>{{ $r->description4 }}</td>
            <td>{{ $r->quantity4 }}</td>
            <td>{{ $r->remark4 }}</td>
        </tr>
    </tbody>
</table>


<div class="details-bottom">
        <span><span class="fw-bold">Supplier:</span> {{ $r->supplier }}</span>
        <span class="right"><span class="fw-bold">SO No:</span> {{ $r->so_no }}</span>
</div>


<div class="details-bottom">
    <span><span class="fw-bold">Price:</span> {{ $r->price }}</span>
    <span class="right"><span class="fw-bold">Approved by:</span> @foreach($users as $user) @if($user->id == $r->approved_by) {{ $user->name }} @endif @endforeach</span>
</div>
@endforeach

</body>
</html>