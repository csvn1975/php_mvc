function createCategoriesSelect(categories, elementID, isRequire = false) {
  var newArray = [];
  var htmlOption = "";

  recursive(categories, 0, 1, newArray);
  function recursive(source, parent, level, newArray) {
    let token = level > 1 ? "&nbsp;&nbsp;".repeat(3 * (level - 1)) : "";
    if (source.length > 0) {
      source.forEach((value, index) => {
        if (value["parent"] == parent) {
          let newParent = value["id"];
          value["level"] = level;
          htmlOption +=
            '<option class="sub-menu' + level + '" value=' + value["id"] + ">";
          htmlOption += token + value["name"] + "</option>";
          recursive(source, newParent, level + 1, htmlOption, newArray);
        }
      });
    }
  }

  var elSelectOption = document.querySelector(elementID);

  if (!!elSelectOption) {
    if (isRequire)
      htmlOption =
        "<option value=-1 selected disabled> Select a category ...</optopn>" +
        htmlOption;
    elSelectOption.innerHTML = htmlOption;
  }
  /* return htmlOption; */
}
