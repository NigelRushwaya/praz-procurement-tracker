<!DOCTYPE html>
<html>
<head>
    <title>Add Procurement Request</title>

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
        }

        .navbar h2 {
            margin: 0;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .form-card h1 {
            margin-top: 0;
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
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #0d6efd;
        }

        .required {
            color: #dc3545;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            margin-top: 25px;
        }

        .save-button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-button {
            margin-left: 10px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>PRAZ Procurement Tracker</h2>
    </div>

    <div class="container">

        <div class="form-card">

            <h1>Add Procurement Request</h1>

            <p>
                Enter the details of the procurement request below.
            </p>

            <form method="POST"
                  action="{{ url('/procurement-requests') }}">

                @csrf

                <div class="form-group">

                    <label>
                        Request Number <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="request_number"
                        value="{{ old('request_number') }}"
                        placeholder="e.g. PR001"
                    >

                    @error('request_number')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Procuring Entity <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="procuring_entity"
                        value="{{ old('procuring_entity') }}"
                        placeholder="Enter procuring entity"
                    >

                    @error('procuring_entity')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Description <span class="required">*</span>
                    </label>

                    <textarea
                        name="description"
                        placeholder="Describe the procurement request..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Procurement Method <span class="required">*</span>
                    </label>

                    <select name="procurement_method">

                        <option value="">Select procurement method</option>

                        <option value="RFQ"
                            {{ old('procurement_method') == 'RFQ' ? 'selected' : '' }}>
                            RFQ
                        </option>

                        <option value="Open Tender"
                            {{ old('procurement_method') == 'Open Tender' ? 'selected' : '' }}>
                            Open Tender
                        </option>

                        <option value="Restricted Tender"
                            {{ old('procurement_method') == 'Restricted Tender' ? 'selected' : '' }}>
                            Restricted Tender
                        </option>

                    </select>

                    @error('procurement_method')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Date Submitted <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="date_submitted"
                        value="{{ old('date_submitted') }}"
                    >

                    @error('date_submitted')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="buttons">

                    <button type="submit" class="save-button">
                        Save Request
                    </button>

                    <a href="{{ url('/') }}" class="back-button">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>