<x-header />

<div class="container mt-5">
    <h2 class="mb-4">🛒 My Orders</h2>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table  table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Sr.</th>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Ordered At</th>
                        <th>Summary</th>
                    </tr>
                </thead>
                <tbody>
                    @php $globalSr = 1; @endphp

                    @foreach($orders as $order)
                        @php
                            $orderItems = $items->where('orderId', $order->id);
                            $totalAmount = $orderItems->sum(function($item) {
                                return $item->price * $item->quantity;
                            });
                        @endphp

                        @foreach($orderItems as $item)
                            <tr>
                                <td>{{ $globalSr++ }}</td>
                                <td>#ORD{{ $order->id }}SHOP</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <img src="{{ asset('uploads/' . $item->picture) }}" alt="{{ $item->title }}" width="60" class="img-thumbnail">
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ $item->price }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if ($loop->first)
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#summaryModal{{ $order->id }}">
                                            View Summary
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <!-- Modal for Order Summary -->
                        <div class="modal fade" id="summaryModal{{ $order->id }}" tabindex="-1" aria-labelledby="summaryModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="summaryModalLabel{{ $order->id }}">Order Summary #{{ $order->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach($orderItems as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $item->title }} (x{{ $item->quantity }})
                                                    <span>₹{{ $item->price * $item->quantity }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="mt-3 text-end">
                                            <strong>Total Amount: ₹{{ $totalAmount }}</strong>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            You have not placed any orders yet.
        </div>
    @endif
</div>

<x-footer />
