const confirmSubmit = () =>
  confirm("Are you sure you want to submit the form?");

const confirmDelete = () =>
  confirm("Are you sure you want to delete this record?");

function filterTable() {
  const input = document.getElementById("searchInput");
  const filter = input.value.toUpperCase();
  const table = document.getElementsByTagName("table")[0];
  const rows = table.getElementsByTagName("tr");

  for (let i = 0; i < rows.length; i++) {
    const brandColumn = rows[i].getElementsByTagName("td")[2];
    const itemNameColumn = rows[i].getElementsByTagName("td")[1];
    if (brandColumn || itemNameColumn) {
      const brandValue = brandColumn.innerText || brandColumn.textContent;
      const itemNameValue =
        itemNameColumn.innerText || itemNameColumn.textContent;
      if (
        brandValue.toUpperCase().indexOf(filter) > -1 ||
        itemNameValue.toUpperCase().indexOf(filter) > -1
      ) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }
}
