@extends('layouts.app')

@section('title', 'Contratados')

@section('content')
    <h2 class="mb-4">Empregados</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Adicionar Novo Empregado</button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Carga Horária diária</th>
                <th>Custo Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->role->name }}</td>
                    <td>{{ $employee->daily_hours }} Horas</td>
                    <td>R${{ $employee->hourly_cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Adding Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addEmployee') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeLabel">Adicionar Empregado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="daily_hours" class="form-label">Horas Diárias</label>
                            <input type="number" name="daily_hours" id="daily_hours" class="form-control" step="0.1" min="0" max="24" required>
                        </div>
                        <div class="mb-3">
                            <label for="hourly_cost" class="form-label">Custo por Hora (R$)</label>
                            <input type="number" name="hourly_cost" id="hourly_cost" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Atribuição</label>
                            <select name="role_id" id="role_id" class="form-select" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection