<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management - PRAZ Procurement Tracker</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .navbar {
            background-color: #1f2937;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .user-info {
            text-align: right;
        }

        .user-info strong {
            display: block;
        }

        .user-info small {
            color: #cbd5e1;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #1f2937;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .add-button {
            background-color: #198754;
            color: white;
        }

        .back-button {
            background-color: #6b7280;
            color: white;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1f2937;
            color: white;
            text-align: left;
            padding: 13px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .role {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .admin {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .staff {
            background-color: #dcfce7;
            color: #15803d;
        }

        .edit {
            color: #d97706;
            text-decoration: none;
            margin-right: 8px;
        }

        .delete {
            color: #dc2626;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 14px;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>PRAZ Procurement Tracker</h2>

        <div class="user-info">
            <strong>{{ Auth::user()->name }}</strong>
            <small>{{ Auth::user()->role }}</small>
        </div>

    </div>

    <div class="container">

        <div class="header">

            <div>
                <h1>User Management</h1>
                <p>Manage system users and their roles.</p>
            </div>

            <div>
                <a href="{{ url('/') }}" class="button back-button">
                    Back to Dashboard
                </a>

               <a href="{{ route('users.create') }}" class="button add-button">
    Add User
</a>
            </div>

        </div>

        <div class="card">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>

                                @if($user->role === 'Admin')

                                    <span class="role admin">
                                        Admin
                                    </span>

                                @else

                                    <span class="role staff">
                                        Staff
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td>

                               <a href="{{ route('users.edit', $user) }}" class="edit">
    Edit
</a>

                                <form action="{{ route('users.destroy', $user) }}"
      method="POST"
      style="display: inline;">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="delete"
            onclick="return confirm('Are you sure you want to delete this user?')">
        Delete
    </button>

</form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" style="text-align:center;">
                                No users found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="pagination">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</body>
</html>