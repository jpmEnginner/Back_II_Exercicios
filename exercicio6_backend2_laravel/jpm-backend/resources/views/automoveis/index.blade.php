@extends('layouts.app')

@section('title', 'Lista de Automóveis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Automóveis</h1>
    <a href="{{ route('automoveis.create') }}" class="btn btn-success">
        ➕ Novo Automóvel
    </a>
</div>

{{-- Mensagens de sucesso --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    @forelse($automoveis as $automovel)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">{{ $automovel->marca }} {{ $automovel->modelo }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Placa:</strong> {{ $automovel->placa }}</p>
                <p><strong>Tipo:</strong> {{ $automovel->tipo }}</p>
                <p><strong>Cor:</strong> {{ $automovel->cor }}</p>
                <p><strong>Ano:</strong> {{ $automovel->ano_fabricacao }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $automovel->status_veiculo == 'DISPONIVEL' ? 'success' : 'danger' }}">
                        {{ $automovel->status_veiculo }}
                    </span>
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex gap-2">
                    <a href="{{ route('automoveis.show', $automovel->id) }}" class="btn btn-primary btn-sm flex-fill">
                        👁️ Ver
                    </a>
                    <a href="{{ route('automoveis.edit', $automovel->id) }}" class="btn btn-warning btn-sm flex-fill">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('automoveis.destroy', $automovel->id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            🗑️ Deletar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">Nenhum automóvel cadastrado.</div>
    </div>
    @endforelse
</div>
@endsection