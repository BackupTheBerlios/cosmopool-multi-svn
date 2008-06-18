var items_array;

function init(items)
{
	items_array = items;
	type_change();
}

function Hinzufuegen () {
  NeuerEintrag = new Option("---", 0, false, false);
  document.forms[1].type.options[document.forms[1].type.length] = NeuerEintrag;
}

function type_change()
{
  // change type field
  var selected = document.forms[1].resdata_cat.value;
  var is_item = false;
  for (var i = 0; i < items_array.length; ++i) {
    if (selected == items_array[i]) is_item = true;
  }
  document.forms[1].type.disabled = !is_item;
  if(is_item == false) {
    Hinzufuegen();
    document.forms[1].type.value = 0;
  }
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