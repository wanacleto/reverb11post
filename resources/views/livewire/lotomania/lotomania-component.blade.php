<div class="container py-3">
    <h5 class="mb-2">Distribuição das Dezenas</h5>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <button wire:click="concursoAnterior" class="btn btn-sm btn-outline-secondary me-2">&laquo; Anterior</button>
            <button wire:click="concursoProximo" class="btn btn-sm btn-outline-secondary">Próximo &raquo;</button>
        </div>

        <div>
            Concurso <strong>{{ $concurso }}</strong> – <span class="text-muted">{{ $dataConcurso }}</span>
        </div>

        <div class="text-end">
            <label for="colunas" class="form-label mb-0">Colunas:</label>
            <input type="number" wire:model.live="colunas" min="1" max="100" class="form-control form-control-sm d-inline-block w-auto ms-2" />
            @if ($errors->has('colunas'))
                <div class="text-danger small">{{ $errors->first('colunas') }}</div>
            @endif
      
            <label for="linhas" class="form-label mb-0 ms-3">Linhas:</label>
            <input type="number" wire:model.live="linhas" min="1" max="100" class="form-control form-control-sm d-inline-block w-auto ms-2" />
            @if ($errors->has('linhas'))
                <div class="text-danger small">{{ $errors->first('linhas') }}</div>
            @endif
            <button wire:click="atualizarGrid" class="btn btn-sm btn-primary ms-3">
                Atualizar grade
            </button>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-start" style="gap: 0.5rem;">
        @foreach ($dezenas as $dezena)
            @php
                $dezInt = (int) $dezena;
                $isSorteada = in_array($dezInt, $sorteio);
                $isMarcada = in_array($dezInt, $marcados);
                $cor = 'btn-outline-secondary';
    
                if ($isSorteada && $isMarcada) $cor = 'btn-warning';
                elseif ($isSorteada) $cor = 'btn-primary';
                elseif ($isMarcada) $cor = 'btn-secondary';
            @endphp
    
            <div style="flex: 0 0 calc(100% / {{ $colunas }} - 0.5rem); max-width: calc(100% / {{ $colunas }} - 0.5rem);">
                <button class="btn {{ $cor }} rounded-circle w-100"
                        style="height: 42px;"
                        wire:click="toggleDezena({{ $dezInt }})">
                    {{ str_pad($dezena, 2, '0', STR_PAD_LEFT) }}
                </button>
            </div>
        @endforeach
    </div>
    


    <div class="mt-4">
        <span class="badge bg-secondary me-2">Marcados: {{ count($marcados) }}</span>
        <span class="badge bg-warning text-dark me-2">Acertos: {{ count(array_intersect($marcados, $sorteio)) }}</span>
        <span class="badge bg-info text-dark">Faltam: {{ 50 - count($marcados) }}</span>
    </div>

    <div class="mt-2 small text-muted">
        * Clique nos números para marcar/desmarcar. <br>
        * Total de 50 dezenas podem ser marcadas.
    </div>

    <div class="mt-4">
        <h6>
            Resultado: 
            @if ($acumulado)
                <span class="badge bg-danger">Acumulado</span>
            @else
                <span class="badge bg-success">Premiado</span>
            @endif
        </h6>
        <p class="mb-1">
            <strong>Estimativa próximo concurso:</strong>
            R$ {{ number_format($valorEstimado, 2, ',', '.') }}
        </p>
    
        <table class="table table-bordered table-sm table-striped mt-2">
            <thead class="table-light">
                <tr>
                    <th>Acertos</th>
                    <th>Ganhadores</th>
                    <th>Prêmio (R$)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($premiacoes as $premio)
                    <tr>
                        <td>{{ $premio['descricao'] }}</td>
                        <td>{{ $premio['ganhadores'] }}</td>
                        <td>{{ number_format($premio['valorPremio'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    




</div>
