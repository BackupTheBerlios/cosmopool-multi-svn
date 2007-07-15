var items_array;

function init(items)
{
	items_array = items;
	type_change();
}

function type_change()
{
  // change type field
  var selected = document.forms[0].resdata_cat.value;
  var is_item = false;
  for (var i = 0; i < items_array.length; ++i) {
    if (selected == items_array[i]) is_item = true;
  }
  document.forms[0].type.disabled = !is_item;
  
}

function resdata_cat_change(x, res_id)
{
  type_change();  
  
  // add fields, or make visible if they're suposed to be
  top.location.href = "index.php?page=resdata&cat=" + x + "&res_id=" + res_id;
}

function resdata_cat_change_new(x)
{
  type_change();  
  
  // add fields, or make visible if they're suposed to be
  top.location.href = "index.php?page=resdata&cat=" + x;
}

function search_cat_change_new(x)
{
  // add fields, or make visible if they're suposed to be
  top.location.href = "index.php?page=search&cat=" + x;
}