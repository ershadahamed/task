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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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

                        
                            <div class="row mb-5">
                                @hasanyrole('admin|ctp')
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
                                @endhasanyrole

                                <div class="col-sm-6 text-end">
                                    <button class="btn btn-sm btn-info">Custom Filter</button>
                                </div>
                            </div>
                        

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
                                            <td>{!! date('d/m/y H:i A', strtotime($task->updated_at)) !!}</td>
                                            <td>
                                                <p class="updateDo" data-ids="{{ $task->id }}">{{ $task->do_number }}</p>
                                            </td>
                                            <td>
                                                <p class="updateCustomerName" data-ids="{{ $task->id }}">{{ $task->customer_name }}</p>
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

<div class="modal fade" id="customFilter" tabindex="-1" aria-labelledby="customFilterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('task.custom.filter') }}" method="POST" id="customFilterForm">
      <div class="modal-header">
        <h5 class="modal-title" id="customFilterLabel">Update DO Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
            @csrf
          <div class="mb-3">
            <label for="do_number" class="col-form-label">DO: </label>
            <input type="text" class="form-control" id="do_number" name="do_number" autocomplete="OFF">
            <input type="hidden" name="task_id" id="task_id_for_do">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>   
    </div>
  </div>
</div>

@hasanyrole('admin|ctp')
<div class="modal fade" id="modalUpdateDo" tabindex="-1" aria-labelledby="modalUpdateDoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('update.do') }}" method="POST" id="doUpdateForm">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update DO Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
            @csrf
          <div class="mb-3">
            <label for="do_number" class="col-form-label">DO: </label>
            <input type="text" class="form-control" id="do_number" name="do_number" autocomplete="OFF">
            <input type="hidden" name="task_id" id="task_id_for_do">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>   
    </div>
  </div>
</div>

<div class="modal fade" id="modalUpdateCustomerName" tabindex="-1" aria-labelledby="modalUpdateCustomerNameLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('update.customer_name') }}" method="POST" id="customerNameUpdateForm">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Customer Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
            @csrf
          <div class="mb-3">
            <label for="customer_name" class="col-form-label">Customer Name: </label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" autocomplete="OFF">
            <input type="hidden" name="task_id" id="task_id_for_customer_name">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>   
    </div>
  </div>
</div>
@endhasanyrole
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tasklist').DataTable({
                responsive: true,
                order: [[0, 'desc']],
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

        let role = '{{Auth::user()->getRoleNames()[0]}}';
        if(role == 'ctp' || role == 'admin'){
            $('.updateDo').on('click', function(){
                $('#modalUpdateDo').modal('show');
                $('#task_id_for_do').val($(this).attr("data-ids"));
            });

            $('.updateCustomerName').on('click', function(){
                $('#modalUpdateCustomerName').modal('show');
                $('#task_id_for_customer_name').val($(this).attr("data-ids"));
            });
        }


        // $('#doUpdateDo').addEventListener('shown.bs.modal', function(){
        //     alert('open modal');
        // });
    </script>
@endsection