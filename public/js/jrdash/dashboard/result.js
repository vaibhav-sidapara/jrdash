var Result = function() {

    // ------------------------------------------------------------------------
    var error1 = [];
    var success1 = [];
    this.__construct = function() {
        console.log('Result Created');

    };
    
    // ------------------------------------------------------------------------
    
    this.success = function(msg) {
        $('#success_alert').fadeIn(1000).removeClass('hidden');
        success1.push(msg);
        var output = '<ul>';
        for(var key in success1){
            output += '<li id="success'+ key +'">'+ success1[key] + '</li>';
            setTimeout(function(){
                $('#success'+key).fadeOut(1000);
                success1.shift();
                if (success1.length === 0) {
                    setTimeout(function(){
                        $('#success_alert').fadeOut(1000);
                    }, 1000);
                };
            }, 4000);
        }
        output += '</ul>';
        $('#success_alert').html(output);

        //console.log('success');
        //console.log(success1);
    };
    
    // ------------------------------------------------------------------------
    
    this.error = function(o) {
        $('#error_alert').fadeIn(1000).removeClass('hidden');
        for(var key1 in o.error){
            error1.push(o.error[key1]);
        }
        var output = '<ul>';
        for(var key in error1){
            output += '<li id="error'+ key +'">'+ error1[key] + '</li>';
            setTimeout(function(){
                $('#error'+key).fadeOut(1000);
                error1.shift();
                if (error1.length === 0) {
                    setTimeout(function(){
                        $('#error_alert').fadeOut(1000);
                    }, 1000);
                };
            }, 4000);
        }
        output += '</ul>';
        $('#error_alert').html(output);

        //console.log('aa'+error1.length);
        //console.log(o.error);
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
