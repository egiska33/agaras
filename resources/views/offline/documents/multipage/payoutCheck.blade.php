<table class="no-border table-text-left">
	<tr height="30px">
		<td><strong>UAB ,,Agaras", Balandiškių km., Pabiržės sen. Biržų r. LT-41385, Lietuva</strong></td>
	</tr>
	<tr>
		<td><strong>Įm. kodas 154742821</strong></td>
	</tr>
</table>
<table class="no-border">
	<tr height="50px">
		<td><h1>PINIGŲ IŠMOKĖJIMO KVITAS</h1></td>
	</tr>
	<tr height="20px">

		<td><strong><small>Serija</small> {{ $documentInfo['doc__p_i']['serial'] }} Nr. {{ $documentInfo['doc__p_i']['no'] }}</strong></td>
	</tr>
	<td height="30px">{{ \Carbon\Carbon::now()->format('Y') }} m. {{ \Carbon\Carbon::now()->format('m') }} mėn. {{ \Carbon\Carbon::now()->format('d') }} d.</td>
</table>
<table class="no-border no-collapse table-text-left">
	<tr>
		<td>Išmokėti už</td>
		<td class="dot-line" width="88%">{{ $documentInfo['doc__p_i']['paid_for'] }}</td>
	</tr>
	<tr>
		<td colspan="2"	class="text-center text-below">perkamų prekių / paslaugų pavadinimai, kiekiai, matavimo vienetai, vieneto kaina</td>
	</tr>
	<tr>
		<td colspan="2" class="dot-line" height="20px"></td>
	</tr>
	<tr>
		<td colspan="2"	 class="text-center text-below">perkamų prekių / paslaugų pavadinimai, kiekiai, matavimo vienetai, vieneto kaina</td>
	</tr>
	<tr>
		<td>Išmokėti už</td>
		<td class="dot-line" width="88%"></td>
	</tr>
	<tr>
		<td colspan="2" class="dot-line" height="20px"></td>
	</tr>
</table>
<table class="no-border no-collapse table-text-left margin-10">
	<tr>
		<td>Išmokėta suma</td>
		<td class="dot-line" width="84%"></td>
	</tr>
	<tr>
		<td colspan="2" class="text-center text-below">(už perkamas prekes išmokėta suma žodžiais)</td>
	</tr>
</table>
<table class="no-border no-collapse table-text-left">
	<tr>
		<td class="dot-line" width="75%"></td>
		<td class="border-left dot-line" width="10%">{{ explode('.', $documentInfo['doc__p_i']['paid_sum'])[0] }}</td>
		<td>Eur</td>
		<td class="dot-line" width="10%">{{ explode('.', $documentInfo['doc__p_i']['paid_sum'])[1] }}</td>
		<td>ct</td>
	</tr>
</table>
<table class="no-border no-collapse table-text-left margin-10">
	<tr>
		<td>Išmokėjau</td>
		<td class="dot-line" width="90%">{{ $documentInfo['user_name'] }}</td>
	</tr>
	<tr>
		<td colspan="2" class="text-center text-below">(prekes pristačiusio asmens parašas, vardas, pavardė)</td>
	</tr>
</table>
<table class="no-border no-collapse table-text-left margin-10">
	<tr>
		<td>Pinigus gavau</td>
		<td class="dot-line" width="85%">{{ $documentInfo['seller_name'] }}, {{ $documentInfo['doc__p_i']['check_number'] }}</td>
	</tr>
	<tr>
		<td colspan="2" class="text-center text-below">(asmens kodas, paso numeris ir gyvenamoji vieta nebūtina)</td>
	</tr>
</table>