<template>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vardas, pavardė arba įmonės pavadinimas</h3>
                    </div>
                    <form action="" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Vardas, pavardė arba įmonės pavadinimas <sup>*</sup></label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label>Asmens / įmonės Kodas <sup>*</sup></label>
                                <input type="text" class="form-control" name="code" value="">
                            </div>
                            <div class="form-group">
                                <label>Adresas <sup>*</sup></label>
                                <input type="text" class="form-control" name="address" value="">
                            </div>
                            <div class="form-group">
                                <label>
                                    Pakrovimo vieta
                                    <div class="checkbox inline">
                                      <label>
                                        <input type="checkbox" name="isSameAddress"> Adresas sutampa su aukščiau nurodytu
                                      </label>
                                    </div>
                                </label>
                                <input type="text" class="form-control" name="pick_up_address" value="">
                            </div>
                            <div class="form-group">
                                <label>PVM kodas</label>
                                <input type="text" class="form-control" name="pvm_code" value="">
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
        								<label>Paso numeris</label>
        								<input type="number" class="form-control"  name="pass_series_number"/>
        			                </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
        								<label>Paso išdavimo data</label>
        								<input type="text" class="form-control datepicker" name="pass_issued_date"/>
        			                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Mob. nr. <sup>*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        +3706
                                    </div>
                                    <input type="text" class="form-control" name="phone" value="">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-block btn-primary">Sukurti</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
</template>
