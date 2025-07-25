<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User Frontier PDF</title>
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
    <h2>User Frontier Report</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">S.No</th>
                <th style="width: 80px;">Date</th>
                <th style="width: 100px;">First Name</th>
                <th style="width: 100px;">Last Name</th>
                <th style="width: 80px;">Corp ID</th>
                <th style="width: 150px;">Address</th>
                <th style="width: 80px;">Billing TN</th>
                <th style="width: 80px;">Order Number</th>
                <th style="width: 100px;">Install T.T. Soc TTC</th>
                <th style="width: 80px;">ONT NTD</th>
                <th style="width: 80px;">Comp/Refer</th>
                <th style="width: 80px;">Billing Code</th>
                <th style="width: 40px;">Qty</th>
                <th style="width: 200px;">Description</th>
                <th style="width: 60px;">Rate</th>
                <th style="width: 80px;">Total Billed</th>
                <th style="width: 60px;">Aerial Buried</th>
                <th style="width: 60px;">Fiber</th>
                <th style="width: 200px;">Closeout Notes</th>
                <th style="width: 40px;">In</th>
                <th style="width: 40px;">Out</th>
                <th style="width: 40px;">Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminfrontire as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->created_at ? $data->created_at->format('m/d/Y') : '' }}</td>
                <td>{{ $data->user->name ?? 'N/A' }}</td>
                <td>{{ $data->user->last_name ?? 'N/A' }}</td>
                <td>{{ $data->corp_id }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->billing_TN }}</td>
                <td>{{ $data->order_number }}</td>
                <td>{{ $data->install_T_T_Soc_TTC }}</td>
                <td>{{ $data->ont_Ntd }}</td>
                <td>{{ $data->comp_or_refer }}</td>
                <td>{{ $data->billing_code }}</td>
                <td>{{ $data->qty }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->rate }}</td>
                <td>{{ $data->total_billed }}</td>
                <td>{{ $data->aerial_buried }}</td>
                <td>{{ $data->fiber }}</td>
                <td>{{ $data->closeout_notes }}</td>
                <td>{{ $data->in }}</td>
                <td>{{ $data->out }}</td>
                <td>{{ $data->hours }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
