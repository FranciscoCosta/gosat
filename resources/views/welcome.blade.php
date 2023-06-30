<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <title>Gosat</title>
</head>
<body>
    <div class="main__container">
        <div class="order__credit-container">
            <form action="{{ url('api/offers/cpf') }}" method="post" class="form__cpf">
                @csrf
                <h2>Verifique as linhas de créditos disponíveis</h2>
                <input type="hidden" name="_method" value="POST"> <!-- Add this line if you want to specify the HTTP method -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- Add this line if you want to include the CSRF token in the request -->
                <div class="input-group">
                    <input required="" type="number" name="cpf" autocomplete="off" class="input">
                    <label class="user-label">Cpf</label>
                </div>
                <button type="submit" class="submit__cpf">Enviar</button>
            </form>
        </div>
        <div class="display__container">
            <div class="display__offer-card">
                @if(isset($offers))
                <h2>Ofertas:</h2>
                <div class="offer__container-left">
                    @foreach($offers as $offer)
                    <div class="offer__card">
                        <div class="offer-show">
                            <p class="offer__text">Cpf do usuário: {{ $offer->cpf }}</p>
                        </div>
                        <div class="offer-show">
                            <p class="offer__text">Instituição: {{ $offer->institution }}</p>
                        </div>
                        <div class="offer-show">
                            <p class="offer__text">Modalidade: {{ $offer->name_modal }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="offer__container-left">
                    @foreach($offers as $offer)
                    <div class="offer__card">
                        <div class="offer-show">
                            <p class="offer__text">Quantidade Minima de Parcelas: {{ $offer->PMin }}</p>
                        </div>
                        <div class="offer-show">
                            <p class="offer__text">Instituição: {{ $offer->institution }}</p>
                        </div>
                        <div class="offer-show">
                            <p class="offer__text">Modalidade: {{ $offer->name_modal }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <form action="{{ url('api/offers/taxes') }}" method="post">
                @csrf
            </form>
            @if(isset($Filteredoffers))

                <div class="offer__container-left">
                    @foreach($Filteredoffers as $Filteredoffer)
                        <p>{{ $Filteredoffer->TaxesMonth }}</p>
                    @endforeach 
                </div>
            @endif
        </div>
    </div>
</body>
</html>
