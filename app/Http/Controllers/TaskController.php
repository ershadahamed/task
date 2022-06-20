<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        return view('task')->with('tasks', Task::where('delivered', false)->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required'
        ]);

        $task = Task::create([
            'customer_name' => $request->customer_name,
            'printing' => false,
            'delivered' => false,
            'do_number' => 'N/A',
            'user_id' => Auth::user()->id,
            'printing_by' => null,
            'delivered_by' => null
        ]);

        return back()->with('status', 'Successfully created');
    }

    public function updateDo(Request $r)
    {
        $r->validate([
            'do_number' => 'required',
            'task_id' => 'required|integer'
        ]);

        $task = Task::find($r->task_id);
        $task->do_number = $r->do_number;
        $task->user_id = Auth::user()->id;
        $task->save();

        return back()->with('status', 'Successfully submitted DO number');
    }

    public function printing(Request $r)
    {
        $task = Task::find($r->ids);
        $task->printing = $r->doChecked ? 1 : 0;
        $task->printing_by = Auth::user()->id;
        $task->save();

        return response()->json(['message' => 'Status printing updated successfuly']);
    }

    public function delivered(Request $r)
    {
        $task = Task::find($r->ids);

        if(!$task->printing){
            return response()->json(['message' => 'Kindly wait for CTP printing update', 'error' => '001']);
        }

        $task->delivered = $r->doChecked ? 1 : 0;
        $task->delivered_by = Auth::user()->id;
        $task->save();

        return response()->json(['message' => 'Status delivery updated successfuly']);
    }

    public function completed()
    {
        return view('completed')->with('tasks', Task::where('delivered', 1)->get());
    }

    public function editCustomerName(Request $r)
    {

        $task = Task::find($r->task_id);
        $task->customer_name = $r->customer_name;
        $task->user_id = Auth::user()->id;
        $task->save();

        return back()->with('status', 'Successfully updated customer name');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect('/tasks');
    }

    public function deleteMoreThan7Days()
    {
        $task = Task::whereDate('updated_at', '<=', now()->subDays(7)->setTime(0, 0, 0)->toDateTimeString())
            ->where('delivered', 1)->delete();

        return response()->json($task);
    }
}
