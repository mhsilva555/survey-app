@extends('layouts.main')

@section('content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ admin_url('admin.php?page='.DEFAULT_SURVEY_SLUG) }}">Enquetes</a></li>
            <li><span class="tag is-link ml-3">Nova Enquete</span></li>
        </ul>
    </nav>

    @php $edit_survey = $_GET['edit_survey'] ?? null; @endphp

    @if (isset($edit_survey) && $edit_survey != '')
        @php $survey = \Survey\App\Surveys\GetSurveyByID::get($edit_survey); @endphp
    @endif

    <form method="POST" class="form form-new-survey" id="form-new-survey">

        @if (isset($edit_survey))
            <input type="hidden" name="update" value="{{ $_GET['edit_survey'] }}">

            <div class="py-4 px-4 is-size-5 mb-4 has-background-white has-shadow" style="display: flex;align-items: center">
                <input type="checkbox" class="m-0 mr-2" name="ativa" id="ativa" {{ $survey[0]->survey_active ? 'checked' : '' }}>
                <label for="ativa">Enquete Ativa</label>
            </div>
        @endif

        <div class="columns">
            <div class="column">
                @include('partials.question')
            </div>

            <div class="column">
                <div class="section-form">
                    <h2 class="section-title">Respostas</h2>
                    <div id="repeater-answer">
                        <div class="card">
                            <div data-repeater-list="list_answers" class="answers">
                                @if($edit_survey)
                                    @foreach($survey as $answer)
                                        @include('partials.repeater')
                                    @endforeach
                                @else
                                    @include('partials.repeater')
                                @endif
                            </div>

                            <div style="clear: both"></div>
                        </div>

                        <div class="button is-info new-answer" data-repeater-create>Nova Resposta <i class="fas fa-plus"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="has-text-right mt-6">
            <button type="submit" class="button is-success save-survey save-survey-bottom" style="display: none">Salvar Enquete <i class="fas fa-save"></i></button>
        </div>
    </form>

@endsection
