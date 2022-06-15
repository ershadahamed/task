@extends('layouts.app')

@section('content')

<style>
    .input-group input {
        border: 1px solid black; 
        border-radius: 0px;
        padding-left: 5px;
    }

    .input-group button {
        border: 1px solid black;
        border-radius: 0px;
    }

    .customer_name {
        width: 50%;
        padding-left: 5px;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Tasks</div>

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

                        @hasanyrole('admin|ctp')
                            <div class="row mb-5">
                                <div class="col">
                                    <form action="{{ route('task.store') }}" method="POST">
                                        @csrf

                                            <div class="input-group">
                                                <input type="text" class="customer_name" name="customer_name"
                                                    id="customer_name" required autofocus placeholder="Customer name">
                                                    
                                                <div class="input-group-prepend">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                    
                                    </form>
                                </div>
                            </div>
                        @endhasanyrole

                        <div class="table-responsive">
                            <table class="table table-sm table-strped table-bordered" id="tasklist">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <td>Date In</td>
                                        <td>DO Number</td>
                                        <td>Cust. Name</td>
                                        <td>Printing</td>
                                        <td>Delivered</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{!! date('d/m/y H:i A', strtotime($task->created_at)) !!}</td>
                                            <td>
                                                @if ($task->do_number == null)
                                                    @hasanyrole('admin|ctp')
                                                        <form action="{{ route('update.do') }}" method="POST">
                                                            @csrf
                                                            <div class="input-group">
                                                                <input type="text" class="do_number" name="do_number" required>
                                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-sm btn-warning">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endhasanyrole
                                                @else
                                                    {{ $task->do_number }}
                                                @endif
                                            </td>
                                            <td>{{ $task->customer_name }}</td>
                                            <td>
                                                <input type="checkbox" name="printing"
                                                    {{ $task->printing ? 'checked' : '' }} class="printing"
                                                    data-ids="{{ $task->id }}" @hasanyrole('logistic') disabled @endhasanyrole >
                                            </td>
                                            <td>
                                                <input type="checkbox" name="delivered"
                                                    {{ $task->delivered ? 'checked' : '' }} class="delivered"
                                                    data-ids="{{ $task->id }}"
                                                    {{ $task->printing ? '' : 'disabled' }} @hasanyrole('ctp') disabled @endhasanyrole>
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
            $('#tasklist').DataTable({
                responsive: true
            });
        });

        $(".printing").change(function() {
            let id = $(this).attr("data-ids");
            if (this.checked) {
                $.post('{{ route("task.printing") }}', {
                    doChecked: true,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            } else {
                $.post('{{ route("task.printing") }}', {
                    doChecked: false,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            }
        });

        $(".delivered").change(function() {
            let id = $(this).attr("data-ids");
            if (this.checked) {
                $.post('{{ route("task.delivered") }}', {
                    doChecked: true,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            } else {
                $.post('{{ route("task.delivered") }}', {
                    doChecked: false,
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
