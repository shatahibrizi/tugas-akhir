@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])

  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
  </div>
  <!-- Single Page Header End -->

  <!-- Cart Page Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col" style="width: 15%;" class="text-center">Products</th>
              <th scope="col" style="width: 30%;" class="text-center">Name</th>
              <th scope="col" style="width: 15%;" class="text-center">Price</th>
              <th scope="col" style="width: 15%;" class="text-center">Quantity</th>
              <th scope="col" style="width: 15%;" class="text-center">Total</th>
              <th scope="col" style="width: 10%;" class="text-center">Handle</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @php $total = 0 @endphp
            @if (session('cart'))
              @foreach (session('cart') as $id_produk => $details)
                <tr rowId="{{ $id_produk }}">
                  <th scope="row">
                    <div class="d-flex align-items-center">
                      <img src="{{ asset('storage/foto_produk/' . $details['foto_produk']) }}"
                        class="img-fluid mx-auto rounded" style="width: 80px; height: 80px;" alt="">
                    </div>
                  </th>
                  <td>
                    <p class="mb-0">{{ $details['nama_produk'] }}</p>
                  </td>
                  <td>
                    <p class="mb-0">Rp. {{ number_format($details['harga'], 0, ',', '.') }}</p>
                  </td>
                  <td class="ps-4">
                    <div class="input-group quantity" style="width: 120px;">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                          <i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <input type="text" class="form-control form-control-sm quantity-input border-0 text-center"
                        data-id="{{ $id_produk }}" data-price="{{ $details['harga'] }}"
                        value="{{ $details['quantity'] }}">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="total-price mb-0">
                      Rp.{{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</p>
                  </td>
                  <td class="text-center">
                    <a class="btn btn-outline-danger btn-sm delete-product"
                      style="font-size: 1rem; padding: .5rem 1rem;"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <div class="mt-5">
        <input type="text" class="border-bottom mb-4 me-5 rounded border-0 py-3" placeholder="Coupon Code">
        <button class="btn border-secondary rounded-pill text-primary px-4 py-3" type="button">Apply Coupon</button>
      </div>
      <div class="row g-4 justify-content-end">
        <div class="col-8"></div>
        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
          <div class="bg-light rounded">
            <div class="p-4">
              <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
              <div class="d-flex justify-content-between mb-4">
                <h5 class="mb-0 me-4">Subtotal:</h5>
                <p class="subtotal mb-0">Rp.{{ number_format($total, 0, ',', '.') }}</p>
              </div>
              <div class="d-flex justify-content-between mb-4">
                <h5 class="mb-0 me-4">Shipping</h5>
                <div class="">
                  <p class="mb-0">Flat rate: Rp.30,000</p>
                </div>
              </div>
              @if ($alamat)
                <div class="d-flex justify-content-between">
                  <h5>Alamat:</h5>
                  <p>{{ $alamat }}</p>
                </div>
              @else
                <div class="d-flex justify-content-between">
                  <h5>Alamat:</h5>
                  <p>Alamat tidak tersedia.</p>
                </div>
              @endif
            </div>
            <div class="border-top border-bottom d-flex justify-content-between mb-4 py-4">
              <h5 class="mb-0 me-4 ps-4">Total</h5>
              <p class="total mb-0 pe-4">Rp.{{ number_format($total + 30000, 0, ',', '.') }}</p>
            </div>
            <button class="btn border-secondary rounded-pill text-primary text-uppercase mb-4 ms-4 px-4 py-3"
              type="button">Proceed Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Cart Page End -->

  @include('layouts.footers.market.footer')
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      // Update quantity
      $(".quantity-input").change(function(e) {
        updateQuantity($(this));
      });

      $(".btn-minus").click(function(e) {
        e.preventDefault();
        var input = $(this).closest(".quantity").find(".quantity-input");
        var currentValue = parseInt(input.val());
        if (currentValue > 1) {
          input.val(currentValue - 1);
          updateQuantity(input);
        }
      });

      $(".btn-plus").click(function(e) {
        e.preventDefault();
        var input = $(this).closest(".quantity").find(".quantity-input");
        input.val(parseInt(input.val()) + 1);
        updateQuantity(input);
      });

      // Delete product
      $(".delete-product").click(function(e) {
        e.preventDefault();
        var ele = $(this);
        if (confirm("Do you really want to delete?")) {
          $.ajax({
            url: '{{ route('delete.cart.product') }}',
            method: "DELETE",
            data: {
              _token: '{{ csrf_token() }}',
              id: ele.parents("tr").attr("rowId")
            },
            success: function(response) {
              window.location.reload();
            }
          });
        }
      });

      function updateQuantity(ele) {
        var id = ele.data("id");
        var price = ele.data("price");
        var quantity = ele.val();

        $.ajax({
          url: '{{ route('update.sopping.cart') }}',
          method: "put",
          data: {
            _token: '{{ csrf_token() }}',
            id: id,
            quantity: quantity
          },
          success: function(response) {
            var total = price * quantity;
            ele.closest("tr").find(".total-price").text("Rp." + total.toLocaleString('id-ID'));
            updateCartTotal();
          }
        });
      }

      function updateCartTotal() {
        var subtotal = 0;
        $(".total-price").each(function() {
          subtotal += parseFloat($(this).text().replace("Rp.", "").replaceAll(".", ""));
        });
        $(".subtotal").text("Rp." + subtotal.toLocaleString('id-ID'));
        var total = subtotal + 30000; // Assuming flat rate shipping of Rp.30,000
        $(".total").text("Rp." + total.toLocaleString('id-ID'));
      }

      updateCartTotal();
    });
  </script>
@endsection
