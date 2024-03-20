<html>
<head>
    <style>
        table {
            width: 100%;
            border: 0;
        }

        table.table td {
            border-color: #dee2e6 !important;
            padding: 10px !important;
            vertical-align: middle;
            border-top: 1px solid;
            text-align: center;
        }

        table.table tr:last-child td {
            border-bottom: 1px solid;
        }

        table {
            margin: 0 !important;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;

        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        table {
            font-size: 12px;
        }

        .table td, .table th {
            white-space: nowrap;
            /*overflow-wrap: anywhere;*/
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
    <body>
    <h1 style="text-align: center">Data on COVID-19 vaccination in the EU/EEA</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>YearWeekISO</th>
            <th scope="col">ReportingCountry</th>
            <th scope="col">Denominator</th>
            <th scope="col">NumberOfIndivOneDose</th>
            <th scope="col">Region</th>
            <th scope="col">TargetGroup</th>
            <th scope="col">Vaccine</th>
            <th scope="col">Population</th>
        </tr>
        </thead>
        <tbody>
            @forelse($vaccinations as $data)
                <tr>
                    <td>{{$data->YearWeekISO ?? 'N/A'}}</td>
                    <td>{{$data->ReportingCountry ?? 'N/A'}}</td>
                    <td>{{$data->Denominator ?? 'N/A'}}</td>
                    <td>{{$data->NumberOfIndivOneDose}}</td>
                    <td>{{$data->Region ?? 'N/A'}}</td>
                    <td>{{$data->TargetGroup ?? 'N/A'}}</td>
                    <td>{{$data->Vaccine ?? 'N/A'}}</td>
                    <td>{{$data->Population ? number_format($data->Population) : 'N/A'}}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    </body>
</html>
