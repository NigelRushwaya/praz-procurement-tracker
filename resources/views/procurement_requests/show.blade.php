<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Procurement Request Details</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #17212b;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 21px;
        }

        .navbar span {
            font-size: 14px;
            color: #cbd5e1;
        }

        /* Main container */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;
            color: #17212b;
        }

        .page-header p {
            color: #6b7280;
            margin-top: 6px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #17212b;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Information grid */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .detail-item {
            background-color: #f8fafc;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .detail-label {
            display: block;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .detail-value {
            font-size: 16px;
            color: #17212b;
        }

        /* Description */
        .description {
            background-color: #f8fafc;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            line-height: 1.6;
            margin-top: 20px;
        }

        .description strong {
            display: block;
            margin-bottom: 8px;
            color: #6b7280;
            font-size: 13px;
        }

        /* Status */
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .evaluation {
            background-color: #cff4fc;
            color: #055160;
        }

        .approved {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .rejected {
            background-color: #f8d7da;
            color: #842029;
        }

        /* Buttons */
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .button {
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .edit-button {
            background-color: #17212b;
            color: white;
        }

        .back-button {
            background-color: #e5e7eb;
            color: #374151;
        }

        .edit-button:hover {
            background-color: #263746;
        }

        .back-button:hover {
            background-color: #d1d5db;
        }

        /* Mobile */
        @media (max-width: 700px) {
            .navbar {
                padding: 15px 20px;
            }

            .container {
                margin-top: 25px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <h2>PRAZ Procurement Tracker</h2>
        <span>Procurement Management System</span>
    </div>

    <!-- Main content -->
    <div class="container">

        <div class="page-header">
            <div>
                <h1>Procurement Request Details</h1>
                <p>View complete information about this procurement request.</p>
            </div>
        </div>

        <!-- Request Information -->
        <div class="card">

            <div class="card-title">
                Request Information
            </div>

            <div class="details-grid">

                <div class="detail-item">
                    <span class="detail-label">Request Number</span>

                    <div class="detail-value">
                        {{ $procurementRequest->request_number }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Procuring Entity</span>

                    <div class="detail-value">
                        {{ $procurementRequest->procuring_entity }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Procurement Method</span>

                    <div class="detail-value">
                        {{ $procurementRequest->procurement_method }}
                    </div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Status</span>

                    <div class="detail-value">

                        @if ($procurementRequest->status == 'Pending')
                            <span class="status pending">
                                Pending
                            </span>

                        @elseif ($procurementRequest->status == 'Under Evaluation')
                            <span class="status evaluation">
                                Under Evaluation
                            </span>

                        @elseif ($procurementRequest->status == 'Approved')
                            <span class="status approved">
                                Approved
                            </span>

                        @elseif ($procurementRequest->status == 'Rejected')
                            <span class="status rejected">
                                Rejected
                            </span>

                        @else
                            {{ $procurementRequest->status }}
                        @endif

                    </div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Date Submitted</span>

                    <div class="detail-value">
                        {{ $procurementRequest->date_submitted }}
                    </div>
                </div>

            </div>

            <!-- Description -->
            <div class="description">

                <strong>Description</strong>

                {{ $procurementRequest->description }}

            </div>

            <!-- Actions -->
            <div class="actions">

                <a href="{{ route('procurement-requests.edit', $procurementRequest) }}"
                   class="button edit-button">
                    Edit Request
                </a>

                <a href="{{ url('/') }}"
                   class="button back-button">
                    Back to Dashboard
                </a>

            </div>

        </div>

    </div>

</body>
</html>