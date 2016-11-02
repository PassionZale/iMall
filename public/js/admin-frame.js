var scriptTag = document.getElementById('scriptTag');
if (scriptTag) {
    requirejs.config({
        paths: {
            jquery: '//cdn.bootcss.com/jquery/2.2.1/jquery.min',
            bootstrap: '//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min',
            metisMenu:'//cdn.bootcss.com/metisMenu/2.5.2/metisMenu.min'
        },
        shim: {
            'jquery': {
                exports: '$'
            },
            'bootstrap': {
                deps: ['jquery']
            },
            'metisMenu':{
                deps:['jquery']
            }
        },
        urlArgs: "bust=" + (new Date()).getMonth().toString() + (new Date()).getDay().toString() + (new Date()).getHours().toString(),
        xhtml: true
    });
    requirejs([scriptTag.innerHTML]);
}
