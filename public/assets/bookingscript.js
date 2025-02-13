document.addEventListener('DOMContentLoaded', function() {
        var button = document.getElementById("button");
        var formInputs = document.querySelectorAll("#freightForm input, #freightForm select, #freightForm textarea");

    // Disable the button by default
    button.disabled = true;

    // Function to check if all form inputs are filled
    function checkFormInputs() {
        var allFilled = true;
        formInputs.forEach(function(input) {
            if (input.value === "") {
                allFilled = false;
            }
        });
        return allFilled;
    }

    // Add event listeners to form inputs to check for changes
    formInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            if (checkFormInputs()) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        });
    });
});

// Rest of your JavaScript code

        document.getElementById("exampleModal").addEventListener('show.bs.modal', function (event) {
            // Get form data
            var formData = new FormData(document.getElementById("freightForm"));
            var modalBody = document.getElementById("modalBody");
            let Startlocation = formData.get("inputState2");
            let Destination = formData.get("inputState1");
            let weight = formData.get("weight");
            
            var price = 0;

            
            if (Startlocation == Destination) {
            price = 0;
    }
    else if (Startlocation == 'Lahore') {
        switch (Destination) {
            case 'Karachi':
                price = weight * 450;
                break;
            case 'Multan':
                price = weight * 270;
                break;
            case 'Peshawar':
                price = weight * 350;
                break;
            case 'Faislabad':
                price = weight * 250;
                break;
            case 'Islamabad':
                price = weight * 300;
                break;
            case 'Sialkot':
                price = weight * 200;
                break;
        }
    }
    else if (Startlocation == 'Karachi'){
        switch (Destination){
            case 'Lahore':
                price = weight * 450;
                break;
            case 'Multan':
                price = weight * 350;
                break;
            case 'Peshawar':
                price = weight * 800;
                break;
            case 'Faislabad':
                price = weight * 600;
                break;
            case 'Islamabad':
                price = weight * 700;
                break;
            case 'Sialkot':
                price = weight * 550;
                break;
        }
    }
    else if (Startlocation == 'Multan'){
        switch (Destination){
            case 'Lahore':
                price = weight * 270;
                break;
            case 'Karachi':
                price = weight * 350;
                break;
            case 'Peshawar':
                price = weight * 450;
                break;
            case 'Faislabad':
                price = weight * 300;
                break;
            case 'Islamabad':
                price = weight * 350;
                break;
            case 'Sialkot':
                price = weight * 250;
                break;
        }
    }
    else if (Startlocation == 'Peshawar'){
        switch (Destination){
            case 'Lahore':
                price = weight * 350;
                break;
            case 'Karachi':
                price = weight * 800;
                break;
            case 'Multan':
                price = weight * 300;
                break;
            case 'Faislabad':
                price = weight * 260;
                break;
            case 'Islamabad':
                price = weight * 220;
                break;
            case 'Sialkot':
                price = weight * 280;
                break;
        }
    }
    else if (Startlocation == 'Faislabad'){
        switch (Destination){
            case 'Lahore':
                price = weight * 250;
                break;
            case 'Karachi':
                price = weight * 600;
                break;
            case 'Multan':
                price = weight * 300;
                break;
            case 'Peshawar':
                price = weight * 260;
                break;
            case 'Islamabad':
                price = weight * 220;
                break;
            case 'Sialkot':
                price = weight * 180;
                break;
        }
    }
    else if (Startlocation == 'Islamabad'){
        switch (Destination){
            case 'Lahore':
                price = weight * 300;
                break;
            case 'Karachi':
                price = weight * 700;
                break;
            case 'Multan':
                price = weight * 350;
                break;
            case 'Peshawar':
                price = weight * 220;
                break;
            case 'Faislabad':
                price = weight * 320;
                break;
            case 'Sialkot':
                price = weight * 330;
                break;
        }
    }
    else if (Startlocation == 'Sialkot'){
        switch (Destination){
            case 'Lahore':
                price = weight * 200;
                break;
            case 'Karachi':
                price = weight * 550;
                break;
            case 'Multan':
                price = weight * 250;
                break;
            case 'Peshawar':
                price = weight * 280;
                break;
            case 'Faislabad':
                price = weight * 180;
                break;
            case 'Islamabad':
                price = weight * 330;
                break;
        }
    }
    
             var content = "<p><strong>Origin Complete Address:</strong></p>" +
                          "<input type='text' class='testing' name='origin1' value='"+formData.get("originAddress")+"' />" +
                          "<p><strong>Origin city:</strong></p>" +
                          "<input type='text' class='testing' name='origin2' value='"+formData.get("inputState1")+"' />" +
                          "<p><strong>Destination Complete address:</strong></p>" +
                          "<input type='text' class='testing' name='destination1' value='"+ formData.get("destinationAddress")+"' />" +
                          "<p><strong>Destination city:</strong></p>" +
                          "<input type='text' class='testing' name='destination2' value='"+ formData.get("inputState2")+"' />" +
                          "<p><strong>Date:</strong></p>" +
                          "<input type='text' class='testing' name='date1' value='"+ formData.get("date")+"' />" +
                          "<p><strong>Price:</strong></p>" +
                          "<input type='text' class='testing' name='price1' value='"+ price +"'/>" +
                          "<p><strong>Weight:</strong></p>" +
                          "<input type='text' class='testing' name='weight1' value='"+ weight+"' />";
            modalBody.innerHTML = content;
            document.getElementById("confirmButton").addEventListener('click', function() {
            document.getElementById("freightForm").submit();
           
        });
        alert(Startlocation); 
        });