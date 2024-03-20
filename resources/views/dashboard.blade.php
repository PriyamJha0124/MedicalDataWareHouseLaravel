<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title text-center">Data on COVID-19 vaccination in the EU/EEA</h3>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-lg-3 col-12 mb-3">
                                <select name="month" id="" class="form-select">
                                    {!! getMonthDropdown(request()->month) !!}
                                </select>
                            </div>
                            <div class="col-lg-3 col-12 mb-3">
                                <select name="country" id="" class="form-select">
                                    {!! getCountryDropdown(request()->country) !!}
                                </select>
                            </div>
                            <div class="col-lg-3 col-12 mb-3">
                                <select name="group" id="" class="form-select">
                                    {!! getTargetGroupDropdown(request()->group) !!}
                                </select>
                            </div>
                            <div class="col-lg-3 col-12 mb-3">
                                <select name="vaccine" id="" class="form-select">
                                    {!! getVaccineDropdown(request()->vaccine) !!}
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Total record : <span class="badge bg-success">{{$total}}</span></h4>
                                    <a id="downloadBtn" class="btn btn-primary downlaod" href="{{ route('report') }}"><i class="fas fa-download fa-fw"></i>Download Report</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table text-center table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>YearWeekISO</th>
                                    <th>ReportingCountry</th>
                                    <th>Denominator</th>
                                    <th>NumberOfIndivOneDose</th>
                                    <th>Region</th>
                                    <th>TargetGroup</th>
                                    <th>Vaccine</th>
                                    <th>Population</th>
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
                                <tr>
                                    <td colspan="8" class="text-center">No record found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$vaccinations->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function (){
        $('select').on('change',function (){
           $('form').submit();
        });
    });
</script>
<script>
    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);
        var params = urlParams.toString();
        var downloadLink = document.getElementById('downloadBtn').getAttribute('href');

        if (params !== '') {
            downloadLink += '?' + params;
        }

        document.getElementById('downloadBtn').setAttribute('href', downloadLink);
    };
</script>
</body>
</html>
