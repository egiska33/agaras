$( document ).ready(function() {
    dbSync.syncDriver();
});

window.onbeforeunload = function(e){
    if($('.syncInProggressIcon').length == 1) return true;
}

window.dbSync = {
    syncLeft: {
        docsInsert: 0,
        docsUpdate: 0,

        animalsInsert: 0,
        animalsUpdate: 0,

        sellersUpdate: 0
    },

    errors: {
        animalErrors: [],
        sellerErrors: [],
        docErrors: []
    },

    startSync: function(flags){
        let syncPromises = [];

        if(flags)
        {
            if((flags.animalsInsert) || (flags.animalsUpdate)) syncPromises.push(dbSync.getAnimalsSyncCount());
            if (flags.sellersUpdate)                           syncPromises.push(dbSync.getSellersSyncCount());
            if((flags.docsInsert)    || (flags.docsUpdate))    syncPromises.push(dbSync.getDocumentsSyncCount());

            Promise.all(syncPromises).then(() => {
                if(flags.animalsInsert) dbSync.syncAnimalsInsert();
                else if(flags.animalsUpdate) dbSync.syncAnimalsUpdate();
                else if(flags.sellersUpdate) dbSync.syncSellersUpdate();
                else if(flags.docsInsert) dbSync.syncDocumentsInsert();
                else if(flags.docsUpdate) dbSync.syncDocumentsUpdate();
            });
        }
    },

    isSyncNeeded: function(){
        return offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
            if(flags)
            {
                if((flags.animalsInsert)
                    || (flags.animalsUpdate)
                    || (flags.docsInsert)
                    || (flags.docsUpdate)
                    || (flags.sellersUpdate)) return flags;
                else return false;
            }
        });
    },

    getAnimalsSyncCount: function(){
        return offlineDB.get('animals', (animalCursor) => {
            if(animalCursor.value.needSync) dbSync.syncLeft.animalsInsert++;
            if(animalCursor.value.needUpdate) dbSync.syncLeft.animalsUpdate++;
        });
    },

    getSellersSyncCount: function(){
        return offlineDB.get('sellers', (sellerCursor) => {
            if(sellerCursor.value.needUpdate) dbSync.syncLeft.sellersUpdate++;
        });
    },

    getDocumentsSyncCount: function(){
        return offlineDB.get('docsPivot', (pivotCursor) => {
            if(pivotCursor.value.needSync) dbSync.syncLeft.docsInsert++;
            if(pivotCursor.value.needUpdate) dbSync.syncLeft.docsUpdate++;
        });
    },

    syncAnimalsInsert: function(){
        var errorExist = false;

        if(dbSync.syncLeft.animalsInsert > 0)
        {
            offlineDB.get('animals', (animalCursor) => {
                var currAnimal = animalCursor.value;

                if(currAnimal.needSync)
                {
                    offlineDB.find('sellers', Number(currAnimal.seller_code), 'code').then((seller) => {
                        currAnimal.code = currAnimal.seller_code;
                        currAnimal.seller_address = seller.address;
                        currAnimal.seller_name = seller.name;
                        currAnimal.sex = currAnimal.specie;

                        axios.post('/animals', currAnimal, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            }).then((response) => {
                                var responseData = response.data;

                                if(responseData.status != 'error')
                                {
                                    responseData = responseData.data;

                                    seller.pvm_code = responseData.seller.pvm_code;
                                    seller.pvm_rate = responseData.seller.pvm_rate;
                                    seller.post_code = responseData.seller.post_code;
                                    seller.has_exemption = responseData.seller.has_exemption;

                                    seller.db_id = responseData.seller.id;
                                    currAnimal.db_id = responseData.animal.id;

                                    currAnimal.needSync = false;

                                    offlineDB.update('sellers', seller).then(() => {
                                        offlineDB.update("animals", currAnimal).then(() => {
                                            dbSync.syncLeft.animalsInsert--;

                                            if((dbSync.syncLeft.animalsInsert == 0) && (errorExist == false)) dbSync.syncAnimalsUpdate();
                                            else if((dbSync.syncLeft.animalsInsert == 0) && (errorExist == true))
                                            {
                                                $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                                $(".syncingScreen").hide();
                                            }
                                        });
                                    });
                                }
                                else
                                {
                                    Object.keys(responseData.errors).forEach(function(key, index) {
                                        appendSyncError('Gyvulys-'+currAnimal.animal_id+' '+responseData.errors[key][0]);
                                    });

                                    errorExist = true;

                                    dbSync.syncLeft.animalsInsert--;

                                    if((dbSync.syncLeft.animalsInsert == 0) && (errorExist == true))
                                    {
                                        $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                        $(".syncingScreen").hide();
                                    }
                                }
                            }).catch((error) => {
                                if(error.response.status == 504)
                                {
                                    $(".syncingScreen").hide();
                                    alert('Sistemoje įvyko synchronizavimo klaida.');
                                }
                                else
                                {
                                    var err = error.response.data.errors;

                                    if(error.response.data.error) appendSyncError('Gyvulys-'+currAnimal.animal_id+' '+err);
                                    else
                                    {
                                        Object.keys(err).forEach(function(key, index) {
                                            appendSyncError('Gyvulys-'+currAnimal.animal_id+' '+err[key][0]);
                                        });
                                    }

                                    errorExist = true;

                                    dbSync.syncLeft.animalsInsert--;

                                    if((dbSync.syncLeft.animalsInsert == 0) && (errorExist == true))
                                    {
                                        $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                        $(".syncingScreen").hide();
                                    }
                                }
                            });
                    });
                }
            })
        }
        else dbSync.syncAnimalsUpdate();
    },

    syncAnimalsUpdate: function(){
        var errorExist = false;

        if(dbSync.syncLeft.animalsUpdate > 0)
        {
            offlineDB.get('animals', (animalCursor) => {
                var currAnimal = animalCursor.value;

                if(currAnimal.needUpdate)
                {
                    offlineDB.find('sellers', Number(currAnimal.seller_code) , 'code').then((seller) => {
                        currAnimal._method = 'PUT';

                        axios.post('/animals/'+currAnimal.db_id, currAnimal, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            }).then((response) => {
                                var responseData = response.data;

                                if(responseData.status != 'error')
                                {
                                    responseData = responseData.data;

                                    currAnimal.needUpdate = false;

                                    offlineDB.update("animals", currAnimal).then(() => {
                                        dbSync.syncLeft.animalsUpdate--;
                                        if(dbSync.syncLeft.animalsUpdate == 0) dbSync.syncSellersUpdate();
                                    });
                                }
                                else
                                {
                                    $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                    $(".syncingScreen").hide();

                                    dbSync.syncLeft.animalsUpdate--;
                                    if(dbSync.syncLeft.animalsUpdate == 0) dbSync.syncSellersUpdate();
                                }
                            }).catch((error) => {
                                $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                $(".syncingScreen").hide();

                                if((error.response.status == 404) && (error.response.data.message == 'No query results for model [App\\Animal].'))
                                {
                                    appendSyncError('Gyvulys-'+currAnimal.animal_id+' toks gyvulys pas administratorių buvo ištrintas. Ištrinkite gyvulį ir jei reikia sukurkite iš naujo');
                                }
                                else
                                {
                                    appendSyncError('Gyvulys-'+currAnimal.animal_id+' sistemoje ivyko klaida.');
                                }

                                dbSync.syncLeft.animalsUpdate--;
                                if(dbSync.syncLeft.animalsUpdate == 0) dbSync.syncSellersUpdate();
                            });
                    });
                }
            })
        }
        else dbSync.syncSellersUpdate();
    },

    syncSellersUpdate: function(){
        var errorExist = false;

        if(dbSync.syncLeft.sellersUpdate > 0)
        {
            offlineDB.get('sellers', (sellerCursor) => {
                var currSeller = sellerCursor.value;

                if(currSeller.needUpdate)
                {
                    offlineDB.find('sellers', Number(currSeller.code) , 'code').then((seller) => {
                        currSeller._method = 'PUT';
                        if(!currSeller.post_code) currSeller.post_code = '';
                        if(currSeller.has_exemption == 'on') currSeller.has_exemption = 1;
                        if(currSeller.representative) currSeller.seller_representative = currSeller.representative;

                        if(currSeller.pass_series_number) currSeller.passport_number = currSeller.pass_series_number;

                        axios.post('/sellers/'+currSeller.db_id, currSeller, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            }).then((response) => {
                                var responseData = response.data;

                                if(responseData.status != 'error')
                                {
                                    responseData = responseData.data;

                                    currSeller.needUpdate = false;

                                    offlineDB.update("sellers", currSeller).then(() => {
                                        dbSync.syncLeft.sellersUpdate--;
                                        if(dbSync.syncLeft.sellersUpdate == 0) dbSync.syncDocumentsInsert();
                                    });
                                }
                                else
                                {
                                    $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                    $(".syncingScreen").hide();

                                    dbSync.syncLeft.sellersUpdate--;
                                    if(dbSync.syncLeft.sellersUpdate == 0) dbSync.syncDocumentsInsert();
                                }
                            }).catch((error) => {
                                var err = error.response.data.error;

                                $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                $(".syncingScreen").hide();

                                appendSyncError('Pardavėjas-'+currSeller.code+' '+err);

                                errorExist = true;

                                dbSync.syncLeft.sellersUpdate--;
                            });;
                    });
                }
            })
        }
        else
        {
            dbSync.syncDocumentsInsert();
        }
    },

    syncDocumentsInsert: function(){
        var errorExist = false;

        if(dbSync.syncLeft.docsInsert > 0)
        {
            offlineDB.get('docsPivot', (pivotCursor) => {
                var currPivot = pivotCursor.value;
                var docs = {};

                docs.pivot = currPivot;

                var arriveField = '';
                var startField = '';

                if(docs.pivot.travel_arrive_date)
                {
                    arriveField = docs.pivot.travel_arrive_date;

                    if((docs.pivot.travel_arrive_hour) && (docs.pivot.travel_arrivet_minute)) arriveField += ' '+docs.pivot.travel_arrive_hour+':'+docs.pivot.travel_arrive_minute;
                }

                if(docs.pivot.travel_start_date)
                {
                    startField = docs.pivot.travel_start_date;

                    if((docs.pivot.travel_start_hour) && (docs.pivot.travel_start_minute)) startField += ' '+docs.pivot.travel_start_hour+':'+docs.pivot.travel_start_minute;
                }

                var addMinutes = (date, minutes) => {
                    return new Date(date.getTime() + minutes*60000);
                }

                var today = new Date();
                today = addMinutes(today, 30);
                var dd = today.getDate();
                var mm = mixins.leftPad(today.getMonth() + 1); //January is 0!
                var yyyy = today.getFullYear();
                var hh = mixins.leftPad(today.getHours());
                var min = mixins.leftPad(today.getMinutes());

                if(!startField) startField = yyyy+'-'+mm+'-'+dd+' '+hh+':'+min;

                docs.pivot.travel_start_datetime = startField;
                docs.pivot.travel_arrive_datetime = arriveField;

                if(currPivot.needSync)
                {
                    var docPromises = [];

                    if(currPivot.vg_id)
                    {
                        docPromises.push(offlineDB.find('doc_VG', currPivot.vg_id, 'id').then((doc_vg) => {
                            docs.vg = doc_vg;

                            docs.vg.sex = '';
                            docs.vg.held_place_number = docs.pivot.animal_place_number;

                            docs.vg.herd_number = docs.pivot.animal_herd_number;
                            docs.vg.held_adress = docs.pivot.seller_pick_up_address;
                            docs.vg.travel_duration = docs.pivot.travel_duration;
                            docs.vg.vet_pass_number = doc_vg.vet_pass_number;
                        }));
                    }
                    if(currPivot.pp_id)
                    {
                        docPromises.push(offlineDB.find('doc_PP', currPivot.pp_id, 'id').then((doc_pp) => {
                            docs.pp = doc_pp;

                            docs.pp.bank = docs.pivot.seller_bank;
                            docs.pp.bull_price = doc_pp.bull_price;
                            docs.pp.heifer_price = doc_pp.heifer_price;
                            docs.pp.cow_price = doc_pp.cow_price;
                        }));
                    }
                    if(currPivot.pi_id)
                    {
                        docPromises.push(offlineDB.find('doc_PI', currPivot.pi_id, 'id').then((doc_pi) => {
                            docs.pi = doc_pi;

                            var piPrice = parseFloat(doc_pi.euroAmount+'.'+doc_pi.centsAmount);

                            docs.pi.check_number = ' ';
                            docs.pi.paid_for = ' ';
                            docs.pi.paid_sum = piPrice;
                        }));
                    }
                    if(currPivot.kv_id)
                    {
                        docPromises.push(offlineDB.find('doc_KV', currPivot.kv_id, 'id').then((doc_kv) => {
                            docs.kv = doc_kv;

                            docs.kv.user_travel_paper_number = doc_kv.user_travel_paper_number;
                        }));
                    }
                    if(currPivot.sf_id)
                    {
                        docPromises.push(offlineDB.find('doc_SF', currPivot.sf_id, 'id').then((doc_sf) => {
                            docs.sf = doc_sf;

                            if(!docs.sf.no){
                                docs.sf.no = docs.sf.no_vat;
                                docs.sf.serial = docs.sf.serial_vat;
                            }

                            docs.sf.farmer_pass_number = doc_sf.farmer_pass_number;
                        }));
                    }

                    var docAnimals = [];

                    Promise.all(docPromises).then(() => {
                        offlineDB.find('docSerials', 1, 'id').then((docSerials) => {
                            offlineDB.get('animals', (animalPivot) => {
                                if(animalPivot.value.seller_code == docs.pivot.seller_code) docAnimals.push(animalPivot.value.db_id);
                            }).then(() => {
                                docs.animals = docAnimals;
                                docs.serials = docSerials;

                                if(!docs.pivot.seller_pick_up_address) docs.pivot.seller_pick_up_address = docs.pivot.seller_address;

                                console.log('SERIALS: ', docs.serials);

                                // docs.serials.vat_invoice_number = ('000000'+Number(docs.serials.vat_invoice_number)).slice(-6);
                                // docs.serials.invoice_number = ('000000'+Number(docs.serials.invoice_number)).slice(-6);
                                // docs.serials.payout_check_number = ('000000'+Number(docs.serials.payout_check_number)).slice(-6);
                                // docs.serials.sp_agreement_number = ('000000'+Number(docs.serials.sp_agreement_number)).slice(-6);
                                // docs.serials.waybill_number = ('000000'+Number(docs.serials.waybill_number)).slice(-6);

                                delete docs.serials.created_at;
                                delete docs.serials.invoice_serial;
                                delete docs.serials.payout_check_serial;
                                delete docs.serials.sp_agreement_serial;
                                delete docs.serials.today;
                                delete docs.serials.updated_at;
                                delete docs.serials.user_id;
                                delete docs.serials.vat_invoice_serial;
                                delete docs.serials.id;
                                delete docs.serials.waybill_serial;

                                axios.post('/documents', docs, {
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        }
                                    }).then((response) => {
                                        var responseData = response.data;

                                        if(responseData.status != 'error')
                                        {
                                            responseData = responseData.data;

                                            currPivot.db_id = responseData.pivot.id;
                                            currPivot.needSync = false;

                                            offlineDB.update("docsPivot", currPivot).then(() => {
                                                dbSync.syncLeft.docsInsert--;
                                                if((dbSync.syncLeft.docsInsert == 0) && (errorExist == false)) dbSync.syncDocumentsUpdate();
                                            });
                                        }
                                        else
                                        {
                                            $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                            $(".syncingScreen").hide();

                                            dbSync.syncLeft.docsInsert--;
                                            if(dbSync.syncLeft.docsInsert == 0) dbSync.syncDocumentsUpdate();
                                        }
                                    }).catch((error) => {
                                        var err = error.response.data.error;

                                        $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                        $(".syncingScreen").hide();

                                        appendSyncError('Dokumentai sukurti pagal pardavėją kurio asm. kodas '+docs.pivot.seller_code+' - '+err);

                                        errorExist = true;
                                        dbSync.syncLeft.docsInsert--;
                                    });
                            })
                        })
                    });
                }
            })
        }
        else dbSync.syncDocumentsUpdate();
    },

    syncDocumentsUpdate: function(){
        var errorExist = false;

        if(dbSync.syncLeft.docsUpdate > 0)
        {
            offlineDB.get('docsPivot', (pivotCursor) => {
                var currPivot = pivotCursor.value;

                if(currPivot.needUpdate)
                {
                    var docs = {};

                    docs._method = 'PUT';
                    docs.pivot = currPivot;

                    var arriveField = '';
                    var startField = '';

                    if(docs.pivot.travel_arrive_date)
                    {
                        arriveField = docs.pivot.travel_arrive_date;

                        if((docs.pivot.travel_arrive_hour) && (docs.pivot.travel_arrivet_minute)) arriveField += ' '+docs.pivot.travel_arrive_hour+':'+docs.pivot.travel_arrive_minute;
                    }

                    if(docs.pivot.travel_start_date)
                    {
                        startField = docs.pivot.travel_start_date;

                        if((docs.pivot.travel_start_hour) && (docs.pivot.travel_start_minute)) startField += ' '+docs.pivot.travel_start_hour+':'+docs.pivot.travel_start_minute;
                    }

                    var addMinutes = (date, minutes) => {
                        return new Date(date.getTime() + minutes*60000);
                    }

                    var today = new Date();
                    today = addMinutes(today, 30);
                    var dd = today.getDate();
                    var mm = mixins.leftPad(today.getMonth() + 1); //January is 0!
                    var yyyy = today.getFullYear();
                    var hh = mixins.leftPad(today.getHours());
                    var min = mixins.leftPad(today.getMinutes());

                    if(!startField) startField = yyyy+'-'+mm+'-'+dd+' '+hh+':'+min;

                    docs.pivot.travel_start_datetime = startField;
                    docs.pivot.travel_arrive_datetime = arriveField;

                    var docPromises = [];

                    if(currPivot.vg_id)
                    {
                        docPromises.push(offlineDB.find('doc_VG', currPivot.vg_id, 'id').then((doc_vg) => {
                            docs.vg = doc_vg;

                            docs.vg.sex = '';
                            docs.vg.held_place_number = docs.pivot.animal_place_number;
                            docs.vg.herd_number = docs.pivot.animal_herd_number;
                            docs.vg.held_adress = docs.pivot.seller_pick_up_address;
                            docs.vg.travel_duration = docs.pivot.travel_duration;
                            docs.vg.vet_pass_number = doc_vg.vet_pass_number;
                        }));
                    }
                    if(currPivot.pp_id)
                    {
                        docPromises.push(offlineDB.find('doc_PP', currPivot.pp_id, 'id').then((doc_pp) => {
                            docs.pp = doc_pp;

                            docs.pp.bank = docs.pivot.seller_bank;
                            docs.pp.bull_price = doc_pp.bull_price;
                            docs.pp.heifer_price = doc_pp.heifer_price;
                            docs.pp.cow_price = doc_pp.cow_price;
                        }));
                    }
                    if(currPivot.pi_id)
                    {
                        docPromises.push(offlineDB.find('doc_PI', currPivot.pi_id, 'id').then((doc_pi) => {
                            docs.pi = doc_pi;

                            var piPrice = parseFloat(doc_pi.euroAmount+'.'+doc_pi.centsAmount);

                            docs.pi.check_number = ' ';
                            docs.pi.paid_for = ' ';
                            docs.pi.paid_sum = piPrice;
                        }));
                    }
                    if(currPivot.kv_id)
                    {
                        docPromises.push(offlineDB.find('doc_KV', currPivot.kv_id, 'id').then((doc_kv) => {
                            docs.kv = doc_kv;

                            docs.kv.user_travel_paper_number = doc_kv.user_travel_paper_number;
                        }));
                    }
                    if(currPivot.sf_id)
                    {
                        docPromises.push(offlineDB.find('doc_SF', currPivot.sf_id, 'id').then((doc_sf) => {
                            docs.sf = doc_sf;

                            docs.sf.farmer_pass_number = doc_sf.farmer_pass_number;
                        }));
                    }

                    var temp_vg = currPivot.vg_id;
                    var temp_kv = currPivot.kv_id;
                    var temp_sf = currPivot.sf_id;
                    var temp_pi = currPivot.pi_id;
                    var temp_pp = currPivot.pp_id;

                    delete docs.pivot.vg_id;
                    delete docs.pivot.kv_id;
                    delete docs.pivot.sf_id;
                    delete docs.pivot.pi_id;
                    delete docs.pivot.pp_id;

                    Promise.all(docPromises).then(() => {
                        axios.post('/documents/'+currPivot.db_id, docs, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            }).then((response) => {
                                var responseData = response.data;

                                docs.pivot.vg_id = temp_vg;
                                docs.pivot.kv_id = temp_kv;
                                docs.pivot.sf_id = temp_sf;
                                docs.pivot.pi_id = temp_pi;
                                docs.pivot.pp_id = temp_pp;

                                if(responseData.status != 'error')
                                {
                                    responseData = responseData.data;
                                    currPivot.needUpdate = false;

                                    offlineDB.update("docsPivot", currPivot).then(() => {
                                        dbSync.syncLeft.docsUpdate--;
                                        if((dbSync.syncLeft.docsUpdate == 0) && (errorExist == false)) dbSync.finishSync();
                                    });
                                }
                                else
                                {
                                    $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                    $(".syncingScreen").hide();

                                    dbSync.syncLeft.docsUpdate--;
                                    if(dbSync.syncLeft.docsUpdate == 0) dbSync.finishSync();
                                }
                            }).catch((error) => {
                                var err = error.response.data.error;

                                $(".syncStatusIcon").removeClass('syncInProggressIcon').addClass('syncFailIcon');
                                $(".syncingScreen").hide();

                                appendSyncError('Dokumentai atnaujinti pagal pardavėją kurio asm. kodas '+docs.pivot.seller_code+' - '+err);

                                errorExist = true;
                                dbSync.syncLeft.docsUpdate--;
                            });;
                    });
                }
            });
        }
        else dbSync.finishSync();
    },

    finishSync: function(){
        offlineDB.update('syncTableFlags', {
            animalsInsert: false,
            animalsUpdate: false,

            docsInsert: false,
            docsUpdate: false,

            sellersUpdate: false,
            id: 1
        }).then(() => {
            $(".syncStatusIcon").addClass('syncSuccessIcon').removeClass('syncInProggressIcon');
            $(".syncingScreen").hide();
        });
    },

    syncDriver: function(){
        if(navigator.onLine)
        {
            if(window.location.href.indexOf('login') === -1)
            {
                caches.open('agaras-static-v1').then(function(cache) {
                    cache.delete('/uploads/pricelist.pdf').then(() => {
                        cache.add('/uploads/pricelist.pdf').then(() => {
                        });
                    });
                });

                axios.get('/api/getDriver')
                    .then(response => {
                        var driver = response.data;
                        if(!$.isEmptyObject(response.data))
                        {
                            driver.id = 1;
                            offlineDB.update('driver', driver).then(() => {
                                if(driver.role == 'driver')
                                {
                                    dbSync.isSyncNeeded().then((flags) => {
                                        if(flags !== false)
                                        {
                                            dbSync.startSync(flags);
                                            $('.syncingScreen').css('display', 'flex');
                                            $(".syncStatusIcon").addClass('syncInProggressIcon');
                                        }
                                        else
                                        {
                                            axios.get('/documents/serials')
                                                .then(response => {
                                                    offlineDB.find('docSerials', 1, 'id').then((oldSerials) => {
                                                        var now = new Date();

                                                        var serials = response.data.serials[0];

                                                        serials.id = 1;
                                                        serials.today = now.getDate();

                                                        offlineDB.update('docSerials', serials);
                                                    });
                                                });

                                            $(".syncStatusIcon").addClass('syncSuccessIcon');
                                        }
                                    });

                                    offlineDB.find('driver', 1, 'id').then((driver) => {
                                        if(driver)
                                        {
                                            if(!driver.waybill_number)
                                            {
                                                axios.get('/documents/serials')
                                                    .then(response => {
                                                        var newSerials = response.data.serials[0];

                                                        delete newSerials.id;

                                                        var mergedDriver = Object.assign({}, driver, newSerials);

                                                        delete mergedDriver.no;

                                                        offlineDB.update("driver", mergedDriver).then(() => {
                                                            axios.get('/routes', {
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'Accept': 'application/json'
                                                                }
                                                            }).then((response) => {
                                                                var responseData = response.data.data;

                                                                offlineDB.find('driver', 1, 'id').then((driver) => {
                                                                    if(driver)
                                                                    {
                                                                        driver.markers = responseData.markers;

                                                                        offlineDB.update('driver', driver);
                                                                    }
                                                                });

                                                                for(var i = 0; i < responseData.routes.length; i++)
                                                                {
                                                                    let route = responseData.routes[i];
                                                                    offlineDB.find('routes', route.id, 'id').then((localRoute) => {
                                                                        if(localRoute)
                                                                        {
                                                                            if(((!localRoute.file) && (route.file)) || ((localRoute.file) && (localRoute.file.filename != route.file.filename)))
                                                                            {
                                                                                caches.open('agaras-static-v1').then(function(cache) {
                                                                                    cache.add('/uploads/'+route.file.filename).then(() => {
                                                                                        offlineDB.update('routes', route);
                                                                                    });
                                                                                });
                                                                            }
                                                                            else
                                                                            {
                                                                                offlineDB.update('routes', route);
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            if(route.file)
                                                                            {
                                                                                caches.open('agaras-static-v1').then(function(cache) {
                                                                                    cache.add('/uploads/'+route.file.filename).then(() => {
                                                                                        offlineDB.update('routes', route);
                                                                                    });
                                                                                });
                                                                            }
                                                                            else
                                                                            {
                                                                                offlineDB.update('routes', route);
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    });
                                            }
                                        }
                                    });
                                }
                            });
                        }
                        else
                        {
                            offlineDB.delete('driver', 1, 'id');
                            formURL('/login');
                        }
                    }).catch((err) => {
                        offlineDB.delete('driver', 1, 'id');
                        formURL('/login');
                    });
            }
        }
    }
}
