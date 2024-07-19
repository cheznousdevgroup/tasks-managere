@extends('pages.app')
@section('content')
    <h2>
        @if (empty($task))
            Creation
        @else
            modification
        @endif
        d'une tache
    </h2>
    <form action="{{ empty($task) ? route('tache.store') : route('tache.update', $task->id) }}" method="post">
        @csrf
        @if (!empty($task))
        @method('PUT')
            
        @endif
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" 
            @if (!empty($task)) 
                value="{{ old('titre', $task->titre) }}" 
            @endif
            name="titre" class="form-control" id="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description">
                {{ !empty($task) ? old('description', $task->description) : "" }}
            </textarea>
        </div>
        <div class="mb-3">
            <input type="Checkbox" {{ !empty($task) &&  $task->status ? 'checked' : "" }} name="status" class="form-check-input" id="form-check-label">
            <label for="form-check-labe" class="form-label">Termine ?</label>

        </div>
        <button type="submit" class="btn btn-info">
            @if (empty($task))
                Ajouter
            @else
                Modifier
            @endif
        </button>
    </form>


@endsection
