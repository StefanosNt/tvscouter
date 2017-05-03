@extends('layouts.app')

@section('content')

<style>
  .content {
    padding-left:20px;
  }
</style>

  <h1>Watchlist</h1>

  <table>
    <tbody>
      @foreach($watchlist as $w)
        <tr>
          <td>{{ $w->id }}</td>
          <td>{{ $w->series_id }}</td>
          <td>{{ $w->favorite }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>





@endsection
