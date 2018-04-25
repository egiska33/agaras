<template>
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Pridėti gyvulį</h3>
					</div>
					<form action="" method="POST">
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio rūšies ID numeris</label>
									<input type="text" class="form-control" name="animal_id" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio paso numeris</label>
									<input type="text" class="form-control" name="passport_id" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Rūšis</label>
									<input type="text" class="form-control" name="sex" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Veislė</label>
									<input type="text" class="form-control" name="breed" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gimimo šalis</label>
									<select class="form-control" name="cob">
										<option value="Lietuva">Lietuva</option>
										<option value="Airija">Airija</option>
										<option value="Austrija">Austrija</option>
										<option value="Belgija">Belgija</option>
										<option value="Bulgarija">Bulgarija</option>
										<option value="Čekija">Čekija</option>
										<option value="Danija">Danija</option>
										<option value="Estija">Estija</option>
										<option value="Graikija">Graikija</option>
										<option value="Ispanija">Ispanija</option>
										<option value="Italija">Italija</option>
										<option value="Jungtinė Karalystė">Jungtinė Karalystė</option>
										<option value="Kipras">Kipras</option>
										<option value="Kroatija">Kroatija</option>
										<option value="Latvija">Latvija</option>
										<option value="Lenkija">Lenkija</option>
										<option value="Liuksemburgas">Liuksemburgas</option>
										<option value="Malta">Malta</option>
										<option value="Nyderlandai">Nyderlandai</option>
										<option value="Portugalija">Portugalija</option>
										<option value="Prancūzija">Prancūzija</option>
										<option value="Rumunija">Rumunija</option>
										<option value="Slovakija">Slovakija</option>
										<option value="Slovėnija">Slovėnija</option>
										<option value="Suomija">Suomija</option>
										<option value="Švedija">Švedija</option>
										<option value="Vengrija">Vengrija</option>
										<option value="Vokietija">Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gimimo šalis</label>
									<input type="date" class="form-control" name="dob" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Įmitimo kategorija</label>
									<select class="form-control" name="inclination">
										<option value="-"> Pasirinkti kategoriją</option>
										<option value="0">Pagal skerdieną</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Amžius (mėn.)</label>
									<input type="text" class="form-control" name="age" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gyvasis svoris (kg)</label>
									<input type="text" class="form-control" name="real_weight" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Įskaitomas svoris (kg)</label>
									<input type="text" class="form-control" name="includable_weight" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Užauginimo vieta</label>
									<select class="form-control" name="pog">
										<option value="Lietuva">Lietuva</option>
										<option value="Airija">Airija</option>
										<option value="Austrija">Austrija</option>
										<option value="Belgija">Belgija</option>
										<option value="Bulgarija">Bulgarija</option>
										<option value="Čekija">Čekija</option>
										<option value="Danija">Danija</option>
										<option value="Estija">Estija</option>
										<option value="Graikija">Graikija</option>
										<option value="Ispanija">Ispanija</option>
										<option value="Italija">Italija</option>
										<option value="Jungtinė Karalystė">Jungtinė Karalystė</option>
										<option value="Kipras">Kipras</option>
										<option value="Kroatija">Kroatija</option>
										<option value="Latvija">Latvija</option>
										<option value="Lenkija">Lenkija</option>
										<option value="Liuksemburgas">Liuksemburgas</option>
										<option value="Malta">Malta</option>
										<option value="Nyderlandai">Nyderlandai</option>
										<option value="Portugalija">Portugalija</option>
										<option value="Prancūzija">Prancūzija</option>
										<option value="Rumunija">Rumunija</option>
										<option value="Slovakija">Slovakija</option>
										<option value="Slovėnija">Slovėnija</option>
										<option value="Suomija">Suomija</option>
										<option value="Švedija">Švedija</option>
										<option value="Vengrija">Vengrija</option>
										<option value="Vokietija">Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Eur/kg</label>
									<input type="text" class="form-control" name="price_kg" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Vardas, pavardė arba įmonės pavadinimas</label>
									<input type="text" class="form-control" name="seller_name" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Asmens / įmonės Kodas</label>
									<input type="text" class="form-control" name="code" value="" readonly>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Adresas</label>
									<input type="text" class="form-control" name="seller_address" value="" readonly>
				                </div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.create') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
</template>
