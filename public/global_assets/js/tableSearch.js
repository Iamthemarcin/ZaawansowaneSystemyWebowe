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


function ActiveStatusSearch() {
    var filter, table, tr, td, i, cell, j;

    filter = 'NIEAKTYWNA'
    table = document.getElementById("myStatusTable");
    tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                tr[i].style.display = "";
            }
        }
    }
function FilterStatus(filter) {
    // Declare variables
    var Status_column, filter, table, tr, td, i, txtValue, ths, th;

    filter = filter.toUpperCase();
    table = document.getElementById("myStatusTable");
    ths = table.getElementsByTagName("th");
    for (i = 0; i <ths.length; i++){
        th = ths[i]
        txtValue = th.textContent || th.innerText;
        if(txtValue == 'Status strony'){
            Status_column = i;

        };
    }

    tr = table.getElementsByTagName("tr");


    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];

        if (td) {
            txtValue = td.textContent || td.innerText;
            console.log(txtValue);
            if (txtValue.toUpperCase() == filter) {
                tr[i].style.display = "none";

            } else {
                tr[i].style.display = "";
            }
        }
    }
}


function InactiveStatusSearch() {
    var filter, table, tr, td, i, cell, j;

    filter = 'NIEAKTYWNA'
    table = document.getElementById("myStatusTable");
    tr = table.getElementsByTagName("tr");

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