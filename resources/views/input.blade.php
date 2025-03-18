<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Inserir Dados - AgroSystem</title>
</head>
<body>
    <h1>Inserir Dados da Fazenda</h1>
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
      @csrf
        <div>
            <label>Arquivo KML da Área de Plantio:</label>
            <input type="file" name="kml_file" accept=".kml">
            @error('kml_file') <span class="error">{{ $message }}</span> @enderror
        </div>
        <!-- Other fields remain unchanged -->
        <div>
            <label>Custo Total de Mão de Obra (R$):</label>
            <input type="number" name="total_labor_cost" step="0.01" required>
            @error('total_labor_cost') <span class="error">{{ $message }}</span> @enderror
        </div>
        <!-- Yield fields -->
        <div>
            <label>Rendimento em Litros:</label>
            <input type="number" name="yield_liters" step="0.01" required>
            @error('yield_liters') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Rendimento em Sacas:</label>
            <input type="number" name="yield_sacas" step="0.01" required>
            @error('yield_sacas') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Preço de Venda por Saca (R$):</label>
            <input type="number" name="selling_price" step="0.01" required>
            @error('selling_price') <span class="error">{{ $message }}</span> @enderror
        </div>
        <h2>Itens de CAPEX</h2>
        @for ($i = 0; $i < 3; $i++)
            <div>
                <label>Descrição:</label>
                <input type="text" name="capex[{{$i}}][description]">
                <label>Custo (R$):</label>
                <input type="number" name="capex[{{$i}}][cost]" step="0.01">
            </div>
        @endfor
        <h2>Itens de Fertilizantes</h2>
        @for ($i = 0; $i < 3; $i++)
            <div>
                <label>Descrição:</label>
                <input type="text" name="fertilizer[{{$i}}][description]">
                <label>Custo (R$):</label>
                <input type="number" name="fertilizer[{{$i}}][cost]" step="0.01">
            </div>
        @endfor
        <button type="submit">Enviar</button>
    </form>
</body>
</html>