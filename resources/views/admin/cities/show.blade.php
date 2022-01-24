@extends('admin.layouts.main')
@section('title', $city->translate('title', 'ru'))
@section('content')

    <div class="row">
        <div class="col-12">
            <a href="{{ route('shahars.show', $city) }}">{{ route('shahars.show', $city) }}</a>
        </div>
    </div>

    <h3>Подробности</h3>

    <table class="table table-hover table-sm">
        <tr>
            <td><strong>Название на узбекском(латиница)</strong></td>
            <td>{{ $city->translate('title', 'uz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на узбекском(кириллица)</strong></td>
            <td>{{ $city->translate('title', 'oz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на английском</strong></td>
            <td>{{ $city->translate('title', 'en') }}</td>
        </tr>
        <tr>
            <td><strong>Название на русском</strong></td>
            <td>{{ $city->translate('title', 'ru') }}</td>
        </tr>
        <tr>
            <td><strong>Добавлен</strong></td>
            <td>{{ $city->created_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
        <tr>
            <td><strong>Последнее изменение</strong></td>
            <td>{{ $city->updated_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
    </table>

    <h3>Время ({{ $city->generated_times->count() }})</h3>
    <a href="{{ route('admin.shahars.time.create', $city) }}" class="btn btn-sm btn-primary">Добавить время</a>
    
    <table class="table table-hover table-sm table-responsive">
        <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Qamar(Месяц)</th>
                <th scope="col">Bomdod</th>
                <th scope="col">Quyosh</th>
                <th scope="col">Peshin</th>
                <th scope="col">Asr</th>
                <th scope="col">Shom</th>
                <th scope="col">Xufton</th>
                <th scope="col">Добавлен(Изменен)</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($city->generated_times as $time)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $time->created_at->format('d-m-Y')}} ({{$time->updated_at->format('d-m-Y')}})</td>
                    <td>
                        <a href="{{route('admin.shahars.show', $time)}}" class="btn btn-sm btn-info">Смотреть</a>
                        <a href="{{route('admin.shahars.edit', $time)}}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{route('admin.shahars.destroy', $time)}}" method="post" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <p class="my-1">
                    Время для этого города еще не добавлено
                </p>
            @endforelse
        </tbody>
    </table>

@endsection
