@extends('userLayout')
@section('content')
  <div class="calculator-container">
    <div class="calculator">
        <h2>Price Calculator</h2>
        <hr>
        <form action="" method="post">
            <div class="input-field">
                <label for="Startlocation">Select the start Location:*</label>
                <select name="Startlocation" id="Startlocation" required>
                    <option disabled selected>Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field">
                <label for="Destination">Select the Destination:*</label>
                <select name="Destination" id="Destination" required>
                    {{-- <select id="inputState2" name="inputState2" class="form-select" disabled required> --}}
                        <option disabled selected>Select Origin First</option>
                    {{-- </select> --}}
                </select>
            </div>
            <div class="input-field">
                <label for="weight">Enter weight*</label>
                <input type="number" name="weight" id="weight" required>
            </div>
            <div class="input-field">
                <button onclick="work()" id="button">Calculate</button>
                <input id="clear-btn" type="reset" value="Clear">
            </div>

        </form>
        <p id="price">Total charges:</p>
    </div>
</div>
{{-- <script src="{{ URL::asset('assets/script.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch destinations when an origin is selected
        $('#Startlocation').change(function() {
            var origin = $(this).val();

            $('#Destination').prop('disabled', true).html('<option>Loading...</option>');

            if (origin) {
                $.ajax({
                    url: '/get-destinations/' + origin,
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $('#Destination').prop('disabled', false).html(
                                '<option disabled selected>Select City</option>');
                            $.each(data, function(index, city) {
                                $('#Destination').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        } else {
                            $('#Destination').html('<option>No Destinations Available</option>').prop('disabled', true);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            } else {
                $('#Destination').html('<option disabled selected>Select Origin First</option>').prop('disabled', true);
            }
        });

       
        $('#button').click(function(e) {
            e.preventDefault(); 

            var origin = $('#Startlocation').val();
            var destination = $('#Destination').val();
            var weight = $('#weight').val();

            if (origin && destination && weight) {
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
                            $('#price').html(`<strong>Total Price:</strong> ${totalPrice} PKR`);
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
                alert('Please select both origin and destination and enter the weight.');
            }
        });
    });
</script>

@endsection