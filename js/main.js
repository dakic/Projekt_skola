jQuery(document).ready(function(){
    $("table").tablesorter({
        widthFixed: true,
        headers: {
            4:{
                sorter: false
            },
            5:{
                sorter: false
            }
        }
    });
});
