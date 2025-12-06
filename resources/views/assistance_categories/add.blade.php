@extends('dashboard.layouts.master')
@section('title')
  Add Account
@endsection
@section('css')
@endsection

@section('content')
  <div class="container">
      <h2> Add Account</h2>
      <div>
        {{-- Show Success Message --}}
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      <div class="modal-body">
        <!-- Form for adding a new account -->
        <form action="{{ route('accounts.store') }}" method="POST" id="addAccountForm">
          @csrf
          {{-- account Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">Account Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          {{-- Owner --}}
          <div class="mb-3">
            <label>Owner</label>
            <select name="owner_id" id="owner_id" class="form-control" required>
                <option value="">-- Select Owner --</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                @endforeach
            </select>
             <span id="owner-warning" class="text-warning"></span>
          </div>


          {{-- Device --}}
          <div class="mb-3">
            <label>Device</label>
            <select name="device_id" id="device_id" class="form-control" required>
              <option value="">-- Select Device --</option>
              @foreach($devices as $device)
                <option value="{{ $device->id }}">{{ $device->name }}</option>
              @endforeach
            </select>
            <span id="device-warning" class="text-warning"></span>
          </div>


          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          {{-- Phone --}}
          <div class="mb-3">
            <label>Phone</label>
            <select name="phone_id" id="phone_id" class="form-control" required>
                <option value="">-- Select Phone --</option>
                @foreach($phones as $phone)
                    <option value="{{ $phone->id }}">{{ $phone->number }}</option>
                @endforeach
            </select>
             <span id="phone-warning" class="text-warning"></span>
          </div>

          {{-- Credit Card Section --}}
          <div class="mb-3">
            <label>Credit Card</label>
            <select name="credit_card_id" id="credit_card_id" class="form-control" required>
                <option value="">-- Select Card --</option>
                @foreach($creditCards as $card)
                    <option value="{{ $card->id }}">{{ $card->card_holder_name }}</option>
                @endforeach
            </select>
             <span id="credit-warning" class="text-warning"></span>
        </div>
          {{-- Network --}}
          <div class="mb-3">
            <label>Network</label>
            <select name="network_id" id="network_id" class="form-control" required>
                <option value="">-- Select Network --</option>
                @foreach($networks as $network)
                    <option value="{{ $network->id }}">{{ $network->name }}</option>
                @endforeach
            </select>
              <span id="network-warning" class="text-warning"></span>
          </div>
          {{-- Status --}}
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="new">New</option>
                <option value="verified">Verified</option>
                <option value="ready">Ready</option>
            </select>
          </div>

          {{-- Publication Price --}}
          <div class="mb-3">
            <label for="publication_price" class="form-label">Publication Price</label>
            <input type="number" class="form-control" id="publication_price" name="publication_price">
          </div>

          {{-- Weekly Price --}}
          <div class="mb-3">
            <label for="weekly_price" class="form-label">weekly_price</label>
            <input type="number" class="form-control" id="weekly_price" name="weekly_price">
          </div>

          {{-- Update Price --}}
          <div class="mb-3">
            <label for="update_price" class="form-label">Update Price</label>
            <input type="number" class="form-control" id="update_price" name="update_price">
          </div>

          {{-- Upload Price --}}
          <div class="mb-3">
            <label for="upload_price" class="form-label">Upload Price</label>
            <input type="number" class="form-control" id="upload_price" name="upload_price">
          </div>

          {{-- Purchase Price --}}
          <div class="mb-3">
            <label for="price" class="form-label">Purchase Price</label>
            <input type="number" class="form-control" id="price" name="price">
          </div>

          {{-- Open Date --}}
          <div class="mb-3">
            <label for="open_date" class="form-label">Open Date</label>
            <input type="date" class="form-control" id="open_date" name="open_date">
          </div>

          {{-- Activation Date --}}
          <div class="mb-3">
            <label for="activation_date" class="form-label">Activation Date</label>
            <input type="date" class="form-control" id="activation_date" name="activation_date">
          </div>

          {{-- Submit --}}
          <div>
            <button type="submit" class="btn btn-primary">Save Account</button>
          </div>
      </form>
    </div>
  </div>

@endsection

@section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {

      function checkAssignment(type, id, warningId) {
        if (!id) {
          document.getElementById(warningId).innerText = '';
          return;
        }

        fetch("{{ url('check-assignment') }}/" + type + "/" + id)
          .then(res => res.json())
          .then(data => {
            if (data.assigned) {
              document.getElementById(warningId).innerText = `⚠️ This ${type} is already assigned to another account.`;
            } else {
              document.getElementById(warningId).innerText = '';
            }
          })
          .catch(err => console.error(err));
      }

      document.getElementById('owner_id').addEventListener('change', function () {
        checkAssignment('owner', this.value, 'owner-warning');
      });

      document.getElementById('phone_id').addEventListener('change', function () {
        checkAssignment('phone', this.value, 'phone-warning');
      });

      document.getElementById('device_id').addEventListener('change', function () {
        checkAssignment('device', this.value, 'device-warning');
      });

      document.getElementById('credit_card_id').addEventListener('change', function () {
        checkAssignment('credit_card', this.value, 'credit-warning');
      });

      document.getElementById('network_id').addEventListener('change', function () {
        checkAssignment('network', this.value, 'network-warning');
      });

    });
  </script>


@endsection
