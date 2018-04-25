import idb from 'idb';

window.offlineDB = {
    idb: idb.open('agaras-db', 1, function(upgradeDb)
    {
        switch(upgradeDb.oldVersion)
        {
            case 0:
                var animalsStore = upgradeDb.createObjectStore('animals', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                animalsStore.createIndex('id', 'id');
                animalsStore.createIndex('seller_code', 'seller_code');

                var sellersStore = upgradeDb.createObjectStore('sellers', {
                    keyPath: 'code'
                });
                sellersStore.createIndex('code', 'code');

                var driverStore = upgradeDb.createObjectStore('driver', {
                    keyPath: 'id'
                });
                driverStore.createIndex('id', 'id');

                var driverStore = upgradeDb.createObjectStore('docSerials', {
                    keyPath: 'id'
                });
                driverStore.createIndex('id', 'id');

                var routeStore = upgradeDb.createObjectStore('routes', {
                    keyPath: 'id'
                });
                routeStore.createIndex('id', 'id');

                var DocsPivotStore = upgradeDb.createObjectStore('docsPivot', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                DocsPivotStore.createIndex('id', 'id');
                DocsPivotStore.createIndex('kv_id', 'kv_id');
                DocsPivotStore.createIndex('vg_id', 'vg_id');
                DocsPivotStore.createIndex('sf_id', 'sf_id');
                DocsPivotStore.createIndex('pi_id', 'pi_id');
                DocsPivotStore.createIndex('pp_id', 'pp_id');

                var KVStore = upgradeDb.createObjectStore('doc_KV', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                KVStore.createIndex('id', 'id');

                var VGStore = upgradeDb.createObjectStore('doc_VG', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                VGStore.createIndex('id', 'id');

                var SFStore = upgradeDb.createObjectStore('doc_SF', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                SFStore.createIndex('id', 'id');

                var PIStore = upgradeDb.createObjectStore('doc_PI', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                PIStore.createIndex('id', 'id');

                var PPStore = upgradeDb.createObjectStore('doc_PP', {
                    keyPath: 'id',
                    autoIncrement: true
                });
                PPStore.createIndex('id', 'id');

                var syncTableFlags = upgradeDb.createObjectStore('syncTableFlags', {
                    keyPath: 'id'
                });
                syncTableFlags.createIndex('id', 'id');

                offlineDB.insert('syncTableFlags', {
                    id: 1,

                    docsInsert: false,
                    docsUpdate: false,

                    animalsInsert: false,
                    animalsUpdate: false,

                    sellersUpdate: false
                });
        }
    }),

    getRWStore: function(name)
    {
        return offlineDB.idb.then(function(db)
        {
            return db.transaction(name, 'readwrite').objectStore(name);
        });
    },

    getRStore: function(name, orderBy, findTarget, searchColName)
    {
        return offlineDB.idb.then(function(db)
        {
            var store = db.transaction(name).objectStore(name);

            if(typeof orderBy !== 'undefined')
            {
                store = store.index(orderBy);
            }

            if(typeof findTarget !== 'undefined')
            {
                var targetIndex = store.index(searchColName);
                return targetIndex.get(findTarget);
            }
            else
            {
                return store.openCursor();
            }
        });
    },

    delete: function(tableName, targetId, colName)
    {
        offlineDB.getRWStore(tableName).then((table) => {
            table.index(colName);
            table.delete(targetId);
        });
    },

    insert: function(tableName, insertObject)
    {
        return offlineDB.getRWStore(tableName).then((table) => {
            return table.add(insertObject).then(function(insertedId)
            {
                if(isNaN(insertedId)) return false;
                else return insertedId;
            });
        });
    },

    findWhere: function(tableName, targetVal, targetCol, callback)
    {
        return offlineDB.getRWStore(tableName).then((table) => {
            var column = table.index(targetCol);

            return column.openCursor(targetVal).then(function getNextRow(cursor) {
                if(!cursor) return;

                callback(cursor);

                return cursor.continue().then(getNextRow);
            });
        });
    },

    deleteWhere: function(tableName, targetVal, targetCol)
    {
        offlineDB.getRWStore(tableName).then((table) => {
            var column = table.index(targetCol);

            column.openCursor(targetVal).then(function getNextRow(cursor) {
                if(!cursor) return;

                cursor.delete();

                return cursor.continue().then(getNextRow);
            });
        });
    },

    get: function(tableName, callback)
    {
        return offlineDB.getRStore(tableName).then(function getNextRow(cursor) {
            if(!cursor) return;

            callback(cursor);

            return cursor.continue().then(getNextRow);
        });
    },

    find: function(tableName, targetId, searchColName)
    {
        return offlineDB.getRStore(tableName, undefined, targetId, searchColName).then(function getNextRow(result) {
            return result;
        });
    },

    count: function(tableName, targetId, searchColName)
    {
        return offlineDB.idb.then(function(db)
        {
            var store = db.transaction(tableName).objectStore(tableName);
            store = store.index(searchColName);
            return store.count(targetId);
        });
    },

    update: function(tableName, updateObject)
    {
        return offlineDB.getRWStore(tableName).then((table) => {
            return table.put(updateObject);
        });
    }
};
