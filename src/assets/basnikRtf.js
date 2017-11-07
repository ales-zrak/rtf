// uses https://simplemde.com

;(function(){

    // from https://stackoverflow.com/questions/359788/how-to-execute-a-javascript-function-when-i-have-its-name-as-a-string
    function executeFunctionByName(functionName) {
        var namespaces = functionName.split(".");
        var func = namespaces.pop();
        var context = window;
        for(var i = 0; i < namespaces.length; i++) {
            context = context[namespaces[i].trim()];
        }
        return context[func].apply(context);
    }


    // from https://stackoverflow.com/questions/171251/how-can-i-merge-properties-of-two-javascript-objects-dynamically
    function mergeSettings(options, defaults){
        for (var key in defaults) {
            options[key] = defaults[key];
        }
        return options;
    }


    document.querySelectorAll(".js-basnikRtf").forEach(function(editorItem){

        var optionCallback = editorItem.getAttribute("data-js-option-callback");
        var usrOptions = {};
        if(optionCallback){
            usrOptions = executeFunctionByName(optionCallback);
        }

        var options = {
            element: editorItem,
            status: false,
            spellChecker: false
        };
        new SimpleMDE(mergeSettings(usrOptions, options));
    });

}());