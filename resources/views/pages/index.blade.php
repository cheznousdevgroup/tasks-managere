@extends('pages.app')


@section('content')
    <a href="{{ route('tache.create') }}" class="btn btn-primary">Ajouter une tache</a>

    @if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    <table class="table mt-8" style="border: 1px solid;">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach ($Tasks as $Task)
            <tbody>
                <tr>
                    <td>{{ $Task->titre }}</td>
                    <td>{{ $Task->description }}</td>
                    <td>
                        <span class="badge text-bg-success">{{ $Task->status ? 'Terminé' : 'En cours' }}</span>
                    </td>
                    <td>
                        <a href="{{ route('tache.edit', $Task->id) }}" class="btn btn-info">Modifier</a>
                        <form action="{{ route('tache.destroy', $Task->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Etes vous sur de vouloir supprimer la taches ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach

    </table>
    <div class="flex-center position-ref full-height">
        <div class="content mt-8">
           

            <div id="chartContainer" style="height: 370px; width: 100%;"></div>

            <script>
                window.onload = function() {
                    var dataPoints = [
                        @foreach ($tasksByStatus as $task)
                            {
                                y: {{ $task->count }},
                                name: "{{ $task->status ? 'Terminé' : 'En cours' }}"
                            },
                        @endforeach
                    ];

                    var chart = new CanvasJS.Chart("chartContainer", {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Répartition des Tâches par Statut"
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: explodePie
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{name}: <strong>{y}</strong>",
                            indexLabel: "{name} - {y}",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                }

                function explodePie(e) {
                    if (typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e
                            .dataPointIndex].exploded) {
                        e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                    } else {
                        e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                    }
                    e.chart.render();
                }
            </script>
        </div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection
