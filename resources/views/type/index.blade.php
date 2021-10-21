@extends('layouts.app')


@section('content')
<div class="container">
    <table class="table table-striped">

        <tr>
            <th> @sortablelink('id', 'ID') </th>
            <th> @sortablelink('title', 'Title') </th>
            <th> @sortablelink('description', 'Description') </th>
        </tr>


        @foreach ($types as $type)
        <tr>
            <td>{{$type->id}} </td>
            <td>{{$type->title}} </td>
            <td>{{ $type->description }} </td>
        @endforeach
        </table>

        {!! $types->appends(Request::except('page'))->render() !!}

</div>
@endsection
