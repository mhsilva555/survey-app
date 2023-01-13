@extends('layouts.main')

@section('content')
    @php
        $surveys = \Survey\App\Surveys\GetSurveys::gelAll();
    @endphp

    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><span class="tag is-link">Enquetes</span></li>
        </ul>
    </nav>

    @if (!empty($surveys))

        <table class="table has-shadow">
        <thead>
            <tr>
                <th class="has-text-weight-bold">ID</th>
                <th class="has-text-weight-bold">Pergunta</th>
                <th class="has-text-weight-bold">Status</th>
                <th class="has-text-weight-bold text-center">Votos</th>
                <th class="has-text-weight-bold">Data</th>
                <th class="has-text-weight-bold">Shortcode</th>
                <th class="has-text-weight-bold">Ações</th>
            </tr>
        </thead>

        <tbody>
            @if(count($surveys) > 0)
                @foreach($surveys as $survey)
                <tr>
                    <td>{{ $survey->survey_id }}</td>

                    <td>{{ $survey->survey_question }}</td>

                    <td>
                        @if($survey->survey_active)
                            <span class="tag is-primary">ATIVA</span>
                        @else
                            <span class="tag is-danger">FINALIZADA</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <span class="tag is-dark">{{ $survey->survey_totalvotes ?? 0 }}</span>
                    </td>

                    <td>{{ date('d/m/Y H:i', strtotime($survey->survey_timestamp)) }}</td>

                    <td class="shortcode-table">
                        <input type="text" readonly value="[survey id={{ $survey->survey_id }}]" />
                    </td>

                    <th>
                        <a href="{{ admin_url("admin.php?page=".DEFAULT_SURVEY_SLUG."&edit_survey=".$survey->survey_id) }}"><span class="has-text-info">Editar</span></a>
                        <span data-id="{{ $survey->survey_id }}" class="has-text-danger ml-3 delete-survey">Deletar</span>
                    </th>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @else

        <div class="mt-6 mb-6">
            <div class="has-text-centered">
                <figure class="image empty-surveys">
                    <img src="{{ SURVEY_PLUGIN_URI . '/resources/images/empty-surveys.svg' }}">
                </figure>

                <h3 class="is-size-4 mt-5">Sem Enquetes Cadastradas!</h3>
            </div>
        </div>

    @endif

    <a class="button is-success" href="{{ admin_url('admin.php?page='.NEW_SURVEY_SLUG) }}">Nova Enquete <i class="fas fa-plus"></i></a>

@endsection