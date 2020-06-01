@extends('layouts.dashboard_page')

@section('active-sales', 1)


@section('tab-content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h2>Sales</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Sunday </td>
                    <td>15339</td>
                </tr>
                <tr>
                    <td> Monday </td>
                    <td>21345</td>
                </tr>
                <tr>
                    <td> Tuesday </td>
                    <td>18483</td>
                </tr>
                <tr>
                    <td> Wednesday </td>
                    <td>24003</td>
                </tr>
                <tr>
                    <td> Thursday </td>
                    <td>23489</td>
                </tr>
                <tr>
                    <td> Friday </td>
                    <td>24092</td>
                </tr>
                <tr>
                    <td> Saturday </td>
                    <td>12034</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection