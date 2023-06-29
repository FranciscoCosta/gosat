<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosat</title>
</head>
<body>
    <div class="main__container">

    <form action="{{ url('api/offers') }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="POST"> <!-- Add this line if you want to specify the HTTP method -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- Add this line if you want to include the CSRF token in the request -->
    <input type="text" name="cpf" placeholder="Digite o seu cpf"> <!-- Change input type to "text" to accept CPF as a string -->
    <button type="submit">Enviar</button> <!-- Correct the spelling of "Submit" and close the button tag -->
</form>

    </div>
    
</body>
</html>