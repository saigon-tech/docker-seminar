@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!empty($top))
                        <h6>Top 10</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Postal Code</th>
                                <th scope="col">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top as $index => $postalCode)
                                    <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $postalCode['postal_code'] }}</td>
                                    <td>{{ $postalCode['pc_count'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
