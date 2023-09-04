@extends('admin_layout/index')
@section('content')

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Guests</th>
        <th scope="col">Address</th>
        <th scope="col">Apt</th>
        <th scope="col">Event Date</th>
        <th scope="col">Description</th>
      </tr>
    </thead>
    <tbody>
        <?php
        // dd($registerusers[0]->event_dates);
        $count = 1; ?>
        @foreach($registerusers as $users)
        <?php $geusts = json_decode($users->guests);  ?>
      <tr>
        <th scope="row">{{ $count++ }}</th>
        <td>{{ $users->first_name ?? '' }} {{ $users->last_name ?? '' }}</td>
        <td>{{ $users->email ?? ''}}</td>
        <td>{{ $users->mobile_number ?? '' }}</td>
        <td>@foreach($geusts as $g) {{ $g }}, @endforeach</td>
        <td>{{ $users->address ?? '' }}</td>
        <td>{{ $users->apt ?? '' }}</td>
        <td>{{ $users->event_dates['start_date'] ?? '' }}</td>
        <td>{{ $users->note ?? ''}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  

@endsection