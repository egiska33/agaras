$( document ).ready(function() {
    swController.register();
});

window.swController = {
    register: function()
    {
        if(!navigator.serviceWorker) return;

        let currUrl = window.location.href.split('/');
        if(currUrl[currUrl.length - 1] !== 'login') navigator.serviceWorker.register('/serviceWorker.js');
    }
};
