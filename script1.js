class DeleteProducts {

    constructor() {
        this.deleteButton = document.getElementsByClassName("buttonMD")[0]
        this.deleteButton.addEventListener('click', this.deleteSelected)        
    }

    deleteSelected() {
        let delCheckboxes = [];
        let checkboxes = document.getElementsByClassName("checkbox")
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
                delCheckboxes.push(checkboxes[i].value)
            }
        }

        if(delCheckboxes.length == 0){
            return;
        }
        
        let str = delCheckboxes.join("x")
        console.log(str)
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "product_delete.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.onreadystatechange = function (){
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
                window.location.href='index.php'
            }
        }
        xhttp.send("d="+str);
    }
}

new DeleteProducts()