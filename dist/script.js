const confirmAction = (action) => {
  let confirmation;

  if (action === "create") {
    confirmation = confirm(
      "Are you sure you want to add the item to the inventory?"
    );
  } else if (action === "delete") {
    confirmation = confirm(
      "Are you sure you want to delete this item from the inventory?"
    );
  } else {
    confirmation = confirm("Are you sure you want to perform this action?");
  }

  return confirmation;
};
