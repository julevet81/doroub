@extends('dashboard.layouts.master')
@section('title')
  Edit project
@endsection
@section('css')
@endsection

@section('content')

  <div class="container">
      <h2>Edit project</h2>
      <div>
          {{-- Show Success Message --}}
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
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

      <form action="{{ route('assistance_items.update', $assistance_item->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- assistance item Name --}}
          <div class="mb-3">
              <label for="name" class="form-label">assistance item Name</label>
              <input type="text" name="name" id="name"
                     value="{{ old('name', $assistance_item->name) }}"
                     class="form-control" required>
          </div>
          <div class="mb-3">
              <label for="quantity_in_stock" class="form-label">Quantity in Stock</label>
              <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                     value="{{ old('quantity_in_stock', $assistance_item->quantity_in_stock) }}"
                     class="form-control" required>
          </div>
          
          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">Update project</button>
      </form>
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
              document.getElementById(warningId).innerText = `⚠️ This ${type} is already assigned to another project.`;
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