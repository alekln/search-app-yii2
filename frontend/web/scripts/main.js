$(document).on('click', ".regionDDList a", function () {
    updateDropDownTrigger(this)
});

$(document).on('mouseover', ".dropdown-menu a.dropdown-toggle", function () {
    // noinspection JSValidateTypes
    var $el = $(this), $parent = $el.offsetParent(".dropdown-menu"), $subMenu, $subMenuParent;
    if (!$el.next().hasClass('show')) {
        $el.parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    $subMenu = $el.next(".dropdown-menu").toggleClass('show');
    $subMenuParent = $subMenu.closest('.dropdown');
    $subMenuParent.closest('.dropdown-menu').find('.dropdown').each(function () {
        var $el = $(this);
        if (!$el.is($subMenuParent)) {
            $el.removeClass('is-expanded');
        }
    });
    $subMenuParent.toggleClass('is-expanded');
    $el.parent("li.nav-item").toggleClass('show');
    $el.parents('.dropdown.show').on('hidden.bs.dropdown', function () {
        $('.dropdown-menu .show').removeClass("show");
        $('.dropdown-menu .is-expanded').removeClass("is-expanded");
    });
    $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
    return false;
});

$("document").ready(function() {
    /* description > pjax whole page reload fix */
    $.pjax.defaults.timeout = 5000;

    $('.regionDDList a').on('click', function () {
        updateDropDownTrigger(this)
    });

    /* description > pjax whole page reload fix */
});

function updateDropDownTrigger(el){
    // e.preventDefault();

    $('.regionDDList').removeClass('show').hide();

    let r = $(el).attr('data-region'),
        p = $(el).attr('data-province'),
        m = $(el).attr('data-municipality'),
        fn = $(el).attr('data-fullname'),
        $dd = $('#dropdownMenuButton'),
        $ddQuery = $('input#employeequery-address_query');

    $('input#employeequery-address_region').val(r).trigger('change');

    if(p !==null && p !== undefined){
        $('input#employeequery-address_province').val(p).trigger('change');
    }else{
        $('input#employeequery-address_province').val('').trigger('change');
    }
    if(m !==null && m !== undefined){
        $('input#employeequery-address_municipality').val(m).trigger('change');
    }else{
        $('input#employeequery-address_municipality').val('').trigger('change');
    }

    $dd.html(fn);

    $ddQuery.val(fn);
}

    /* export csv functionality 
    * @url is controller url
    * @identifier - form for serialization of attributes 
    */
window.exportCSV = function(url, identifier){
        
    let formData = url + '?' + $(identifier).serialize();
        
    window.open(window.location.origin + formData);
        
};

window.tempStorage = [];

window.updateDropDown = function(rest, $dependentDD, addPrompt){

    if (window.tempStorage[rest] !== undefined) {
        return $dependentDD.html(window.tempStorage[rest]);
    }

    $.post(rest , function( response ) {

        if(response !== null ){
            let intervals= [];
            let options

            if(addPrompt !== null && addPrompt === true){
                options = `<option/>`;
            }

            for(let i = 0; i < response.length; i++){
                let rec = response[i];
                options += `<option value="` + rec.id  + `">` + rec.name + `</option>`;
            }

            if(response.length > 0){
                window.tempStorage[rest] = options;
                $dependentDD.html(options);
            }else{
                $dependentDD.empty();
            }

        }
    });
}
window.activeInstitueXhr = null;
window.updateAutocomplete = function(rest){
    if(window.activeInstitueXhr !== null){
        window.activeInstitueXhr.abort();
    }
    $dependentDD = $("#institutionList");
    let r = $("input#employeequery-address_region").val(),
        p = $("input#employeequery-address_province").val(),
        m = $("input#employeequery-address_municipality").val(),
        it = $("#employeequery-institution_type").val(),
        im = $("employeequery-institution_mode").val();

    $dependentDD.empty();

    window.activeInstitueXhr = $.post(rest , {'r':r, 'p':p, 'm':m, 'it':it, 'im':im}, function( response ) {

        window.activeInstitueXhr = null;

        if(response !== null ){
            let intervals= [];
            let options

            for(let i = 0; i < response.length; i++){
                let rec = response[i];
                options += `<option value="` + rec.name  + `">`;
            }

            if(response.length > 0){
                $dependentDD.html(options);
            }else{
                $dependentDD.empty();
            }

        }
    });
}