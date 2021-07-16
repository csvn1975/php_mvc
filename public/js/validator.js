"use strict";

function validator(formSelecter) {
  const defaultMessage = "Bitte geben Sie einen Eintrag ein.";
  /**
   * damit z.B die function formElement.onsubmit  key word this (validator) zugreifen kann
   * formRules: jeder Input  ist ein array {feld1 : [..], Feld2 : [...] }
   */
  let _this = this;

  var formRules = {};

  /* rule-functions */
  var validatorRules = {
    /** pflichtfeld input */
    required: function (value, msg = "") {
      return value ? undefined : msg || defaultMessage;
    },

    /* Price 2 decimal */
    price: (value, msg = "") => {
      let regex = /^(\d)+([\,]\d{1,2})*$/;
      return regex.test(value)
        ? undefined
        : msg || "Bitte geben Sie einen gültigen Preis ein. ";
    },

    /* Number */
    number: (value, msg = "") => {
      let regex = /^([+|-])*(\d)+$/;
      return regex.test(value)
        ? undefined
        : msg || "Bitte geben Sie eine Zahl ein. ";
    },
    
  
    email: (value, msg = "") => {
      let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value)
        ? undefined
        : msg || "Bitte geben Sie eine gültige Email ein. ";
    },

    min: function (min) {
      return function (value) {
        return value.length >= min
          ? undefined
          : msg || `Bitte geben Sie mindesten ${min} Zeichen ein.`;
      };
    },

    max: function (max) {
      return function (value) {
        return value.length <= max
          ? undefined
          : msg ||`Bitte geben Sie maximal nur ${min} Zeichen ein.`;
      };
    },

    confirm: function (compare) {  
      var elCompare = formElement.querySelector("[name=" + compare + "]");
      return function (value) {
        return (elCompare && value == elCompare.value)
          ? undefined
          : msg ||'Die Bestätigungspasswort stimmt nicht überein';
      };
    },
  };

  var formElement = document.querySelector(formSelecter);
  var inputs;

  // wenn form nicht vorhanden ist, dann return
  if (!formElement) return;

  /** alle rules von Input-Elements mit attributtes name und rules holen
   * setzen in object formRules {array [name: function], ...}
   */

  inputs = formElement.querySelectorAll("[name][rules]");

  for (var input of inputs) {
    // string mit | to array
    var rules = input.getAttribute("rules").split("|");

    for (var rule of rules) {
      var ruleFunction;

      if (rule.includes(":")) {
        let ruleParam;
        //z.B rule= min:6 => ruleParam = ['min', '6']
        ruleParam = rule.split(":");
        rule = ruleParam[0];
        ruleFunction = validatorRules[rule](ruleParam[1]);

      } else ruleFunction = validatorRules[rule];

      if (Array.isArray(formRules[input.name]))
        formRules[input.name].push(ruleFunction);
      else formRules[input.name] = [ruleFunction];
    }

    if (input.nodeName === "FILE")
      input.addEventListener("change", handleValidate);
    else input.addEventListener("blur", handleValidate);
  }

  /* suchen 1. parent-element von input */
  function getParent(element, selector) {
    //solange Element Parent hat
    element = element.parentElement;
    while (element) {
      if (element.matches(selector)) return element;
    }
  }

  function showErrorMessage(error, element, selector) {
    const msgSelector = ".form-message";
    let formGroup = getParent(element, selector);
    if (!formGroup) return;

    if (error) formGroup.classList.add("invalid");
    else if (formGroup.classList.contains("invalid"))
      formGroup.classList.remove("invalid");

    /* show form-message */
    let formMessage = formGroup.querySelector(msgSelector);
    if (formMessage) {
      formMessage.innerText = error ? formMessage.innerText || error : "";
    }
  }

  /* validate input  */
  function handleValidate(event) {
    const selector = ".form-group";

    let target = event.target;
    let ruleFunctions = formRules[target.name];
    let errorMessage;

    /* value of input */
    let value;
    switch (target.nodeName) {
      case "LABEL":
        value = target.innerText;
        break;
      default:
        value = target.value;
        break;
    }
    // alle input prüfen
    for (var ruleFunction of ruleFunctions) {
      errorMessage = ruleFunction(value);
      if (errorMessage != undefined) break;
    }

    showErrorMessage(errorMessage, target, selector);

    return !errorMessage;
  }

  /* form-submit */
  formElement.onsubmit = function (event) {
    var isValid = true;
    for (input of inputs) {
      // zuweisen als Event: Event = {target: input}
      if (!handleValidate({ target: input, test: input })) isValid = false;
    }

    // Wenn Validate nicht in Ordnung ist, dann submit gespert wird
    if (!isValid) event.preventDefault();

    if (_this.onsubmit) {
      let formData = getFormData();
      _this.onsubmit(formData);
    }
  };

  /* return form-data aufbauen */
  function getFormData() {
    let enableInputs = formElement.querySelectorAll("[name]");
    let result = Array.from(enableInputs).reduce(function (values, input) {
      let keyName = input.name;
      switch (input.type) {
        case "radio":
          var radioInput = formElement.querySelector(
            'input[name="' + keyName + '"]:checked'
          );
          values[keyName] = radioInput ? radioInput.value : "";
          break;
        case "checkbox": // array in objects
          var value = input.matches(":checked") ? input.value : "";
          if (value) {
            if (!Array.isArray(values[keyName])) values[keyName] = [value];
            else values[keyName].push(value);
          }

          if (!Array.isArray(values[keyName])) values[keyName] = [];

          break;

        case "file":
          values[keyName] = input.files;
          break;

        case "select-one":
          values[keyName] = input.value;
          break;

        case "select-multiple":
          //  object von array
          for (var option of input.options) {
            if (option.selected) {
              if (Array.isArray(values[keyName]))
                values[keyName].push(option.value);
              else values[keyName] = [option.value];
            }
          }

          if (!values[keyName]) values[keyName] = [];
          break;

        default:
          values[keyName] = input.value;
      }
      return values;
    }, {});
    return result;
  }
}
