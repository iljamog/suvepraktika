// abiks kasutatud 
// https://www.encodedna.com/javascript/dynamically-add-remove-rows-to-html-table-using-javascript-and-save-data.htm
// ridade lisamine tabelisse

function addRow(tableId, columns, nameForCell) {
    var theTable = document.getElementById(tableId).getElementsByTagName('tbody')[0];

    var rowCount = theTable.rows.length;   // ridade arv
    var tr = theTable.insertRow(rowCount); // rea lisamine viimase rea järel
    tr = theTable.insertRow(rowCount);

    for (var c = 0; c <= columns; c++) {
        var td = document.createElement('td');
        td = tr.insertCell(c);

        if (c == columns) {      // viimane tulp
            // paigutame sinna nupu kustutamiseks
            var button = document.createElement('input');

            // nupu atribuudid
            button.setAttribute('type', 'button');
            button.setAttribute('value', 'Kustuta');
            button.setAttribute('class', 'btn btn-danger');
            button.setAttribute('onclick', 'removeRow(this)');

            td.appendChild(button);
        
        } else { // ülejäänud lahtritesse textarea
            
            var ele = document.createElement('textarea');
            ele.setAttribute('type', 'textarea');
            ele.setAttribute('class' , 'form-control');
            ele.setAttribute('id' , 'generated_cell');
            ele.setAttribute('name' , nameForCell);
            ele.setAttribute('rows', '2');
            ele.setAttribute('form', 'register_form');
            td.appendChild(ele);
        }
    }
}

// rea kustutamine
function removeRow(oButton) {
    var theTableId = oButton.parentNode.parentNode.parentNode.parentNode.id;
    var theTable = document.getElementById(theTableId);
    console.log(theTable);
    theTable.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
}