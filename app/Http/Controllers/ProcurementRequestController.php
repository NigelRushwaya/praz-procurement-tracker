<?php

namespace App\Http\Controllers;

use App\Models\ProcurementRequest;
use Illuminate\Http\Request;

class ProcurementRequestController extends Controller
{
public function index(Request $request)
{
    $query = ProcurementRequest::query();

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('request_number', 'like', "%{$search}%")
              ->orWhere('procuring_entity', 'like', "%{$search}%");
        });
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by procurement method
    if ($request->filled('procurement_method')) {
        $query->where('procurement_method', $request->procurement_method);
    }

    $requests = $query->latest()->paginate(10);

    $totalRequests = ProcurementRequest::count();

    $pendingRequests = ProcurementRequest::where(
        'status',
        'Pending'
    )->count();

    $evaluationRequests = ProcurementRequest::where(
        'status',
        'Under Evaluation'
    )->count();

    $approvedRequests = ProcurementRequest::where(
        'status',
        'Approved'
    )->count();

    return view('procurement_requests.index', compact(
        'requests',
        'totalRequests',
        'pendingRequests',
        'evaluationRequests',
        'approvedRequests'
    ));
}

    public function create()
    {
        return view('procurement_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_number' => 'required',
            'procuring_entity' => 'required',
            'description' => 'required',
            'procurement_method' => 'required',
            'date_submitted' => 'required|date',
        ]);

        ProcurementRequest::create([
            'request_number' => $request->request_number,
            'procuring_entity' => $request->procuring_entity,
            'description' => $request->description,
            'procurement_method' => $request->procurement_method,
            'status' => 'Pending',
            'date_submitted' => $request->date_submitted,
        ]);

        return redirect('/')->with ('success','Procurement request added successfully.');
    }
    public function edit(ProcurementRequest $procurementRequest)
{
    return view('procurement_requests.edit', compact('procurementRequest'));
}

public function update(Request $request, ProcurementRequest $procurementRequest)
{
    $request->validate([
        'request_number' => 'required',
        'procuring_entity' => 'required',
        'description' => 'required',
        'procurement_method' => 'required',
        'status' => 'required',
        'date_submitted' => 'required|date',
    ]);

    $procurementRequest->update([
        'request_number' => $request->request_number,
        'procuring_entity' => $request->procuring_entity,
        'description' => $request->description,
        'procurement_method' => $request->procurement_method,
        'status' => $request->status,
        'date_submitted' => $request->date_submitted,
    ]);

    return redirect('/')->with('success','Procurement request updated successfully.');
}
public function destroy(ProcurementRequest $procurementRequest)
{
    $procurementRequest->delete();

    return redirect('/')->with('success','Procurement request deleted successfully.');
}
public function show(ProcurementRequest $procurementRequest)
{
    return view('procurement_requests.show', compact('procurementRequest'));
}
}