@extends('layouts.layout')

@section('content')
    <div class="table-responsive">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <table class="table table-bordered table-hover text-nowrap"
               style="line-height: 18px;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Последняя проверка</th>
                <th>Код ответа</th>
            </tr>
            </thead>
            <tbody>
            @foreach($urls as $url)
                <tr>
                    <td>{{$url->id}}</td>
                    <td><a href="{{ route('urls.show', $url->id) }}">{{$url->name}}</a></td>
                    @if(array_key_exists($url->id, $checksUrl))
                    @php($checkUrl = $checksUrl[$url->id])
                    <td>{{$checkUrl->created_at}}</td>
                    <td>{{$checkUrl->status_code}}</td>
                    @else
                    <td></td>
                    <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $urls->links() }}
    </div>
@endsection
