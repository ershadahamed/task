@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sunway Namecard Status | Filtered</div>

                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-sm-12 text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">Back</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-sm table-bordered table-striped users">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>Date-In</th>
                                        <th>DO Number</th>
                                        <th>Customer Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{!! date('d/m/Y H:i A', strtotime($task->created_at)) !!}</td>
                                            <td>{{ $task->do_number }}</td>
                                            <td>{{ $task->customer_name }}</td>
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
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.users').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
