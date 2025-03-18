@extends('layouts.app')

@section('title', 'Despesas')

@section('content')
    <h2 class="mb-4">CAPEX / Adubo / Fertilizantes</h2>
    <div class="mb-3">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addExpenseModal">Adicionar Nova Despesa</button>
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Criar Nova Categoria</button>
    </div>

    <h3>Últimas Despesas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Valor (R$)</th>
                <th>Responsável</th>
                <th>Data do Pagamento</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->category->name }}</td>
                    <td>{{ number_format($expense->amount, 2, ',', '.') }}</td>
                    <td>{{ $expense->employee->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') }}</td>
                    <td>{{ $expense->description ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Adding Expense -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addExpense') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExpenseLabel">Adicionar Despesa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Valor (R$)</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Responsável</label>
                            <select name="employee_id" id="employee_id" class="form-select" required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment_date" class="form-label">Data do Pagamento</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="receipt" class="form-label">Recibo (Imagem)</label>
                            <input type="file" name="receipt" id="receipt" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addCategory') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryLabel">Adicionar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection