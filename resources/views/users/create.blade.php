<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add User - PRAZ Procurement Tracker</title>

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
            max-width: 700px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            color: #1f2937;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .required {
            color: #dc2626;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 11px 18px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .save-button {
            background-color: #198754;
            color: white;
        }

        .cancel-button {
            background-color: #6b7280;
            color: white;
        }

        .errors {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px 18px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
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

        <div class="card">

            <h1>Add User</h1>

            <p class="subtitle">
                Create a new system user and assign their role.
            </p>

            @if ($errors->any())

                <div class="errors">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>
                        Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter user's full name"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Email <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter user's email"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Role <span class="required">*</span>
                    </label>

                    <select name="role" required>

                        <option value="">Select role</option>

                        <option value="Staff"
                            {{ old('role') == 'Staff' ? 'selected' : '' }}>
                            Staff
                        </option>

                        <option value="Admin"
                            {{ old('role') == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                    </select>

                </div>

                <div class="buttons">

                    <button type="submit" class="button save-button">
                        Create User
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="button cancel-button">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>