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

    .pull-right {
        padding-right: 5px;
    }

    .pull-right:hover {
        cursor: pointer;
    }

    .customer_name {
        width: 50%;
        padding-left: 5px;
    }

    .buttonDelete {
        color: red;
        cursor: pointer;
    }
</style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                <div class="col-sm-6">
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
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{!! date('d/m/y H:i A', strtotime($task->created_at)) !!}</td>
                                            <td>
                                                @hasanyrole('admin|ctp')
                                                    <form action="{{ route('update.do') }}" method="POST">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="text" class="do_number" name="do_number" value="{{ $task->do_number }}" required>
                                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-sm btn-warning">Update</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                @endhasanyrole
                                            </td>
                                            <td>
                                                @hasanyrole('admin|ctp')
                                                    <form action="{{ route('update.customer_name') }}" method="POST">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="text" class="customer_name" name="customer_name" value="{{ $task->customer_name }}" required>
                                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-sm btn-warning">Update</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                @endhasanyrole
                                            </td>
                                            <td>
                                                <input type="checkbox" name="printing"
                                                    {{ $task->printing ? 'checked' : '' }} class="printing"
                                                    data-ids="{{ $task->id }}" @hasanyrole('logistic|view') disabled @endhasanyrole >
                                            </td>
                                            <td>
                                                <input type="checkbox" name="delivered"
                                                    {{ $task->delivered ? 'checked' : '' }} class="delivered"
                                                    data-ids="{{ $task->id }}"
                                                    @if ($task->printing == true && $task->do_number != null)
                                                    @else 
                                                    disabled
                                                    @endif
                                                    @hasanyrole('ctp|view') disabled @endhasanyrole>
                                            </td>
                                            <td>
                                                @hasanyrole('admin|ctp')
                                                <a href="task/destroy/{{$task->id}}" onclick="return confirm('Delete {{$task->customer_name}} namecard permanently?')" class="buttonDelete"><i class="fa fa-trash"></i></a>
                                                @endhasanyrole
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
                    doChecked: 1,
                    ids: id,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    alert(response.message);
                    location.reload()
                });
            } else {
                $.post('{{ route("task.printing") }}', {
                    doChecked: 0,
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