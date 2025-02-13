@extends('userLayout')
@section('content')
    @if (session('freightID'))
        <div id="booking-alert">
            <div class="alert alert-success alert-dismissible" role="alert">
                Freight booked successfully!
                Your freight ID is: {{ session('freightID') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="book-freights-form-container">
        <form class="row g-3 book-freights-form justify-content-center" method="POST" id="freightForm">
            @csrf
            <h2 class="text-center">Fill the form to book Freight</h2>
            <div class="col-md-5">
                <label for="date" class="form-label">Enter Your date to reserved freight*</label>
                <input type="date" name="date" class="form-control" id="date" required />
            </div>

            <div class="col-md-5">
                <label for="weight" class="form-label">Weight*</label>
                <input type="number" name="weight" class="form-control" id="weight" required />
            </div>

            <div class="col-md-5">
                <label for="inputState1" class="form-label">Origin*</label>
                <select id="inputState1" name="inputState1" class="form-select" required>
                    <option disabled selected>Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <label for="inputState2" class="form-label">Destination*</label>
                <select id="inputState2" name="inputState2" class="form-select" disabled required>
                    <option disabled selected>Select Origin First</option>
                </select>
            </div>

            <div class="col-5">
                <label for="inputAddress2" class="form-label">Origin Complete Address*</label>
                <textarea class="form-control booking-address" name="originAddress" id="inputAddress2" rows="3" required></textarea>
            </div>
            <div class="col-5">
                <label for="inputAddress" class="form-label">Destination Complete Address*</label>
                <textarea class="form-control booking-address" name="destinationAddress" id="inputAddress" rows="3" required></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="button" name="book" class="btn btn-danger" id="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Book now
                </button>
            </div>
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Your Booking</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('freightBooking') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="modal-body" id="modalBody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="confirm" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#inputState1').change(function() {
                var origin = $(this).val();

                $('#inputState2').prop('disabled', true).html('<option>Loading...</option>');

                if (origin) {
                    $.ajax({
                        url: '/get-destinations/' + origin,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                $('#inputState2').prop('disabled', false).html(
                                    '<option disabled selected>Select City</option>');

                                $.each(data, function(index, city) {
                                    $('#inputState2').append('<option value="' + city
                                        .id + '">' + city.name + '</option>');
                                });
                            } else {
                                $('#inputState2').html(
                                    '<option>No Destinations Available</option>').prop(
                                    'disabled', true);
                            }
                        },
                        error: function() {
                            alert('An error occurred. Please try again.');
                        }
                    });
                } else {
                    $('#inputState2').html('<option disabled selected>Select Origin First</option>').prop(
                        'disabled', true);
                }
            });

            $('#button').click(function() {
                var origin = $('#inputState1').val();
                var destination = $('#inputState2').val();
                var date = $('#date').val();
                var weight = $('#weight').val();
                var originAddress = $('#inputAddress2').val();
                var destinationAddress = $('#inputAddress').val();

                if (origin && destination) {
                    $.ajax({
                        url: '{{ route('getFreightPrice') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            origin: origin,
                            destination: destination
                        },
                        success: function(response) {
                            if (response.success) {
                                var price = response.price;
                                var totalPrice = price * weight;
                                var modalContent = `
                                <p><strong>Booking Details:</strong></p>
                                <p><strong>Origin:</strong> ${originAddress} </p>
                                <p><strong>Destination:</strong> ${destinationAddress}</p>
                                <p><strong>Date:</strong> ${date}</p>
                                <p><strong>Weight:</strong> ${weight} kg</p>
                                <p><strong>Total Price:</strong> ${totalPrice} PKR</p>
                                <p>Do you want to confirm this booking?</p>
                            `;
                                $('#modalBody').html(modalContent);


                                $('#modalBody').append(`
                                <input type="hidden" name="originAddress" value="${originAddress}">
                                <input type="hidden" name="destinationAddress" value="${destinationAddress}">
                                <input type="hidden" name="weight" value="${weight}">
                                <input type="hidden" name="price" value="${totalPrice}">
                                <input type="hidden" name="date" value="${date}">
                                <input type="hidden" name="originCityId" value="${origin}">
                                <input type="hidden" name="destinationCityId" value="${destination}">
                            `);
                                $('#exampleModal').modal('show');
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            alert('An error occurred while fetching the freight price.');
                        }
                    });
                } else {
                    alert('Please select both origin and destination.');
                }
            });

           
            

            
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('min', today);


            var button = document.getElementById("button");
            var formInputs = document.querySelectorAll(
                "#freightForm input, #freightForm select, #freightForm textarea");
            button.disabled = true;

            function checkFormInputs() {
                var allFilled = true;
                formInputs.forEach(function(input) {
                    if (input.value === "") {
                        allFilled = false;
                    }
                });
                return allFilled;
            }

            formInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    button.disabled = !checkFormInputs();
                });
            });
        });
    </script>


@endsection
