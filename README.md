
<ul>
<li>Prebacivanje jezika se obavlja putem middlewarea SetLocale</li>
<li>Validacija se obavlja putem requesta MealRequest</li>
</ul>


<p>API token naziva 'api_token' se šalje POST metodom kao parametar forme</p>

<p>Ograničenje API requestova na 1000 je napravljeno pomoću middlewarea 'IsTokenExceeded'</p>

<p>Logika dohvaćanja se zbog jednostavnosti nalazi unutar ruta u routes/api.php (kontroleri nisu korišteni)</p>
