@extends('layouts.app')

@section('title', $category->name . ' - Biblioteca Digital')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-tag-fill"></i> {{ $category->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted">Descrição</h6>
                        <p>{{ $category->description ?? 'Sem descrição' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Total de Livros</h6>
                        <p><span class="badge bg-info fs-5">{{ $category->books->count() }}</span></p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>

        @if($category->books->count() > 0)
            <h4 class="mb-3">Livros desta Categoria</h4>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($category->books as $book)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-book text-white" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted">{{ $book->author }}</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="bi bi-eye"></i> Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Nenhum livro cadastrado nesta categoria.
            </div>
        @endif
    </div>
</div>
@endsection
