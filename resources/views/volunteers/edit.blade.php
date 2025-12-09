@extends('dashboard.layouts.master')
@section('title')
  تعديل المتطوع
@endsection
@section('css')
@endsection

@section('content')

  <br>
  <div class="container">
      <h2>تعديل المتطوع</h2>
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

      <form action="{{ route('volunteers.update', $volunteer->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Full Name --}}
          <div class="mb-3">
            <label class="form-label">الاسم الكامل</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $volunteer->full_name) }}"
              required>
            @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Membership ID --}}
          <div class="mb-3">
            <label class="form-label">رقم العضوية</label>
            <input type="text" name="membership_id" class="form-control"
              value="{{ old('membership_id', $volunteer->membership_id) }}" required>
            @error('membership_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Gender --}}
          <div class="mb-3">
            <label class="form-label">الجنس</label>
            <select name="gender" class="form-control" required>
              <option value="male" {{ old('gender', $volunteer->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
              <option value="female" {{ old('gender', $volunteer->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
            </select>
            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $volunteer->email) }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Phones --}}
          <div class="mb-3">
            <label class="form-label">الهاتف 1</label>
            <input type="text" name="phone_1" class="form-control" value="{{ old('phone_1', $volunteer->phone_1) }}">
            @error('phone_1') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">الهاتف 2</label>
            <input type="text" name="phone_2" class="form-control" value="{{ old('phone_2', $volunteer->phone_2) }}">
            @error('phone_2') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Address --}}
          <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $volunteer->address) }}">
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Date of Birth --}}
          <div class="mb-3">
            <label class="form-label">تاريخ الميلاد</label>
            <input type="date" name="date_of_birth" class="form-control"
              value="{{ old('date_of_birth', $volunteer->date_of_birth) }}">
            @error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- National ID --}}
          <div class="mb-3">
            <label class="form-label">الرقم الوطني</label>
            <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $volunteer->national_id) }}">
            @error('national_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Joining Date --}}
          <div class="mb-3">
            <label class="form-label">تاريخ الانضمام</label>
            <input type="date" name="joining_date" class="form-control"
              value="{{ old('joining_date', $volunteer->joining_date) }}">
            @error('joining_date') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Skills --}}
          <div class="mb-3">
            <label class="form-label">المهارات</label>
            <input type="text" name="skills" class="form-control" value="{{ old('skills', $volunteer->skills) }}">
            @error('skills') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Study Level --}}
          <div class="mb-3">
            <label class="form-label">المستوى الدراسي</label>
            <select name="study_level" class="form-control">
              <option value="">اختر المستوى</option>
              @foreach(['primary', 'intermediate', 'secondary', 'high_school', 'bachelor', 'master', 'phd', 'other'] as $level)
                <option value="{{ $level }}" {{ old('study_level', $volunteer->study_level) == $level ? 'selected' : '' }}>
                  {{ ucfirst($level) }}</option>
              @endforeach
            </select>
          </div>

          {{-- Grade --}}
          <div class="mb-3">
            <label class="form-label">الرتبة</label>
            <select name="grade" class="form-control">
              <option value="">اختر الرتبة</option>
              @foreach(['founder', 'active', 'honorary'] as $grade)
                <option value="{{ $grade }}" {{ old('grade', $volunteer->grade) == $grade ? 'selected' : '' }}>{{ ucfirst($grade) }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Section --}}
          <div class="mb-3">
            <label class="form-label">القسم</label>
            <select name="section" class="form-control">
              <option value="">اختر القسم</option>
              @foreach(['planning', 'entry', 'executive', 'finance', 'management', 'resources', 'relations', 'media', 'social'] as $section)
                <option value="{{ $section }}" {{ old('section', $volunteer->section) == $section ? 'selected' : '' }}>
                  {{ ucfirst($section) }}</option>
              @endforeach
            </select>
          </div>

          {{-- Notes --}}
          <div class="mb-3">
            <label class="form-label">ملاحظات</label>
            <textarea name="notes" class="form-control">{{ old('notes', $volunteer->notes) }}</textarea>
          </div>

          {{-- Subscriptions --}}
          <div class="mb-3">
            <label class="form-label">الاشتراكات</label>
            <input type="text" name="subscriptions" class="form-control"
              value="{{ old('subscriptions', $volunteer->subscriptions) }}">
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