self.addEventListener('fetch', function(event)
{
    let response = event.request;
    let targetUrl = event.request.url.split('/');

    if((targetUrl.includes('o'))
    || (targetUrl.includes('app.js'))
    || (targetUrl.includes('all.css'))
    || (targetUrl.includes('offline-print.css'))
    || (targetUrl.includes('serviceWorker.js'))
    || ((targetUrl.includes('uploads')) && (targetUrl.includes('pricelist.pdf'))))
    {
        if(targetUrl[targetUrl.length - 1].split('?')[0] == 'print')
        {
            targetUrl.pop();
            targetUrl.push('print');

            response = targetUrl.join('/');
        }
        else if(targetUrl.includes('edit'))
        {
            targetUrl.pop();
            response = targetUrl.join('/');
        }
        else if((targetUrl.includes('documents')) && (targetUrl.length > 5) && (!targetUrl[targetUrl.length - 1].includes('print')))
        {
            targetUrl.pop();
            response = targetUrl.join('/');
        }
        else
        {
            response = targetUrl.join('/');
        }
    }

    event.respondWith(
        caches.match(response).then(function(response)
        {
            if (response) return response;
            return fetch(event.request);
        })
    );
});

self.addEventListener('install', function(event)
{
    var pagesToCache = [
        '/o/routes',

        '/o/documents',
        '/o/documents/vatInvoice',
        '/o/documents/vatInvoice/edit',
        '/o/documents/invoice',
        '/o/documents/invoice/edit',
        '/o/documents/animalsWaybill',
        '/o/documents/animalsWaybill/edit',
        '/o/documents/waybill',
        '/o/documents/waybill/edit',
        '/o/documents/spagreement',
        '/o/documents/spagreement/edit',
        '/o/documents/payoutCheck',
        '/o/documents/payoutCheck/edit',

        '/o/documents/application',
        '/o/documents/print',

        '/o/animals',
        '/o/animals/create',
        '/o/animals/create-by-id',
        '/o/animals/edit',

        '/o/sellers',
        '/o/sellers/create',
        '/o/sellers/edit',

        '/o/how-to',
        '/o/faq',
        '/o/documents-explanation',

        '/uploads/pricelist.pdf',

        '/css/offline-print.css',

        '/js/app.js',
        '/css/all.css',
        '/css/app.css',
        '/serviceWorker.js',

        '/img/agaras.png',
        '/favicon.ico',

        '/js/from_html.js',
        '/js/html2pdf.js',
        '/js/split_text_to_size.js',
        '/js/standard_fonts_metrics.js',


        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js',
        'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
        'https://fonts.googleapis.com/css?family=Roboto'
    ];

    event.waitUntil(
        caches.open('agaras-static-v1').then(function(cache)
        {
            return cache.addAll(pagesToCache.map(url => new Request(url, {credentials: 'same-origin'})));
        })
    );
});
