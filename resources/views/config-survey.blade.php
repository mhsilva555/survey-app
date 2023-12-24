@extends('layouts.main')

@section('content')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ admin_url('admin.php?page='.DEFAULT_SURVEY_SLUG) }}">Enquetes</a></li>
            <li><span class="tag is-link ml-3">Configurações</span></li>
        </ul>
    </nav>
    
    <form method="POST" class="form form-config-survey" id="form-config-survey" enctype="multipart/form-data">
        <h2 class="section-title">Google reCAPTCHA</h2>

        <div class="columns">
            <div class="column">
               <fieldset class="field">
                    <p class="section-title-small">Chave do Site</p>
                    <input type="text" class="input" name="recaptcha_site_key" id="recaptcha_site_key" placeholder="6Le5-TkpAAAAAAx73bry-XgxBmd6qa_ifCAcOKQy" value="{{ $recaptcha_site_key ?? '' }}">
                </fieldset>
            </div>

            <div class="column">
                <fieldset class="field">
                     <p class="section-title-small">Chave Secreta</p>
                     <input type="text" class="input" name="recaptcha_secret_key" id="recaptcha_secret_key" placeholder="6Le5-TkpAAAAANQoM1kgCHDVUmdSz8Olb52rlsQa" value="{{ $recaptcha_secret_key ?? '' }}">
                 </fieldset>
             </div>
        </div>

        <div class="has-text-right mt-6">
            <button type="submit" class="button is-success save-config-survey">Salvar Configurações <i class="fas fa-save"></i></button>
        </div>
    </form>

@endsection
