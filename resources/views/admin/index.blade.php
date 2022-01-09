@extends('admin.layouts.main')
@section('title', 'Панель администратора')
@section('content')

    <div class="card-group g-3">
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Города</div>
            <div class="card-body">
            <h5 class="card-title">Всего городов: 32</h5>
            <p class="card-text">Последний добавленный город: Самарканд</p>
            </div>
        </div>
        
        <div class="card text-dark bg-light mb-3 mx-3" style="max-width: 18rem;">
            <div class="card-header">Вилояты</div>
            <div class="card-body">
            <h5 class="card-title">Всего вилоятов: 12</h5>
            <p class="card-text">Последний добавленный вилоят: Самаркандская область</p>
            </div>
        </div>
    </div>
      
@endsection