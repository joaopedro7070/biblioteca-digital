@extends('layouts.app')

@section('title', 'Livros - Biblioteca Digital')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-fill"></i> Livros</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Novo Livro
    </a>
</div>

<!-- Filtros e Busca -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('books.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Buscar</label>
                <input type="text" class="form-control" id="search" name="search" 
                       placeholder="Título ou autor..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Limpar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Modo de Visualização -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">{{ $books->total() }} livro(s) encontrado(s)</p>
    <div class="btn-group" role="group">
        <a href="{{ route('books.index', array_merge(request()->all(), ['view_mode' => 'grid'])) }}" 
           class="btn btn-sm btn-outline-primary {{ $viewMode == 'grid' ? 'active' : '' }}">
            <i class="bi bi-grid-3x3-gap"></i> Grade
        </a>
        <a href="{{ route('books.index', array_merge(request()->all(), ['view_mode' => 'list'])) }}" 
           class="btn btn-sm btn-outline-primary {{ $viewMode == 'list' ? 'active' : '' }}">
            <i class="bi bi-list-ul"></i> Lista
        </a>
    </div>
</div>

@if($books->count() > 0)
    @if($viewMode == 'grid')
        <!-- Visualização em Grade -->
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($books as $book)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center">
                                <i class="bi bi-book text-white" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ $book->author }}</p>
                            <span class="badge bg-primary">{{ $book->category->name }}</span>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Visualização em Lista -->
        <div class="list-group">
            @foreach($books as $book)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded" alt="{{ $book->title }}" style="height: 100px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                    <i class="bi bi-book text-white" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <h5 class="mb-1">{{ $book->title }}</h5>
                            <p class="mb-1 text-muted">{{ $book->author }}</p>
                            <small><span class="badge bg-primary">{{ $book->category->name }}</span></small>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Paginação -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Nenhum livro encontrado.
    </div>
@endif
@endsection
