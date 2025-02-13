@extends('userLayout')
@section('content')
    <div class="container">
        @if ($freights->isEmpty())
            <tr>
                <td colspan="5">
                    <h3>No payments pending for any freight.</h3>
                </td>
            </tr>
        @else
            <table class="table table-hover text-center table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Freight ID:</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Charges</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($freights as $freight)
                        <tr>
                            <th scope="row">{{ $freight->freightID }}</th>
                            <td>{{ $freight->origin }}</td>
                            <td>{{ $freight->destination }}</td>
                            <td>{{ $freight->charges }}</td>
                            @if ($freight->freightStatus === '1')
                                <td>
                                    <form action="{{ route('freight.cancel', $freight->freightID) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to cancel this freight?')">
                                            Cancel
                                        </button>
                                    </form>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $freight->freightID }}">
                                        Pay Now
                                    </button>
                                </td>
                            @else
                                <td>Paid</td>
                            @endif

                        </tr>
                    @endforeach
        @endif
        </tbody>
        </table>

        @foreach ($freights as $freight)
            <div class="modal fade" id="modalId-{{ $freight->freightID }}" tabindex="-1" role="dialog"
                aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="paymentcontainer">
                                <form action="{{ route('doPayments', $freight->freightID) }}" method="POST">
                                    @csrf
                                    <div class="paymenRow">
                                        <div class="paymenCol">
                                            <h3 class="title">Billing Address</h3>
                                            <!-- Billing form fields -->
                                            <div class="inputBox">
                                                <label for="name">Full Name:*</label>
                                                <input type="text" id="name" placeholder="Enter your full name"
                                                    required>
                                            </div>
                                            <div class="inputBox">
                                                <label for="email">Email:*</label>
                                                <input type="text" id="email" placeholder="Enter email address"
                                                    required>
                                            </div>
                                            <div class="inputBox">
                                                <label for="address">Address:*</label>
                                                <input type="text" id="address" placeholder="Enter address" required>
                                            </div>
                                            <div class="inputBox">
                                                <label for="city">City:*</label>
                                                <input type="text" id="city" placeholder="Enter city" required>
                                            </div>
                                        </div>

                                        <div class="paymenCol">
                                            <h3 class="title">Payment</h3>
                                            <!-- Payment form fields -->
                                            <div class="inputBox">
                                                <label for="cardName">Name On Card:*</label>
                                                <input type="text" id="cardName" placeholder="Enter card name" required>
                                            </div>
                                            <div class="inputBox">
                                                <label for="cardNum">Credit Card Number:*</label>
                                                <input type="text" id="cardNum" placeholder="1111-2222-3333-4444"
                                                    maxlength="19" required>
                                            </div>
                                            <div class="inputBox">
                                                <label for="">Exp Month:*</label>
                                                <select required>
                                                    <option value="">Choose month</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <!-- Other months -->
                                                </select>
                                            </div>
                                            <div class="flex">
                                                <div class="inputBox">
                                                    <label for="">Exp Year:*</label>
                                                    <select required>
                                                        <option value="">Choose Year</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <!-- Other years -->
                                                    </select>
                                                </div>
                                                <div class="inputBox">
                                                    <label for="cvv">CVC*</label>
                                                    <input type="number" id="cvv" placeholder="1234" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="paymentbtns">
                                        <button type="button" class="btn btn-secondary" id="cancel-btn"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="submit" name="paynow" value="Pay Now" class="submit_btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
