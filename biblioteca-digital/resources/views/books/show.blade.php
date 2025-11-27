@extends('layouts.app')

@section('title', $book->title . ' - Biblioteca Digital')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover card-img-top" alt="{{ $book->title }}">
            @else
                <div class="book-cover card-img-top bg-secondary d-flex align-items-center justify-content-center">
                    <i class="bi bi-book text-white" style="font-size: 5rem;"></i>
                </div>
            @endif
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </form>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title mb-3">{{ $book->title }}</h2>
                
                <div class="mb-4">
                    <span class="badge bg-primary fs-6">{{ $book->category->name }}</span>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Autor</h6>
                        <p class="fs-5"><i class="bi bi-person-fill"></i> {{ $book->author }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">ISBN</h6>
                        <p class="fs-5"><i class="bi bi-upc"></i> {{ $book->isbn }}</p>
                    </div>
                </div>

                @if($book->description)
                    <div class="mb-3">
                        <h6 class="text-muted">Descrição</h6>
                        <p class="text-justify">{{ $book->description }}</p>
                    </div>
                @endif

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Cadastrado em</h6>
                        <p><i class="bi bi-calendar-plus"></i> {{ $book->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Última atualização</h6>
                        <p><i class="bi bi-calendar-check"></i> {{ $book->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
