
<ul>
<li>Endpoint: Route::get('/', [MealController::class, 'index'])->middleware('locale');</li>
<li>Prebacivanje jezika se obavlja putem middlewarea SetLocale</li>
<li>Validacija se obavlja putem requesta MealRequest</li>
<li>Queryji se nalaze unutar modela kao query scopeovi hasTags, inCategory i hasStatusAfterDate</li>
<li>Odabir dodatnih opcija za shemu responsea i pageing se nalaze unutar MealControllera</li>
</ul>
