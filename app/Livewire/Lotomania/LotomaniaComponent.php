<?php

namespace App\Livewire\Lotomania;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LotomaniaComponent extends Component
{

    public array $sorteio = [];
    public array $dezenas = [];
    public array $marcados = [];
    public array $matriz = [];
    public int $colunas = 10;
    public int $linhas = 10;
    public bool $editandoColunas = true; // define se o usuário está controlando colunas ou linhas

    public int $concurso = 0; // Concurso atual
    public string $dataConcurso = '';

    public array $premiacoes = [];
    public bool $acumulado = false;
    public float $valorEstimado = 0;

    public function mount()
    {
        $this->gerarDezenas();
        $this->carregarUltimoConcurso();
    }



    public function updatedColunas()
    {
        $this->editandoColunas = true;

        if (100 % $this->colunas === 0) {
            $this->linhas = 100 / $this->colunas;
        } else {
            $this->addError('colunas', 'O número de colunas deve dividir 100 igualmente.');
        }
    }

    public function updatedLinhas()
    {
        $this->editandoColunas = false;

        if (100 % $this->linhas === 0) {
            $this->colunas = 100 / $this->linhas;
        } else {
            $this->addError('linhas', 'O número de linhas deve dividir 100 igualmente.');
        }
    }

    public function atualizarGrid()
    {
        $total = 100;
    
        if ($this->editandoColunas) {
            if ($this->colunas > 0 && 100 % $this->colunas === 0) {
                $this->linhas = 100 / $this->colunas;
            } else {
                $this->addError('colunas', 'O número de colunas deve dividir 100 exatamente.');
            }
        } else {
            if ($this->linhas > 0 && 100 % $this->linhas === 0) {
                $this->colunas = 100 / $this->linhas;
            } else {
                $this->addError('linhas', 'O número de linhas deve dividir 100 exatamente.');
            }
        }
    }
    public function carregarUltimoConcurso()
    {
        $response = Http::get('https://loteriascaixa-api.herokuapp.com/api/lotomania/latest');
    
        if ($response->successful()) {
            $dados = $response->json();
    
            $this->concurso = $dados['concurso'];
            $this->dataConcurso = $dados['data'];
            $this->sorteio = array_map('intval', $dados['dezenas']);
            $this->premiacoes = $dados['premiacoes'] ?? [];
            $this->acumulado = $dados['acumulou'] ?? false;
            $this->valorEstimado = $dados['valorEstimadoProximoConcurso'] ?? 0;
        }
    }
    public function carregarUltimoConcursoo()
    {
        $response = Http::get('https://loteriascaixa-api.herokuapp.com/api/lotomania/latest');

        if ($response->successful()) {
            $dados = $response->json();
            $this->concurso = $dados['concurso'];
            $this->dataConcurso = $dados['data'];
            $this->sorteio = array_map('intval', $dados['dezenas']);
        }
    }

    public function carregarConcurso($numero)
    {
        $response = Http::get("https://loteriascaixa-api.herokuapp.com/api/lotomania/{$numero}");

        if ($response->successful()) {
            $dados = $response->json();
            $this->concurso = $dados['concurso'];
            $this->dataConcurso = $dados['data'];
            $this->sorteio = array_map('intval', $dados['dezenas']);
            $this->marcados = []; // Zera os marcados ao trocar
        }
    }

    public function concursoAnterior()
    {
        $this->carregarConcurso($this->concurso - 1);
    }

    public function concursoProximo()
    {
        $this->carregarConcurso($this->concurso + 1);
    }

    public function gerarDezenass()
    {
        $this->dezenas = range(0, 99);
    }

    public function gerarDezenas()
    {
        $this->dezenas = [];
        for ($i = 1; $i < 101; $i++) {
            $this->dezenas[] = $i;
        }
    }

    public function toggleDezena($dezena)
    {
        if (in_array($dezena, $this->marcados)) {
            $this->marcados = array_diff($this->marcados, [$dezena]);
        } elseif (count($this->marcados) < 50) {
            $this->marcados[] = $dezena;
        }
    }

    
    public function render()
    {
        return view('livewire.lotomania.lotomania-component');
    }

    public function getResumoLinhasProperty()
    {
        $resumo = [
            0 => 0,
            1 => 0,
            3 => 0,
            '>3' => 0,
        ];
    
        foreach ($this->matriz as $linha) {
            $marcacoes = collect($linha)->filter()->count();
    
            if ($marcacoes === 0) {
                $resumo[0]++;
            } elseif ($marcacoes === 1) {
                $resumo[1]++;
            } elseif ($marcacoes === 3) {
                $resumo[3]++;
            } elseif ($marcacoes > 3) {
                $resumo['>3']++;
            }
        }
    
        return $resumo;
    }
    
    public function getResumoColunasProperty()
    {
        $resumo = [
            0 => 0,
            1 => 0,
            2 => 0,
            '>4' => 0,
        ];

        if (empty($this->matriz)) {
            return $resumo;
        }

        $totalColunas = count($this->matriz[0]);

        for ($col = 0; $col < $totalColunas; $col++) {
            $marcacoes = 0;

            foreach ($this->matriz as $linha) {
                if (!empty($linha[$col])) {
                    $marcacoes++;
                }
            }

            if ($marcacoes === 0) {
                $resumo[0]++;
            } elseif ($marcacoes === 1) {
                $resumo[1]++;
            } elseif ($marcacoes === 2) {
                $resumo[2]++;
            } elseif ($marcacoes > 4) {
                $resumo['>4']++;
            }
        }

        return $resumo;
    }

    


}
