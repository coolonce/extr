@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Админ панель</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Добро пожаловать!</h2>
                    <h3>В админ панель для работы с базой данных</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
