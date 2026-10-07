<!DOCTYPE html>
<html>
<head>
    <title>Edit Procurement Request</title>

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

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .required {
            color: #dc3545;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            background-color: white;
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
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1);
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            margin-top: 30px;
            display: flex;
            align-items: center;
        }

        .update-button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .update-button:hover {
            background-color: #0b5ed7;
        }

        .cancel-button {
            margin-left: 12px;
            padding: 10px 18px;
            text-decoration: none;
            color: #555;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: white;
        }

        .cancel-button:hover {
            background-color: #f1f1f1;
        }

        .request-info {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 12px 15px;
            margin-bottom: 25px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>PRAZ Procurement Tracker</h2>
    </div>


    <div class="container">

        <div class="form-card">

            <h1>Edit Procurement Request</h1>

            <p class="subtitle">
                Update the details of this procurement request.
            </p>


            <div class="request-info">
                Editing Request:
                <strong>{{ $procurementRequest->request_number }}</strong>
            </div>


            <form method="POST"
                  action="{{ route('procurement-requests.update', $procurementRequest) }}">

                @csrf
                @method('PUT')


                <div class="form-group">

                    <label>
                        Request Number <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="request_number"
                        value="{{ old('request_number', $procurementRequest->request_number) }}"
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
                        value="{{ old('procuring_entity', $procurementRequest->procuring_entity) }}"
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
                    >{{ old('description', $procurementRequest->description) }}</textarea>

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
                            {{ old('procurement_method', $procurementRequest->procurement_method) == 'RFQ' ? 'selected' : '' }}>
                            RFQ
                        </option>

                        <option value="Open Tender"
                            {{ old('procurement_method', $procurementRequest->procurement_method) == 'Open Tender' ? 'selected' : '' }}>
                            Open Tender
                        </option>

                        <option value="Restricted Tender"
                            {{ old('procurement_method', $procurementRequest->procurement_method) == 'Restricted Tender' ? 'selected' : '' }}>
                            Restricted Tender
                        </option>

                    </select>

                    @error('procurement_method')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Status <span class="required">*</span>
                    </label>

                    <select name="status">

                        <option value="Pending"
                            {{ old('status', $procurementRequest->status) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Under Evaluation"
                            {{ old('status', $procurementRequest->status) == 'Under Evaluation' ? 'selected' : '' }}>
                            Under Evaluation
                        </option>

                        <option value="Approved"
                            {{ old('status', $procurementRequest->status) == 'Approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="Rejected"
                            {{ old('status', $procurementRequest->status) == 'Rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>

                    @error('status')
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
                        value="{{ old('date_submitted', $procurementRequest->date_submitted) }}"
                    >

                    @error('date_submitted')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="buttons">

                    <button type="submit" class="update-button">
                        Update Request
                    </button>

                    <a href="{{ url('/') }}" class="cancel-button">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>