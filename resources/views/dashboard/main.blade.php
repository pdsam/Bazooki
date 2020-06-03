@extends('layouts.dashboard_page')

@section('active-sales', 1)


@section('tab-content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h2>Sales</h2>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Hour</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody id="profitTable">
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/dashboard_chart.js') }}"></script>
@endsection
