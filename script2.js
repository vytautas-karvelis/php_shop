class Validator {

  static paragraphs = [{ "id": "SKU", "value": "Please provide data of indicated type (alphanumeric, 8-12 characters)" },
  { "id": "Name", "value": "Please provide data of indicated type (letters)" },
  { "id": "Price", "value": "Please provide data of indicated type (numeric, to 1 or 2 decimal places)" },
  { "id": "Megabytes", "value": "  *Please provide the size in megabytes for the DVD-disc" },
  { "id": "Kilograms", "value": "  *Please provide the weight in kilograms for the book" },
  { "id": "CentimetersH", "value": "" },
  { "id": "CentimetersW", "value": "" },
  { "id": "CentimetersL", "value": "  *Please provide the dimensions in centimeters for the furniture" }
  ]

  static regexPatterns = {
    SKU: /^[\dA-Z]{8,12}$/,
    Name: /^[a-z]{1,30}$/i,
    Price: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/,
    Megabytes: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/,
    Kilograms: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/,
    Type: /^(Book|Furniture|DVD-disc)$/,
    CentimetersL: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/,
    CentimetersW: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/,
    CentimetersH: /(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/
  }

  static validateInputs(field, regex) {

    if (regex.test(field.value)) {
      if (field.classList.contains("error")) {
        field.classList.remove("error")
      }
      field.classList.remove("empty")
      field.classList.add("success")
      if (field.id == "Megabytes" || field.id == "Kilograms" || field.id == "CentimetersL") {
        field.nextElementSibling.innerHTML = this.searchParagraphs(field.id)
      } else if (field.id == "CentimetersH" || field.id == "CentimetersW" || field.id == "Type") {
        field.nextElementSibling.innerHTML = ""
      }
    } else {
      if (field.value.length == 0) {
        field.classList.remove("success")
        field.classList.remove("error")
        field.classList.add("empty")
        field.nextElementSibling.innerHTML = "Cannot be empty"
      } else if (field.value.length != 0) {
        field.classList.remove("empty")
        field.classList.remove("success")
        field.classList.add("error")
        field.nextElementSibling.innerHTML = this.searchParagraphs(field.id)
      }
    }
  }

  static searchParagraphs(id) {
    let val = "not found"
    this.paragraphs.forEach((object) => {
      if (object.id == id) {
        val = object["value"]
      }
    })
    return val
  }

  static checkBeforeAdd(selectedInputs) {

    let pass = true
    selectedInputs.forEach((input) => {
      if (input.value.length == 0 && !input.classList.contains("empty")) {
        input.classList.add("empty")
        input.nextElementSibling.innerHTML = "Cannot be empty"
        pass = false
      }
      if (input.classList.contains("empty")) {
        pass = false
      }
      if (input.classList.contains("error")) {
        pass = false
      }
    })
    if (pass == true) {
      const mainForm = document.getElementById("productForm")
      mainForm.submit()
    }
  }

} //end of class validator


class Inputs {

  constructor() {
    this.DVDDiv = document.getElementById("DVDDiv")
    this.bookDiv = document.getElementById("bookDiv")
    this.furnitureDiv = document.getElementById("furnitureDiv")
    this.saveButton = document.getElementById("buttonSave")
    this.selectInput = document.getElementById("Type")
    this.kgInput = document.getElementById("Kilograms")
    this.mbInput = document.getElementById("Megabytes")
    this.cmHInput = document.getElementById("CentimetersH")
    this.cvWInput = document.getElementById("CentimetersW")
    this.cmLInput = document.getElementById("CentimetersL")
    this.specialInputs = Array.from(document.getElementsByClassName("specialInput"))
    this.allInputs = Array.from(document.getElementsByTagName("input"))
    this.DVDDiv.style.display = "none"
    this.bookDiv.style.display = "none"
    this.furnitureDiv.style.display = "none"
    this.selectInput.selectedIndex = -1
    this.selectInput.addEventListener("change", this.selectHandler.bind(this))
    this.saveButton.addEventListener("click", this.saveButtonHandler.bind(this))

    this.allInputs.forEach((input) => {
      input.addEventListener("keyup", (e) => {
        Validator.validateInputs(input, Validator.regexPatterns[input.id])
      })
    })
  }

  selectHandler() {
    var selected = document.getElementById("Type").value;
    Validator.validateInputs(this.selectInput, Validator.regexPatterns["Type"])

    if (selected == "Book") {
      this.DVDDiv.style.display = "none"
      this.bookDiv.style.display = "block"
      this.furnitureDiv.style.display = "none"
      this.setSelected(["Kilograms"])
    } else if (selected == "Furniture") {
      this.DVDDiv.style.display = "none"
      this.bookDiv.style.display = "none"
      this.furnitureDiv.style.display = "block"
      this.setSelected(["CentimetersH", "CentimetersW", "CentimetersL"])
    } else if (selected == "DVD-disc") {
      this.DVDDiv.style.display = "block"
      this.bookDiv.style.display = "none"
      this.furnitureDiv.style.display = "none"
      this.setSelected(["Megabytes"])
    }
  }

  setSelected(ids) {
    this.specialInputs.forEach((input) => {
      if (input.classList.contains("selected")) {
        input.classList.remove("selected")
      }
    })
    ids.forEach(element => {
      const el = document.getElementById(element)
      el.classList.add("selected")
    });
  }

  saveButtonHandler() {
    let selectedInputs = Array.from(document.getElementsByClassName("selected"))
    Validator.checkBeforeAdd(selectedInputs)
  }

} //end of class Inputs


new Inputs()











