<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Conversor de moedas v1.0
    </h1>
    <?php
        
        $início =  date("m-d-Y", strtotime("-7 days"));
        $fim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $início .'\'&@dataFinalCotacao=\'' . $fim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        $dados = json_decode(file_get_contents($url), true);

        $real = $_GET["carteira"];
        $dol = $real / $dados["value"][0]["cotacaoCompra"];
        $real = number_format($real, 6, ",");
        $dol = number_format($dol, 6, ",");
        echo "Sua carteira tem $real e em dólar dá <strong>$dol</strong><br>
            a cotação está em " . $dados["value"][0]["cotacaoCompra"];
    ?>
</body>

</html>