@if(!empty($results))

    <div class="survey-list-results">
        @foreach($results as $result)
            <div class="survey-result">
                <div>
                    <p class="votes">Votos: {{ $result->answer_totalvotes ?? 0 }}</p>
                </div>

                <div>
                    <p>{{ $result->answer_text }}</p>
                </div>

                <div class="survey-result-thumb">
                    <div style="background: url(' {{ $result->answer_image ?? '' }} ')" class="survey-result-image"></div>
                </div>
            </div>
        @endforeach
    </div>

@endif