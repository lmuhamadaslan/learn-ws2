@extends('layouts.app')

@section('content')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- {{ __('You are logged in!') }} --}}
                        <table id="table-student">
                            <tr>
                                <th>Name</th>
                                <th>NIM</th>
                                <th>Department</th>
                            </tr>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['department'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        Pusher.logToConsole = true;

        const key = '{{ env('PUSHER_APP_KEY') }}';
        const cluster = '{{ env('PUSHER_APP_CLUSTER') }}';

        @if (Auth::check())
            const pusher = new Pusher(key, {
                cluster: cluster,
                authEndpoint: '/pusher/auth',
                auth: {
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    }
                }
            });

            var channel = pusher.subscribe('private-add-student.{{ auth()->user()->id }}');
            channel.bind('add-student-event', function(data) {
                alert('New student added!')
                // $('table').append(`
            //     <tr>
            //         <td>${data.name}</td>
            //         <td>${data.nim}</td>
            //         <td>${data.department}</td>
            //     </tr>
            // `);
                document.getElementById('table-student').innerHTML +=
                    `
                <tr>
                    <td>${data.name}</td>
                    <td>${data.nim}</td>
                    <td>${data.department}</td>
                </tr>
            `;
            });
        @endif
    </script>
@endsection
