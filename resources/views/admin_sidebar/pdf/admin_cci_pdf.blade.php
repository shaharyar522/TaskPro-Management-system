<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User CCI PDF</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>User CCI Report</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">ID</th>
                <th style="width: 150px;">Address</th>
                <th style="width: 80px;">Phone</th>
                <th style="width: 100px;">Master Order</th>
                <th style="width: 150px;">Job Notes</th>
                <th style="width: 100px;">Work Type</th>
                <th style="width: 60px;">Unit</th>
                <th style="width: 40px;">Qty</th>
                <th style="width: 60px;">W2</th>
                <th style="width: 40px;">In</th>
                <th style="width: 40px;">Out</th>
                <th style="width: 40px;">Hours</th>
                <th style="width: 80px;">Created At</th>
                <th style="width: 80px;">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admincci as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->master_order }}</td>
                <td>{{ $data->job_notes }}</td>
                <td>{{ $data->work_type }}</td>
                <td>{{ $data->unit }}</td>
                <td>{{ $data->qty }}</td>
                <td>{{ $data->w2 }}</td>
                <td>{{ $data->in }}</td>
                <td>{{ $data->out }}</td>
                <td>{{ $data->hours }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
