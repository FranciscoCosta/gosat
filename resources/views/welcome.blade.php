<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosat</title>
</head>
<body>
    <div class="main__container">
        <div class="order__credit-container">
            <form action="{{ url('api/offers/') }}" method="post" class="form__cpf">
                @csrf
                @method('POST')
                <h2>Verifique as linhas de créditos disponíveis</h2>
                <div class="input-group">
                    <input required="" type="number" name="cpf" autocomplete="off" class="input">
                    <label class="user-label">Cpf</label>
                </div>
                <button type="submit" class="submit__cpf">Enviar</button>
            </form>
        </div>
        <div class="display__container">
            @if(isset($lowestTaxes))
            <h1>Melhores ofertas</h1>
                <div class="display__container-card">
                    <h2>Menores taxas de juros</h2>
                    <div class="display__offers">
                        @foreach($lowestTaxes as $offer)
                            <div class="offer__container">
                                <div class="offer__card">
                                    <h3>Instituição: <span> {{ $offer->institution }}</span></h3>
                                    <h3>Modalidade: <span> {{ $offer->name_modal }}</span></h3>
                                    <h3>Taxas de juros: <span> {{ $offer->TaxesMonth }}%</span></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(isset($biggestCredit))
                <div class="display__container-card">
                    <h2>Maior linha de crédito</h2>
                    <div class="display__offers">
                        @foreach($biggestCredit as $offer)
                            <div class="offer__container">
                                <div class="offer__card">
                                    <h3>Instituição: <span> {{ $offer->institution }}</span></h3>
                                    <h3>Modalidade: <span> {{ $offer->name_modal }}</span></h3>
                                    <h3>Crédito até: <span> {{ $offer->VMax }} - BRL</span></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(isset($lowestParcel))
                <div class="display__container-card">
                    <h2>Menor número de parcelas</h2>
                    <div class="display__offers">
                        @foreach($lowestParcel as $offer)
                            <div class="offer__container">
                                <div class="offer__card">
                                    <h3>Instituição: <span> {{ $offer->institution }}</span></h3>
                                    <h3>Modalidade: <span> {{ $offer->name_modal }}</span></h3>
                                    <h3>Nº mínimo de parcelas: <span> {{ $offer->PMin }}</span></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
