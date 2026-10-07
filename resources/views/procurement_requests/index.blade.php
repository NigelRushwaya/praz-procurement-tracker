<!DOCTYPE html>
<html>
<head>
    <title>PRAZ Procurement Tracker</title>



    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .navbar {
            background-color: #212529;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar span {
            font-size: 14px;
            color: #ccc;
        }

        .container {
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            color: #777;
        }

        .add-button {
            background-color: #198754;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 15px;
            color: #777;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #343a40;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .status {
            padding: 5px 9px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .evaluation {
            background-color: #cfe2ff;
            color: #084298;
        }

        .approved {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .rejected {
            background-color: #f8d7da;
            color: #842029;
        }

        .edit {
            color: #0d6efd;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete-button {
            color: #dc3545;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="navbar">

    <h2>PRAZ Procurement Tracker</h2>

    <div style="display: flex; align-items: center; gap: 15px;">

        <div style="display: flex; flex-direction: column; align-items: flex-end;">
    <strong style="color: white;">
        {{ Auth::user()->name }}
    </strong>

    <small style="color: #cbd5e1;">
        {{ Auth::user()->role }}
    </small>
</div>

        <form action="{{ url('/logout') }}" method="POST" style="margin: 0;">
            @csrf

            <button type="submit"
                    style="
                        background-color: #dc3545;
                        color: white;
                        border: none;
                        padding: 8px 14px;
                        border-radius: 5px;
                        cursor: pointer;
                        font-weight: bold;
                    ">
                Logout
            </button>
        </form>

    </div>

</div>

    <div class="container">
        @if (session('success'))

    <div style="
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 12px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    ">
        {{ session('success') }}
    </div>

@endif

        <div class="header">

            <div>
                <h1>Dashboard</h1>
                <p>Overview of procurement requests</p>
            </div>

           @if(Auth::user()->role === 'Admin')
    <a href="{{ url('/procurement-requests/create') }}">
        Add Request
    </a>
@endif

        </div>


        <!-- SUMMARY CARDS -->

        <div class="cards">

            <div class="card">
                <h3>Total Requests</h3>

                <div class="number">
                    {{ $totalRequests}}
                </div>
            </div>


            <div class="card">
                <h3>Pending</h3>

                <div class="number">
                    {{ $pendingRequests }}
                </div>
            </div>


            <div class="card">
                <h3>Under Evaluation</h3>

                <div class="number">
                    {{ $evaluationRequests }}
                </div>
            </div>


            <div class="card">
                <h3>Approved</h3>

                <div class="number">
                    {{ $approvedRequests }}
                </div>
            </div>

        </div>


        <!-- REQUEST TABLE -->

        <div class="table-container">

            <h2>Procurement Requests</h2>

<form method="GET" action="/" style="margin-bottom: 25px;">

    <input
        type="text"
        name="search"
        placeholder="Search request number or procuring entity..."
        value="{{ request('search') }}"
        style="padding: 10px; width: 300px;"
    >

    <select name="status" style="padding: 10px;">

        <option value="">All Statuses</option>

        <option value="Pending"
            {{ request('status') == 'Pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="Under Evaluation"
            {{ request('status') == 'Under Evaluation' ? 'selected' : '' }}>
            Under Evaluation
        </option>

        <option value="Approved"
            {{ request('status') == 'Approved' ? 'selected' : '' }}>
            Approved
        </option>

        <option value="Rejected"
            {{ request('status') == 'Rejected' ? 'selected' : '' }}>
            Rejected
        </option>

    </select>


    <select name="procurement_method" style="padding: 10px;">

        <option value="">All Methods</option>

        <option value="RFQ"
            {{ request('procurement_method') == 'RFQ' ? 'selected' : '' }}>
            RFQ
        </option>

        <option value="Open Tender"
            {{ request('procurement_method') == 'Open Tender' ? 'selected' : '' }}>
            Open Tender
        </option>

        <option value="Restricted Tender"
            {{ request('procurement_method') == 'Restricted Tender' ? 'selected' : '' }}>
            Restricted Tender
        </option>

    </select>


    <button type="submit">
        Search
    </button>


    <a href="/" style="margin-left: 10px;">
        Reset
    </a>

</form>

            <br>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Request Number</th>
                        <th>Procuring Entity</th>
                        <th>Description</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse ($requests as $request)

                        <tr>

                            <td>
                                {{ $request->id }}
                            </td>

                            <td>
                                {{ $request->request_number }}
                            </td>

                            <td>
                                {{ $request->procuring_entity }}
                            </td>

                            <td>
                                {{ $request->description }}
                            </td>

                            <td>
                                {{ $request->procurement_method }}
                            </td>

                            <td>

                                @if ($request->status == 'Pending')

                                    <span class="status pending">
                                        Pending
                                    </span>

                                @elseif ($request->status == 'Under Evaluation')

                                    <span class="status evaluation">
                                        Under Evaluation
                                    </span>

                                @elseif ($request->status == 'Approved')

                                    <span class="status approved">
                                        Approved
                                    </span>

                                @elseif ($request->status == 'Rejected')

                                    <span class="status rejected">
                                        Rejected
                                    </span>

                                @else

                                    {{ $request->status }}

                                @endif

                            </td>

                            <td>
                                {{ $request->date_submitted }}
                            </td>

                            <td style="padding: 12px;">

    {{-- View --}}
    <a href="{{ route('procurement-requests.show', $request) }}"
       style="color: #2563eb; text-decoration: none; margin-right: 8px;">
        View
    </a>

    {{-- Admin Actions --}}
    @if(Auth::user()->role === 'Admin')

        <a href="{{ route('procurement-requests.edit', $request) }}"
           style="color: #f59e0b; text-decoration: none; margin-right: 8px;">
            Edit
        </a>

        <form action="{{ route('procurement-requests.destroy', $request) }}"
              method="POST"
              style="display: inline;">
            @csrf
            @method('DELETE')

            <button type="submit"
                    onclick="return confirm('Are you sure you want to delete this request?')"
                    style="color: #dc2626; background: none; border: none; cursor: pointer; padding: 0;">
                Delete
            </button>
        </form>

    @endif

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">
                                No procurement requests found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>
            <div style="margin-top: 20px;">
    {{ $requests->withQueryString()->links() }}
</div>

        </div>

    </div>

</body>
</html>