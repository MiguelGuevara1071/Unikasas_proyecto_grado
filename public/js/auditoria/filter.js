function filterdata() {
  // Declare variables
  var input, filter, table, tr, tdUser, tdModulo, tdAccion, tdItem, tdFecha, txtValueUser, txtValueModulo, txtValueAccion, txtValueItem, txtValueFecha;
  input = document.getElementById("filter");
  filter = input.value.toUpperCase();
  table = document.getElementById("tableAudit");
  tr = document.querySelectorAll(".tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    tdUser = tr[i].getElementsByTagName("td")[0]
    tdModulo = tr[i].getElementsByTagName("td")[1]
    tdAccion = tr[i].getElementsByTagName("td")[2]
    tdItem = tr[i].getElementsByTagName("td")[3]
    tdFecha = tr[i].getElementsByTagName("td")[4]
    if (tdUser || tdModulo || tdAccion || tdItem || tdFecha) {
        txtValueUser = tdUser.textContent || tdUser.innerText;
        txtValueModulo = tdModulo.textContent || tdModulo.innerText;
        txtValueAccion = tdAccion.textContent || tdAccion.innerText;
        txtValueItem = tdItem.textContent || tdItem.innerText;
        txtValueFecha = tdFecha.textContent || tdFecha.innerText;
        if (txtValueUser.toUpperCase().indexOf(filter) > -1 || txtValueModulo.toUpperCase().indexOf(filter) > -1 || txtValueAccion.toUpperCase().indexOf(filter) > -1 || txtValueItem.toUpperCase().indexOf(filter) > -1 || txtValueFecha.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
  }
}
