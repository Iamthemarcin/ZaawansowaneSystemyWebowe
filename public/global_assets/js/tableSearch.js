function tableSearch() {
    var input, filter, table, tr, td, i, cell, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {

        tr[i].style.display = "none";

        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            cell = tr[i].getElementsByTagName("td")[j];
            if (cell) {
                if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}


function statusSearch() {
    var filter, table, tr, td, i, cell, j;

    filter = 'NIEAKTYWNA'
    table = document.getElementById("myStatusTable");
    tr = table.getElementsByTagName("tr");

    if (undo == true){
        undo = false;
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                tr[i].style.display = "";
            }
        }
    }




else{

        console.log(undo)
        undo = true;
        for (i = 1; i < tr.length; i++) {





            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                cell = tr[i].getElementsByTagName("td")[j];

                if (cell) {
                    console.log('wtF');
                    if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "none";

                        break;

                    }
                }
            }
        }

    }


}