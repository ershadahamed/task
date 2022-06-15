@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tasks | Completed</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-sm table-strped table-bordered" id="tasklist">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <td>Date In</td>
                                        <td>DO Number</td>
                                        <td>Cust. Name</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{!! date('d/m/y H:i A', strtotime($task->created_at)) !!}</td>
                                            <td>
                                                {{ $task->do_number }}
                                            </td>
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
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tasklist').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
