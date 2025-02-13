const work = () => {
    event.preventDefault();
    let Startlocation = document.getElementById('Startlocation').value;
    let Destination = document.getElementById('Destination').value
    let weight = document.getElementById('weight').value
    let price;
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
    document.getElementById("price").innerText = "Total charges: Rs." + price;
}