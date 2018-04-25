<template>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pridėti gyvulį pagal ID</h3>
                    </div>
                    <form method='GET' action='/o/animals/create'>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Įveskite gyvulio rūšies ir identifikavimo numerį <sup>*</sup></label>
                                <input type="text" class="form-control" name="animal_id">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value='Pridėti'>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</template>
