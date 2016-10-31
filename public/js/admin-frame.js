var scriptTag = document.getElementById('scriptTag');
if (scriptTag) {
    requirejs.config({
        paths: {
            jquery: 'lib/jquery/jquery-2.1.1.min',
            bootstrap: 'lib/bootstrap/bootstrap.min',
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
