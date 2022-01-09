@extends('admin.layouts.main')
@section('title', 'Список вилоятов')
@section('content')
    <a href="{{route('admin.viloyats.create')}}" class="btn btn-sm btn-primary mb-1">Добавить вилоят</a>
    @if ($regions->count() < 1)
        <p class="my-1">
            Ни один вилоят еще не добавлен
        </p>
    @else
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Вилоят</th>
                    <th scope="col">Ссылка</th>
                    <th scope="col">Добавлен(Изменен)</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>

                @for ($i = 1; $i < 10; $i++)
                    <tr>
                        <td scope="row">{{$i}}</td>
                        <td>Самаркандская область</td>
                        <td><a href="https://namozvaqti.uz/viloyat/samarqand">https://namozvaqti.uz/viloyat/samarqand</a></td>
                        <td>22-01-2022 (23-01-2022)</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Смотреть</a>
                            <a href="{{route('admin.viloyats.edit', $i)}}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{route('admin.viloyats.destroy', $i)}}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                            </form>
                        </td>
                    </tr>    
                @endfor

            </tbody>
        </table>
    @endif

@endsection
