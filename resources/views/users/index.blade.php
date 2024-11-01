@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Lista de Tarefas</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('users_store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 mt-2">
                                <button type="submit" class="btn btn-outline-success m-1">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4 border rounded-1">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">ID</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nome</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">E-mail</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <p class="mb-0 fw-normal fs-4">{{ $user->id }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal fs-4">{{ $user->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal fs-4">{{ $user->email }}</p>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
